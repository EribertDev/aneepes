@extends('master')

@section('title', 'Sondage')
    
@section('extra-style')
<style>
    .text-gold-200 {
        color: rgba(212, 175, 55, 0.8);
    }
    
    @keyframes pulse-gold {
        0% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(212, 175, 55, 0); }
        100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0); }
    }
    
    .voted-badge {
        animation: pulse-gold 2s infinite;
    }
</style>
    
@endsection

@section('content')
<section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
         
          <h2>Sondage  </h2>
        </div>
      </div>
    </div>
  </section>

<div class="min-h-screen bg-[#A12C2F] py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">Sondages Étudiants</h1>
            <p class="text-gold-200">Donnez votre avis en temps réel !</p>
        </div>

        <!-- Liste des sondages -->
        @forelse($polls as $poll)
        <div class="bg-white rounded-xl shadow-2xl mb-8 overflow-hidden transition-transform duration-300 hover:scale-[1.02]">
            <div class="p-6 border-b-2 border-[#D4AF37]">
                <h2 class="text-2xl font-bold text-[#A12C2F]">{{ $poll->question }}</h2>
                <div class="flex items-center mt-2 text-sm text-gray-500">
                    <span class="mr-4">🕑 {{ $poll->end_at ? $poll->end_at->diffForHumans() : 'Sans limite' }}</span>
                    <span>🗳 {{ $poll->votes_count }} votes</span>
                </div>
            </div>

            @if(!$poll->hasVoted(request()->cookie('voted_polls')))
            <form method="POST" action="{{ route('polls.vote', $poll) }}" class="p-6">
                @csrf
                <div class="space-y-4 mb-6" x-data="{ selected: null }">
                    @foreach($poll->options as $option)
                    <label 
                        class="flex items-center p-4 rounded-lg border-2 cursor-pointer transition-all duration-200"
                        :class="{ 
                            'border-[#D4AF37] bg-[#fff5e1]': selected === {{ $option->id }},
                            'border-gray-200 hover:border-[#D4AF37]/50': selected !== {{ $option->id }}
                        }"
                        
                    >
                        <input 
                            type="radio" 
                            name="option_id" 
                            value="{{ $option->id }}" 
                            class="hidden"
                            required
                        >
                        <div class="w-6 h-6 rounded-full border-2 border-[#A12C2F] mr-3 flex items-center justify-center">
                            <div 
                            class="w-3 h-3 rounded-full bg-[#D4AF37] transition-all duration-200"
                            :class="{ 'scale-0': selected !== {{ $option->id }}, 'scale-100': selected === {{ $option->id }} }"
                        ></div>
                        </div>
                        <span class="text-lg">{{ $option->text }}</span>
                    </label>
                    @endforeach
                </div>
                <button 
                    type="submit" 
                    class="w-full py-3 bg-gradient-to-r from-[#D4AF37] to-[#A12C2F] text-white font-semibold rounded-lg hover:opacity-90 transition-opacity"
                >
                    Voter maintenant ✨
                </button>
            </form>
            @else
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($poll->options as $option)
                    <div class="relative pt-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-[#A12C2F]">{{ $option->text }}</span>
                            <span class="text-[#D4AF37] font-bold">{{ $option->percentage }}%</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div 
                                class="h-full bg-gradient-to-r from-[#D4AF37] to-[#A12C2F] transition-all duration-1000"
                                style="width: {{ $option->percentage }}%"
                            ></div>
                        </div>
                        <div class="text-right text-sm text-gray-500 mt-1">
                            {{ $option->votes_count }} votes
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6 text-center text-[#A12C2F]">
                    ✅ Merci d'avoir participé à ce sondage !
                </div>
            </div>
            @endif
        </div>
        @empty
        <div class="text-center py-12">
            <div class="text-2xl text-white mb-4">🎉 Aucun sondage disponible pour le moment</div>
            <p class="text-[#D4AF37]">Revenez plus tard pour donner votre avis !</p>
        </div>
        @endforelse
    </div>
</div>
@endsection