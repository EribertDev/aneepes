<?php

namespace App\Http\Controllers;

use App\Models\Polls;
use App\Models\PollOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use  App\Models\Vote;

class PollsController extends Controller
{
    public function index()
    {
        $polls = Polls::where('is_public', true)
            ->where('status', 'active')
            ->paginate(10);

        return view('polls.index', compact('polls'));
    }

    public function show(Polls $poll)
    {
        return view('polls.show', compact('poll'));
    }

    public function vote(Request $request, Polls $poll)
    {
        if (!$poll->isActive()) {
            return back()->with('error', 'Ce sondage est clos');
        }
    
        $request->validate(['option_id' => 'required|exists:poll_options,id']);
    
        // Génération du hash UNIQUE par sondage
        $voterHash = $this->generateVoterHash($request, $poll->id);
    
        if ($poll->votes()->where('voter_hash', $voterHash)->exists()) {
            return back()->with('error', 'Vous avez déjà voté à ce sondage');
        }
    
        // Enregistrement du vote
        Vote::create([
            'poll_option_id' => $request->option_id,
            'voter_hash' => $voterHash
        ]);
    
        // Mise à jour du cookie AVEC vérification
        $votedPolls = json_decode($request->cookie('voted_polls', '[]'), true);
        
        if (!in_array($poll->id, $votedPolls)) {
            $votedPolls[] = $poll->id;
        }
    
        return back()
            ->with('success', 'Vote enregistré !')
            ->cookie('voted_polls', json_encode($votedPolls), 525600);  }

    private function generateVoterHash(Request $request): string
    {
        return Hash::make(
            $request->ip() . 
            Str::limit($request->userAgent(), 255) . 
           
            config('app.key')
        );
    }
}