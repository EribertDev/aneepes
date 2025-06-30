@extends('master')
@section('title') Evenements @endsection
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
         
          <h2>Evenements </h2>
        </div>
      </div>
    </div>
  </section>
    <!-- Section Événements -->
    <section class="events-section py-5" style="background: #fff;">
        <div class="container">
            <!-- En-tête avec calendrier -->
            <div class="events-header mb-5">
                <div class="row g-4 align-items-end">
                    <div class="col-md-6">
                        <h2 class="section-title">Agenda Étudiant</h2>
                        <div class="calendar-widget" id="eventCalendar"></div>
                    </div>
                    <div class="col-md-6">
                        @if($featuredEvent)
                        <div class="featured-event" style="background: linear-gradient(rgba(161,44,47,0.9), rgba(161,44,47,0.8)), url({{ asset($featuredEvent->image) }});">
                                <span class="days">{{ $featuredEvent->days_remaining }}</span>
                                <small>Jours restants</small>
                            </div>
                            <h3>{{ $featuredEvent->title }}</h3>
                            <a href="" class="btn btn-gold">S'inscrire</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
    
            <!-- Contrôles de filtre -->
            <div class="event-filters mb-4">
                <div class="row g-3">
                 
                    <div class="col-lg-4">
                       
                    </div>
                    <div class="col-lg-4">
                        <div class="switch-container">
                            <label class="switch">
                                <input type="checkbox" id="pastEventsToggle">
                                <span class="slider"></span>
                            </label>
                            <span>Afficher les événements passés</span>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Grille d'événements -->
            <div class="event-grid" id="eventsContainer">
                <div class="row g-4">
                    @foreach($events as $event)
                    <div class="col-md-6 col-lg-4 ">
                        <div class="event-card" data-status="{{ $event->statut }}">
                            <div class="event-badge {{ $event->statut === 'a_venir' ? 'upcoming' : 'past' }}">
                                {{  $event->statut === 'a_venir' ? 'À venir' : 'Terminé' }}
                              
                            </div>
                            <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/default-event.jpg') }}" class="event-image" alt="Atelier">
                       
    
                            <div class="event-content">
                                <div class="event-meta">
                                    <span class="category" style="background: #D4AF37;">{{ $event->type }}</span>
                                    <div class="date-location">
                                        <span><i class="fas fa-calendar"></i> {{ $event->date_heure->format('d/m/Y H:i') }}</span>
                                        <span><i class="fas fa-map-marker"></i> {{ $event->lieu }}</span>
                                    </div>
                                </div>
                                <h4>{{ $event->title }}</h4>
                                
                               
                                <h4>{{ Str::limit($event->titre, 100) }}</h4>
                                <p class="event-excerpt">{{ Str::limit($event->description, 100) }}</p>
                                    <div class="event-actions">
                                        <a href="{{ route('event.show', $event->id) }}" class="btn-details">Détails</a>
                                        <button class="btn-reminder" data-event-id="{{ $event->id }}">
                                            <i class="fas fa-bell"></i>
                                        </button>
                                    </div>
                              
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
    
            <!-- CTA Création d'événement -->
          
        </div>
    </section>
@endsection

@section('extra-script')
   <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('pastEventsToggle');
            const eventsContainer = document.getElementById('eventsContainer');
            const eventCards = document.querySelectorAll('.event-card');
            
            // Mettre à jour les compteurs d'événements
            function updateEventCounters() {
                const totalEvents = document.querySelectorAll('.event-card').length;
                const upcomingEvents = document.querySelectorAll('.event-card[data-status="upcoming"]').length;
                const pastEvents = document.querySelectorAll('.event-card[data-status="past"]').length;
                
                document.getElementById('totalEvents').textContent = totalEvents;
                document.getElementById('upcomingEvents').textContent = upcomingEvents;
                document.getElementById('pastEvents').textContent = pastEvents;
            }
            
            // Fonction pour filtrer les événements
            function filterEvents() {
                eventCards.forEach(card => {
                    if (card.dataset.status === 'termine') {
                        if (toggle.checked) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                   
                });
            }
            
            


          
            
            // Écouter le changement du toggle
                toggle.addEventListener('change', function() {
            // Appeler d'abord la fonction de filtrage
            filterEvents();
            
            
            
          
        });
            
        
         
        });
    </script>
@endsection