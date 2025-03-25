<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = Event::latest()

       
        ->paginate(8);

        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lieu' => 'required|string|max:255',
            'date_heure' => 'required|date',
            'statut' => 'required|in:a_venir,termine',
            'type' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|'
        ]);
    
        // Gestion de l'image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }
    
        Event::create($validated);
    
        return redirect()->route('events.index')
                         ->with('success', 'Événement créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
        return view('admin.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lieu' => 'required|string|max:255',
            'date_heure' => 'required|date',
            'statut' => 'required|in:a_venir,termine',
            'type' => 'required|in:conference,atelier,seminaire,autre',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean'
        ]);
    
        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        } elseif ($request->remove_image) {
            Storage::disk('public')->delete($event->image);
            $validated['image'] = null;
        }
    
        $event->update($validated);
    
        return redirect()->route('events.index')
                         ->with('success', 'Événement mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
               //
               Storage::disk('public')->delete($event->image);
               $event->delete();
               return redirect()->route('events.index')->with('success', 'Evenements  supprimée!');
    }
}
