@extends('master')
@section('title') Evenements-Detail @endsection
@section('extra-style')
<style>
    
.events-section {
    position: relative;
}

.event-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s;
    position: relative;
}

.event-card:hover {
    transform: translateY(-5px);
}

.event-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 5px 15px;
    border-radius: 20px;
    color: white;
    font-size: 0.9rem;
}

.event-badge.upcoming {
    background: #A12C2F;
}

.event-badge.past {
    background: #D4AF37;
}

.event-image {
    height: 200px;
    object-fit: cover;
    width: 100%;
}

.event-content {
    padding: 1.5rem;
}

.date-location {
    display: flex;
    justify-content: space-between;
    color: #666;
    font-size: 0.9rem;
    margin: 1rem 0;
}

.btn-details {
    color: #A12C2F;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s;
}

.btn-details:hover {
    color: #D4AF37;
}

.btn-reminder {
    border: none;
    background: none;
    color: #D4AF37;
    font-size: 1.2rem;
}

.event-gallery {
    position: relative;
    height: 200px;
}

.gallery-count {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: rgba(0,0,0,0.6);
    color: white;
    padding: 3px 10px;
    border-radius: 15px;
    font-size: 0.9rem;
}

.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #A12C2F;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

.featured-event {
    color: white;
    padding: 2rem;
    border-radius: 15px;
    position: relative;
    min-height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}

.event-countdown {
    position: absolute;
    top: 20px;
    right: 20px;
    text-align: center;
    background: rgba(255,255,255,0.2);
    padding: 1rem;
    border-radius: 10px;
}

.event-countdown span.days {
    font-size: 2rem;
    display: block;
    font-weight: bold;
}
</style>
@endsection
@section('content')
<section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
         
          <h2>Evenements-Detail </h2>
        </div>
      </div>
    </div>
  </section>
<section class="event-detail py-5">
    <div class="container">
        
        <!-- En-tête de l'événement -->
        <div class="event-header mb-5">
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="event-meta mb-3">
                        <span class="badge bg-gold">{{ $event->type }}</span>
                        <span class="text-muted ms-2"><i class="fas fa-calendar-alt"></i> {{ $event->date_heure->translatedFormat('l j F Y') }}</span>
                        <span class="text-muted ms-2"><i class="fas fa-map-marker-alt"></i> {{ $event->lieu }}</span>
                    </div>
                    <h1 class="event-title">{{ $event->title }}</h1>
                    
                    @if($event->statut === 'termine')
                        <div class="past-event-stats mt-4">
                            <div class="stat-item">
                                <i class="fas fa-users fa-2x"></i>
                                <div>
                                    <span class="count"></span>
                                    <small>Participants</small>
                                </div>
                            </div>
                            <a href="" class="btn btn-outline-gold">
                                <i class="fas fa-file-pdf"></i> Rapport complet
                            </a>
                        </div>
                    @else
                        <div class="event-countdown mt-5 py-5 my-5">
                            <div class="countdown-timer" data-date="{{ $event->date_heure->format('Y-m-d\TH:i:s') }}">
                                <div class="countdown-item">
                                    <span class="days">00</span>
                                    <small>Jours</small>
                                </div>
                                <div class="countdown-item">
                                    <span class="hours">00</span>
                                    <small>Heures</small>
                                </div>
                                <div class="countdown-item">
                                    <span class="minutes">00</span>
                                    <small>Minutes</small>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                   
                       
                  
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/default-event.jpg') }}" class="img-fluid rounded" alt="{{ $event->title }}">
                   
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="event-body row g-5">
            <!-- Colonne gauche - Description et programme -->
            <div class="col-lg-8">
                <div class="event-description mb-5">
                    <h3 class="section-subtitle">Description de l'événement</h3>
                    <div class="content">
                        {!! nl2br(e($event->description)) !!}
                    </div>
                </div>

             
            </div>

            <!-- Colonne droite - Inscription et infos pratiques -->
            <div class="col-lg-4">
                @if(!$event->statut === 'termine')
                <div class="event-registration card shadow mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Inscription</h4>
                        
                        @if($event->registration_limit)
                        <div class="progress mb-3">
                            <div class="progress-bar bg-gold" 
                                 style="width: {{ ($event->registrations_count / $event->registration_limit) * 100 }}%">
                                {{ $event->registrations_count }}/{{ $event->registration_limit }}
                            </div>
                        </div>
                        @endif

                        @auth
                            @if(auth()->user()->hasRegisteredFor($event))
                             
                                <form action="" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="guests" class="form-label">Nombre de personnes</label>
                                        <input type="number" 
                                               name="guests" 
                                               class="form-control" 
                                               min="1" 
                                               value="1">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        S'inscrire maintenant
                                    </button>
                                </form>
                            @endif
                        @else
                            <div class="alert alert-info">
                                <a href="{{ route('login') }}">Connectez-vous</a> pour vous inscrire
                            </div>
                        @endauth
                    </div>
                </div>
                @endif

                <div class="event-info card shadow">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Informations pratiques</h4>
                        
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h5>Horaires</h5>
                                <p>De {{ $event->date_heure->format('H:i') }} </p>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-map-marked-alt"></i>
                            <div>
                                <h5>Lieu</h5>
                                <p>{{ $event->lieu }}</p>
                               
                            </div>
                        </div>

                      
                    </div>
                </div>
            </div>
        </div>

        <!-- Événements similaires -->
        @if($relatedEvents->count() > 0)
        <div class="related-events mt-5">
            <h3 class="section-subtitle mb-4">Événements similaires</h3>
            <div class="row g-4">
                @foreach($relatedEvents as $relatedEvent)
                <div class="col-md-6 col-lg-4 ">
                    <div class="event-card">
                        <div class="event-badge {{ $relatedEvent->statut === 'a_venir' ? 'upcoming' : 'past' }}">
                            {{  $relatedEvent->statut === 'a_venir' ? 'À venir' : 'Terminé' }}
                          
                        </div>
                        <img src="{{ $relatedEvent->image ? asset('storage/' . $relatedEvent->image) : asset('images/default-event.jpg') }}" class="event-image" alt="Atelier">
                   

                        <div class="event-content">
                            <div class="event-meta">
                                <span class="category" style="background: #D4AF37;">{{ $relatedEvent->type }}</span>
                                <div class="date-location">
                                    <span><i class="fas fa-calendar"></i> {{ $relatedEvent->date_heure->format('d/m/Y H:i') }}</span>
                                    <span><i class="fas fa-map-marker"></i> {{ $relatedEvent->lieu }}</span>
                                </div>
                            </div>
                            <h4>{{ $relatedEvent->title }}</h4>
                            
                           
                            <h4>{{ Str::limit($relatedEvent->titre, 100) }}</h4>
                            <p class="event-excerpt">{{ Str::limit($relatedEvent->description, 100) }}</p>
                                <div class="event-actions">
                                    <a href="{{ route('event.show', $relatedEvent->id) }}" class="btn-details">Détails</a>
                                    <button class="btn-reminder" data-event-id="{{ $relatedEvent->id }}">
                                        <i class="fas fa-bell"></i>
                                    </button>
                                </div>
                          
                        </div>
                    </div>
              
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@section('extra-script')
<script>
// Initialisation du compte à rebours
function updateCountdown() {
    const countdown = document.querySelector('.countdown-timer');
    if (!countdown) return;

    const targetDate = new Date(countdown.dataset.date);
    const now = new Date().getTime();
    const distance = targetDate - now;

    

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

    countdown.querySelector('.days').textContent = days.toString().padStart(2, '0');
    countdown.querySelector('.hours').textContent = hours.toString().padStart(2, '0');
    countdown.querySelector('.minutes').textContent = minutes.toString().padStart(2, '0');
}

setInterval(updateCountdown, 1000);
updateCountdown();
</script>
@endsection