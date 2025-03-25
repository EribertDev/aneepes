<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actualite ;
use Illuminate\Support\Facades\Storage;

use HTMLPurifier;
use HTMLPurifier_Config;

class ActualitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $news = Actualite::when($request->search, function($query) use ($request) {
            $query->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('subtitle', 'like', '%'.$request->search.'%');
        })
        ->when($request->type, function($query) use ($request) {
            $query->where('type', $request->type);
        })
        ->when($request->status, function($query) use ($request) {
            $query->where('status', $request->status);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        //
        $validated = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:draft,published,archived',
            'type' => 'required|max:255'
        ]);

        if($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('news-photos', 'public');
        }
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $validated['description'] = $purifier->purify($request->description);
        Actualite::create($validated);

        return redirect()->route('news.index')->with('success', 'Actualité mise à jour!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $actualite = Actualite::findOrFail($id); // Récupérer l'actualité ou renvoyer une erreur 404
        return view('admin.news.show', compact('actualite'));
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actualite $news)
    {
        //
        return view('admin.news.edit', compact('news'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actualite $news)
    {
        //
        $validated = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'description' => 'required',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'type' => 'required|max:255'
        ]);
        $config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
$validated['description'] = $purifier->purify($request->description);

        if($request->hasFile('photo')) {
            Storage::disk('public')->delete($news->photo);
            $validated['photo'] = $request->file('photo')->store('news-photos', 'public');
        }
        else{
            $validated['photo'] = $news->photo;
        }

        $news->update($validated);

        return redirect()->route('news.index')->with('success', 'Actualité mise à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actualite $news)
    {
        //
        Storage::disk('public')->delete($news->photo);
        $news->delete();
        return redirect()->route('news.index')->with('success', 'Actualité supprimée!');
    }
}
