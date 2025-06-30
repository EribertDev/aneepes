<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    
        return view('admin.members', [
            'members' =>Member::orderByRaw("FIELD(role, 'Président', 'Vice-Président', 'Secrétaire', 'Trésorier', 'Membre')")
            ->orderBy('fullname')
            ->get(),
        ]);
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
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:members',
            'phone' => 'required|string|max:20',
            'role' => 'required|string',
            'photo' => 'nullable|image',
            'is_visible' => 'required|boolean',
        ]);

        try {
            $member = new Member($validated);

            if ($request->hasFile('photo')) {
             
                $member->photo  = $request->file('photo')->store('members', 'public');
            }

            $member->save();

            return response()->json([
                'success' => true,
                'message' => 'Membre ajouté avec succès'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
        if (!$member) {
            return response()->json(['error' => 'Membre non trouvé'], 404);
        }
        
        return response()->json($member);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,'.$member->id,
            'phone' => 'required|string|max:20',
            'role' => 'required|in:Président,Vice-Président,Secrétaire,Trésorier,Membre',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_visible' => 'required|boolean'
        ]);
    
        try {
            // Gestion de la photo
            if ($request->hasFile('photo')) {
                // Supprimer l'ancienne photo si elle existe
                if ($member->photo && Storage::exists($member->photo)) {
                    Storage::delete($member->photo);
                }
                
                $path = $request->file('photo')->store('members', 'public');
               
               
                $validated['photo'] = $path;
            } else {
                unset($validated['photo']); // Ne pas mettre à jour la photo si aucun fichier n'est envoyé
            }
    
            $member->update($validated);
    
             return redirect()->back()->with('success', 'Membre mis à jour avec succès');
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour: '.$e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
        try {
            if ($member->photo) {
              
                 Storage::disk('public')->delete($member->photo);
            }
            
            $member->delete();
            
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression'
            ], 500);
        }
    }
    
}
