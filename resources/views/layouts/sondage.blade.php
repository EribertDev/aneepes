@extends('master')

@section('title', 'Sondage')
    
@section('extra-style')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">

<style>

.option-card {
        cursor: pointer;
        border: 2px solid #dee2e6;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .option-card:hover:not(.active-option) {
        transform: translateY(-3px);
        border-color: #A12C2F;
        box-shadow: 0 4px 15px rgba(161, 44, 47, 0.1);
    }

    .active-option {
        border-color: #D4AF37 !important;
        background: rgba(212, 175, 55, 0.05);
        transform: translateY(-3px);
    }

    .form-check-input {
        width: 1.3em;
        height: 1.3em;
        margin-top: 0;
    }

    .form-check-input:checked {
        background-color: #D4AF37;
        border-color: #D4AF37;
    }

    .check-icon {
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.3s ease;
    }

    .active-option .check-icon {
        opacity: 1;
        transform: scale(1);
    }
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
                    <div class="row g-3">
                        @foreach($poll->options as $option)
                        <div class="col-12 col-md-6">
                            <div class="card option-card shadow-sm hover-shadow transition-all"
                                 :class="{ 'active-option': selected === {{ $option->id }} }"
                                 @click="selected = {{ $option->id }}">
                                <div class="card-body d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input 
                                            type="radio" 
                                            name="option_id" 
                                            value="{{ $option->id }}" 
                                            class="form-check-input"
                                            :checked="selected === {{ $option->id }}"
                                            required>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-0">{{ $option->text }}</h5>
                                    </div>
                                    <div class="check-icon ms-2">
                                        <i class="bi bi-check2-circle fs-4 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
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