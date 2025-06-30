<?php

namespace App\Http\Controllers;


use App\Models\Polls;
use Illuminate\Http\Request;
use App\Models\PollOption;
use Illuminate\Support\Facades\Storage;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;


class AdminPollController extends Controller
{
    public function index()
    {
        $polls = Polls::withCount('votes')
           
            ->latest()
            ->paginate(10);

        return view('admin.polls.index', compact('polls'));
    }

    public function show(Polls $poll)
    {
        return view('admin.polls.show', compact('poll'));
    }

    public function create()
    {
        return view('admin.polls.create');
    }

    public function store(Request $request)
    {
    

        $poll = Polls::create([
            'question' => $request->question,
            'status' => $request->status,
            'end_at' => $request->end_at,
            'is_public' => $request->boolean('is_public')
        ]);
        
        foreach ($request->options as $option) {
            $poll->options()->create(['text' => $option['text']]);
        }

        return redirect()->route('admin.polls.index')->with('success', 'Sondage créé !');
    }

    public function edit(Polls $poll)
    {
        return view('admin.polls.edit', compact('poll'));
    }

    public function update(Request $request, Polls $poll)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*.id' => 'nullable|exists:poll_options,id',
            'options.*.text' => 'required|string|max:255',
            'end_at' => 'nullable|date',
            'status' => 'required|in:draft,active,closed'
        ]);

        $poll->update([
            'question' => $request->question,
            'status' => $request->status,
            'end_at' => $request->end_at,
            'is_public' => $request->boolean('is_public')
        ]);

        // Gestion des options existantes et nouvelles
        $existingOptions = [];
        foreach ($request->options as $option) {
            if (isset($option['id'])) {
                $pollOption = $poll->options()->find($option['id']);
                $pollOption->update(['text' => $option['text']]);
                $existingOptions[] = $pollOption->id;
            } else {
                $newOption = $poll->options()->create(['text' => $option['text']]);
                $existingOptions[] = $newOption->id;
            }
        }

        // Suppression des options non présentes
        $poll->options()->whereNotIn('id', $existingOptions)->delete();

        return redirect()->route('admin.polls.index')->with('success', 'Sondage mis à jour !');
    }

    public function destroy(Polls $poll)
    {   
        

          DB::transaction(function () use ($poll) {
        // 1. Supprimer tous les votes pour ce sondage
        Vote::whereIn('poll_option_id', $poll->options()->pluck('id'))->delete();
        
        // 2. Supprimer les options
        $poll->options()->delete();
        
        // 3. Supprimer le sondage
        $poll->delete();

    });
        
    
        return back()->with('success', 'Sondage archivé !');
    }
}