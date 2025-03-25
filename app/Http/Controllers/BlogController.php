<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
           $posts = Post::published()
               ->with('editor')
               ->latest()
               ->paginate(9);

    $categories = Post::select('category')
                    ->distinct()
                    ->pluck('category');

    return view('layouts.blog', compact('posts', 'categories'));
    }
    public function show(Post $post)
    {
        $post->load(['comments.user', 'ratings'])
             ->loadCount(['comments', 'ratings']);
    
        $averageRating = $post->ratings()->avg('value');
        
        $relatedPosts = Post::where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->published()
            ->take(3)
            ->get();
    
        return view('layouts.blog-detail', compact('post', 'averageRating', 'relatedPosts'));
    }

    public function storeComment(Request $request, Post $post)
{
    $request->validate(['content' => 'required|string|max:1000']);

    $post->comments()->create([
        'content' => $request->content,
        'user_id' => auth()->id()
    ]);

    return back()->with('success', 'Commentaire ajouté !');
}


public function storeRating(Request $request, Post $post)
{
    $request->validate(['rating' => 'required|integer|between:1,5']);

    $identifier = hash('sha256', 
        $request->ip() . 
        $request->userAgent() . 
        $post->id
    );

    
    if ($post->ratings()->where('identifier', $identifier)->exists()) {
        return redirect()->back()
            ->withErrors(['rating' => 'Vous avez déjà noté cet article'])
            ->withInput();
    }
    $post->ratings()->create([
        'value' => $request->rating,
        'identifier' => $identifier
    ]);

    return redirect()->back()
    ->with('success', 'Merci pour votre notation !');
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
