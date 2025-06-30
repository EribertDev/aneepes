<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use App\Models\Subscription;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;


class SubscriptionController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function subscription(){

            // Récupérer les paiements avec les relations
    $payments = Subscription::with('user')
                ->orderBy('paid_at', 'desc')
                ->paginate(10);

    // Calculer les statistiques
    $paid = Subscription::where('status', 'paid')->count();
    $pending = Subscription::where('status', 'pending')->count();
    $failed = Subscription::where('status', 'failed')->count();

        return view('admin.subscriptions.subscriptions-details',[
        'payments' => $payments,
        'paid' => $paid,
        'pending' => $pending,
        'failed' => $failed,
        'currentMonth' => now()->format('F Y'),
        ]);
     }


    public function index(){

        $subscriptions = Subscription::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }
    public function showPaymentForm()
    {
        return view('admin.subscriptions.payement');
    }

 public function processPayment(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:100'
    ]);

    $user = Auth::user();
    $currentMonth = now()->format('Y-m');
    

    
    $existingSubscription = Subscription::where('user_id', $user->id)
        ->where('created_at', '>=', now()->startOfMonth())
        ->first();

    if ($existingSubscription) {
        if ($existingSubscription->status === 'paid') {
            return response()->json([
                'success' => false,
                'status' => 'paid',
                'name' => $user->name,
                'amount' => $existingSubscription->amount,
                'message' => 'Vous avez déjà payé votre cotisation pour ce mois de ' . now()->format('F Y') . '.',
            ]);
        } elseif ($existingSubscription->status === 'pending') {
            return response()->json([
                'success' => false,
                 'amount' => $request->amount,
                'description' => 'Paiement de la cotisation ANEEPES du mois de ' . now()->format('F Y'),
                'name' => $user->name,
                'email' => $user->email,
                'id' => $existingSubscription->id,
            ]);
        }
    }else{
      
        return response()->json([
        'success' => true,
        'amount' => $request->amount,
        'description' => 'Paiement de la cotisation ANEEPES du mois de ' . now()->format('F Y'),
        'name' => $user->name,
        'email' => $user->email,
    ]);

    }

 

    
}

public function handleCallback(Request $request)
{
    $request->validate([
       //'subscription_id' => 'required|string',
        'transaction_id' => 'required|string',
        'amount' => '|numeric|min:100',
        'reference' => 'required|string',
    ]);
   
   $subscription =Subscription::find($request->subscription_id);
   if ($subscription)
   {
    $transaction_id =$request->transaction_id;
    if( $request->transaction_id){
        $subscription->update([
            'transaction_id'=>$transaction_id,
            'amount'=> $request->amount, 
            'transaction' => $request->reference,
        ]);
    }
   }else {
    $currentMonth = now()->format('Y-m');
    
        // Créer une nouvelle souscription
       $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'month' => $currentMonth,
            'transaction'=>$request->reference,
            'transaction_id' => $request->transaction_id,
            'status' => 'pending',
        ]);
    
   }
 


    try {
        \FedaPay\FedaPay::setApiKey("sk_sandbox_WHk3VWXx2OoC_xzCkpI8UCqg");
        \FedaPay\FedaPay::setEnvironment('sandbox');

        $transaction = \FedaPay\Transaction::retrieve($subscription->transaction_id);

        if ($transaction->status === 'approved') {
            $subscription->update([
                'status' => 'paid',
                'paid_at' => now(),
                'transaction'=> $request->reference,
                
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Paiement confirmé avec succès!',
            ]);
        }
        else {
             $subscription->update(['status' => 'failed']);
            return response()->json([
                'success' => false,
                'message' => 'Paiement échoué ou annulé',
            ], 400);
        }
       

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors du traitement: ' . $e->getMessage()
        ], 500);
    }
     
    }

    // Nouvelle méthode pour vérifier les paiements en attente
    public function checkPendingPayment($id)
        {
            $subscription = Subscription::findOrFail($id);
            
            if ($subscription->status === 'paid') {
                return response()->json([
                    'success' => true,
                    'status' => 'paid'
                ]);
            }

            return response()->json([
                'success' => false,
                'status' => 'pending'
            ]);
        }
    public function success()
    {
        return view('admin.subscriptions.success');
    }

    public function failed()
    {
        return view('admin.subscriptions.failed');
    }



}
