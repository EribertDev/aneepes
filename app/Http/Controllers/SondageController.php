<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Polls;

class SondageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $polls = Polls::where('is_public', true)
        ->where('status', 'active')
        ->paginate(5);

    return view('layouts.sondage', compact('polls'));
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
