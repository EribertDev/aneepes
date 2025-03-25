<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use HTMLPurifier;
use HTMLPurifier_Config;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $posts = Post::with('editor')
       ->where('editor_id', auth()->id())
       ->latest('publication_date')
       ->paginate(9);

   return view('editor.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('editor.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:500',
            'image' => 'required|image|max:2048',
            'tags' => 'nullable|string',
            'status'=>'required|in:draft,published,archived',
            'category'=>'required|in:sante,academique,emploi,culture,logement,evenements,technology,autre'
        ]);

        $imagePath = $request->file('image')->store('posts', 'public');

        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $content = $purifier->purify($request->content);

        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
            'category' => $request->category,
            'status' => $request->status,
            'content' => $content,
            'image' => $imagePath,
            'editor_id' => auth()->id(),
            'tags' => $this->processTags($request->tags),
            'publication_date' => $request->status === 'published' ? now() : null

        ]);

        return redirect()->route('admin.posts.index', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view('editor.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
       
        return view('editor.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'category' => 'required|in:technology,business,health,entertainment,emploi,culture,autre',
            'status' => 'required|in:draft,published,archived',
            'tags' => 'nullable|string'
        ]);
    
        if ($request->hasFile('image')) {
            Storage::delete($post->image);
            $post->image = $request->file('image')->store('posts', 'public');
        }
    
        $post->update([
            ...$validated,
            'tags' => $request->tags ? explode(', ', $request->tags) : null,
            'publication_date' => $request->status === 'published' && $post->status !== 'published' ? now() : $post->publication_date
        ]);
    
        return redirect()->route('admin.posts.index', $post)->with('success','Poste mise a jour avec succès ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        Storage::disk('public')->delete($post->image);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Evenements  supprimée!');
    }



    private function processTags($tags)
    {
        return collect(preg_split('/\s*,\s*/', $tags))
            ->map(fn($tag) => '#' . trim($tag, '#'))
            ->unique()
            ->toArray();
    }
}
