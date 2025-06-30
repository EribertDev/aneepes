<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class NewsletterController extends Controller
{


    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:newsletters,email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        Newsletter::create([
            'email' => $request->email
        ]);

        return redirect()->back()
            ->with('newsletter_success', 'Merci pour votre inscription à notre newsletter !');
    }

    public function unsubscribe($token)
    {
        $subscriber = Newsletter::where('token', $token)->first();

        if (!$subscriber) {
            return redirect()->back()->with('error', 'Lien de désabonnement invalide');
        }

        $subscriber->delete();

        return redirect()->back()->with('success', 'Vous êtes désormais désabonné de notre newsletter');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
