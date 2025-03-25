<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actualite;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $news = Actualite::where('status', 'published')
        ->latest()
        ->paginate(6);

        return view('layouts.actualites', compact('news'));
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
        $news = Actualite::findOrFail($id);
    
        // Articles connexes (même type)
        $relatedNews = Actualite::where('type', $news->type)
            ->where('id', '!=', $id)
            ->where('status', 'published')
            ->latest()
            ->take(2)
            ->get();
    
        return view('layouts.actualites-detail', compact('news', 'relatedNews'));
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
