<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Polls;


class RealTimePoll extends Component
{
    public $pollId;
    public $autoRefresh = true;

    protected $listeners = ['voteAdded' => 'refreshPoll'];

    public function mount(Polls $poll)
    {
        $this->pollId = $poll->id;
    }

    public function refreshPoll()
    {
        $this->poll = $this->getPoll();
    }

    public function getPoll()
    {
        return Polls::with(['options' => function($query) {
            $query->withCount('votes');
        }])->findOrFail($this->pollId);
    }

    public function render()
    {
        return view('livewire.real-time-poll', [
            'poll' => $this->getPoll(),
            'options' => $this->getPoll()->options
        ]);
    }
}
