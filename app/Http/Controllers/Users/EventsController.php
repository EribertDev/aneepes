<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $featuredEvent = Event::upcoming()->featured()->first();

        $events = Event::latest()

       

        ->paginate(6);

        return view('layouts.evenements', compact('events','featuredEvent'));
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
    public function show(string $id)
    {
        //
        $event = Event::findOrFail($id);
    
        // Articles connexes (même type)
        $relatedEvents = Event::where('type', $event->type)
            ->where('id', '!=', $id)
            ->where('statut', 'a_venir')
            ->latest()
            ->take(2)
            ->get();
    
        return view('layouts.event-details', compact('event', 'relatedEvents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
