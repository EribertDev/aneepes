@section('extra-style')
<style>
    .results-animation {
        opacity: 1;
        transition: opacity 0.3s ease;
    }

    .results-animation-updating {
        opacity: 0.5;
    }

    .percentage {
        display: inline-block;
        min-width: 40px;
        text-align: right;
    }
</style>

@endsection
<div>

    @if($poll->isActive())
        <div wire:poll.5s="refreshPoll">
    @endif

    <div class="results-animation">
        @foreach($options as $option)
            <div class="result-item mb-4" wire:key="option-{{ $option->id }}-{{ $option->votes_count }}">
                <div class="flex justify-between mb-1">
                    <span>{{ $option->text }}</span>
                    <span>
                        <span class="percentage">{{ number_format($option->percentage, 1) }}</span>%
                    </span>
                </div>
                <div class="h-4 bg-gray-200 rounded-full">
                    <div class="h-full bg-anepes-gold rounded-full transition-all duration-500" 
                         style="width: {{ $option->percentage }}%"></div>
                </div>
                <div class="text-sm text-gray-500 mt-1">
                    {{ $option->votes_count }} votes
                </div>
            </div>
        @endforeach
    </div>

    @if($poll->isActive())
        </div>
    @endif
</div>




@section('extra-scripts')
 <script>
    document.addEventListener('livewire:load', function() {
        Livewire.hook('message.processed', (message, component) => {
            const container = document.querySelector('.results-animation');
            
            // Ajoute une classe pendant la mise à jour
            container.classList.add('results-animation-updating');
            
            setTimeout(() => {
                container.classList.remove('results-animation-updating');
            }, 300);
        });
    });
</script>
@endsection