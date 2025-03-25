@extends('dashboard')
@section('title', 'Sondage')
@section('extra-style')
@endsection
@section('content')
<div class="poll-container max-w-2xl mx-auto my-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-anepes-red mb-4">{{ $poll->question }}</h2>
        
        @if($poll->isActive())
            <form method="POST" action="{{ route('polls.vote', $poll) }}">
                @csrf
                <div class="space-y-4 mb-6">
                    @foreach($poll->options as $option)
                        <label class="flex items-center p-4 border rounded-lg hover:bg-anepes-beige transition">
                            <input 
                                type="radio" 
                                name="option_id" 
                                value="{{ $option->id }}" 
                                class="form-radio text-anepes-gold"
                                required
                            >
                            <span class="ml-3">{{ $option->text }}</span>
                        </label>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary w-full">
                    Voter
                </button>
            </form>
        @else
            <div class="results">
                @foreach($poll->options as $option)
                    <div class="result-item mb-4">
                        <div class="flex justify-between mb-1">
                            <span>{{ $option->text }}</span>
                            <span>{{ $option->percentage }}%</span>
                        </div>
                        <div class="h-4 bg-gray-200 rounded-full">
                            <div 
                                class="h-full bg-anepes-gold rounded-full transition-all duration-500" 
                                style="width: {{ $option->percentage }}%"
                            ></div>
                        </div>
                    </div>
                @endforeach
                <p class="text-gray-600 mt-4">
                    Total votes : {{ $poll->total_votes }}
                </p>
            </div>
        @endif
    </div>
</div>

@livewire('real-time-poll', ['poll' => $poll])
@endsection