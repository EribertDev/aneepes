@extends('master')
@section('title')
Accueil
@endsection

@section('extra-style')
<style>
  .hero-section {
      padding: 100px 0;
      background: linear-gradient(45deg, #A12C2F, #D4AF37);
  }

  .hover-lift {
      transition: transform 0.3s ease;
  }

  .hover-lift:hover {
      transform: translateY(-5px);
  }

  .news-card {
      height: 100%;
      border: none;
      border-radius: 15px;
      overflow: hidden;
  }

  .event-date .date-box {
      text-align: center;
      padding: 15px;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
  }

  .member-photo {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      margin: -50px auto 20px;
      border: 3px solid #A12C2F;
  }

  .countdown-timer {
      display: flex;
      gap: 20px;
      justify-content: center;
      margin: 20px 0;
  }

  .countdown-item {
      text-align: center;
      background: rgba(255, 255, 255, 0.1);
      padding: 15px;
      border-radius: 10px;
      min-width: 80px;
  }

  .btn-gold {
      background: #D4AF37;
      color: white;
      border: none;
      padding: 10px 25px;
      border-radius: 30px;
  }
</style>
@endsection
@section('content')
<section class="section main-banner" id="top" data-section="section1">
    <video autoplay muted loop id="bg-video">
        <source src="assets/images/course-video.mp4" type="video/mp4" />
    </video>

    <div class="video-overlay header-text">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="caption">
            <h2>Bienvenue à l'ANEEPES</h2>
            <p>L'<strong>ANEEPES</strong> (Association Nationale des Etudiants des Etablissement Privés de l'Enseignement Supérieur) est un mouvement d'étudiant regroupant les étudiants et stagiaires inscrits dans les établissements de l'enseignement supérieur privé du Bénin.</p>
            <div class="main-button-red">
                <div class="scroll-to-section"><a href="">Nous rejoindre</a></div>
            </div>
        </div>
            </div>
          </div>
        </div>
    </div>
</section>
<!-- ***** Main Banner Area End ***** -->

<!-- Hero Section -->
<section class="hero-section bg-gradient-danger">
  <div class="container">
      <div class="row align-items-center">
          <div class="col-lg-6">
              <h1 class="display-4 text-white mb-4">Bienvenue sur le Portail Étudiant</h1>
              <p class="lead text-light mb-4">Accédez à toutes les ressources de votre communauté étudiante</p>
              <a href="#events" class="btn btn-gold btn-lg">Voir les événements à venir</a>
          </div>
          <div class="col-lg-6">
              <div class="hero-carousel">
                  <!-- Slider d'actualités importantes -->
                  @foreach($featuredNews as $news)
                  <div class="hero-card">
                      <div class="card border-0 shadow-lg">
                          <img src="{{ asset($news->image) }}" class="card-img" alt="{{ $news->title }}">
                          <div class="card-img-overlay bg-dark-overlay">
                              <h5 class="text-white">{{ $news->title }}</h5>
                              <a href="{{ route('news.show', $news) }}" class="btn btn-sm btn-danger">Lire plus</a>
                          </div>
                      </div>
                  </div>
                  @endforeach
              </div>
          </div>
      </div>
  </div>
</section>

<!-- Section Actualités -->
<section class="news-section py-5">
  <div class="container">
      <h2 class="section-title mb-4"><i class="bi bi-newspaper me-2"></i>Dernières Actualités</h2>
      <div class="row g-4">
          @foreach($latestNews as $news)
          <div class="col-md-4">
              <div class="card news-card hover-lift">
                  <img src="{{ asset($news->image) }}" class="card-img-top" alt="{{ $news->title }}">
                  <div class="card-body">
                      <span class="badge bg-danger">{{ $news->category }}</span>
                      <h5 class="mt-2">{{ Str::limit($news->title, 50) }}</h5>
                      <p class="card-text">{{ Str::limit($news->excerpt, 100) }}</p>
                      <div class="d-flex justify-content-between align-items-center">
                          <small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
                          <a href="{{ route('news.show', $news) }}" class="btn btn-sm btn-danger">Lire</a>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
      </div>
  </div>
</section>

<!-- Section Événements -->
<section class="events-section bg-light py-5" id="events">
  <div class="container">
      <h2 class="section-title mb-4"><i class="bi bi-calendar-event me-2"></i>Prochains Événements</h2>
      <div class="row g-4">
          <div class="col-lg-5">
            @foreach (  $nextEvent as  $nextEvents)
              
           
              <div class="card featured-event border-0 shadow-lg">
                  <div class="card-body p-4">
                      <div class="event-countdown" data-date="{{ $nextEvents->date_heure }}">
                          <h3 class="text-danger">Prochain événement</h3>
                          <div class="countdown-timer">
                              <div class="countdown-item">
                                  <span class="days">00</span>
                                  <small>Jours</small>
                              </div>
                              <div class="countdown-item">
                                  <span class="hours">00</span>
                                  <small>Heures</small>
                              </div>
                          </div>
                          <h4 class="my-3">{{ $nextEvents->title }}</h4>
                          <a href="{{ route('events.show', $nextEvents) }}" class="btn btn-danger">Détails</a>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
          <div class="col-lg-7">
              <div class="event-list">
                  @foreach($upcomingEvents as $event)
                  <div class="card event-card mb-3">
                      <div class="row g-0">
                          <div class="col-md-3 event-date">
                              <div class="date-box bg-danger text-white">
                                  <div class="day">{{ $event->date_heure->format('d') }}</div>
                                  <div class="month">{{ $event->date_heure->translatedFormat('M') }}</div>
                              </div>
                          </div>
                          <div class="col-md-9">
                              <div class="card-body">
                                  <h5>{{ $event->title }}</h5>
                                  <p class="text-muted mb-2">{{ $event->location }}</p>
                                  <div class="d-flex justify-content-between align-items-center">
                                      <div class="participants">
                                          <i class="bi bi-people"></i> {{ $event->participants_count }} inscrits
                                      </div>
                                      <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-danger">Voir</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  @endforeach
              </div>
          </div>
      </div>
  </div>
</section>

<!-- Section Sondages Actifs -->
<section class="polls-section py-5">
  <div class="container">
      <h2 class="section-title mb-4"><i class="bi bi-bar-chart me-2"></i>Sondages en Cours</h2>
      <div class="row g-4">
          @foreach($activePolls as $poll)
          <div class="col-md-6">
              <div class="card poll-card shadow-sm">
                  <div class="card-body">
                      <h5 class="mb-3">{{ $poll->question }}</h5>
                      <div class="poll-results">
                          @foreach($poll->options as $option)
                          <div class="result-item mb-2">
                              <div class="d-flex justify-content-between">
                                  <span>{{ $option->text }}</span>
                                  <span>{{ $option->percentage }}%</span>
                              </div>
                              <div class="progress" style="height: 8px;">
                                  <div class="progress-bar bg-danger" style="width: {{ $option->percentage }}%"></div>
                              </div>
                          </div>
                          @endforeach
                      </div>
                      <form action="{{ route('polls.vote', $poll) }}" method="POST">
                          @csrf
                          <div class="poll-options">
                              @foreach($poll->options as $option)
                              <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="option" id="option{{ $option->id }}" value="{{ $option->id }}">
                                  <label class="form-check-label" for="option{{ $option->id }}">
                                      {{ $option->text }}
                                  </label>
                              </div>
                              @endforeach
                          </div>
                          <button type="submit" class="btn btn-danger btn-sm mt-2">Voter</button>
                      </form>
                      
                      <div class="poll-meta mt-3">
                          <small class="text-muted">{{ $poll->votes_count }} votes • Clôture dans </small>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
      </div>
  </div>
</section>

<!-- Section Membres -->
<!-- Section Conseil d'Administration -->
<section class="board-section py-5" style="background: #faf6f0;">
  <div class="container">
      <h2 class="text-center mb-5" style="color: #A12C2F; position: relative;">
          Notre Conseil d'Administration
          <div style="position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background: #D4AF37;"></div>
      </h2>

      <div class="row g-4">
          <!-- Membre 1 -->
          <div class="col-12 col-md-6 col-lg-4 col-xl-3">
              <div class="member-card card h-100 border-0 shadow-lg">
                  <div class="card-img-top position-relative overflow-hidden" style="height: 300px;">
                      <img src="{{asset('assets\images\team-1.jpg')}}" class="w-100 h-100 object-fit-cover" alt="Président ANEEPES">
                      <div class="member-overlay" style="background: linear-gradient(transparent 60%, rgba(161,44,47,0.9));"></div>
                  </div>
                  <div class="card-body text-center">
                      <h5 class="card-title" style="color: #A12C2F;">John Doe</h5>
                      <p class="text-uppercase small mb-3" style="color: #D4AF37; letter-spacing: 1px;">Président National</p>
                      <div class="social-links d-flex justify-content-center gap-3">
                          <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                              <i class="fab fa-twitter"></i>
                          </a>
                          <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                              <i class="fab fa-linkedin"></i>
                          </a>
                          <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                              <i class="fas fa-envelope"></i>
                          </a>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Membre 2 -->
          <div class="col-12 col-md-6 col-lg-4 col-xl-3">
              <div class="member-card card h-100 border-0 shadow-lg">
                  <div class="card-img-top position-relative overflow-hidden" style="height: 300px;">
                      <img src="{{asset('assets\images\team-1.jpg')}}" class="w-100 h-100 object-fit-cover" alt="Vice-Présidente">
                      <div class="member-overlay" style="background: linear-gradient(transparent 60%, rgba(161,44,47,0.9));"></div>
                  </div>
                  <div class="card-body text-center">
                      <h5 class="card-title" style="color: #A12C2F;">Jane Smith</h5>
                      <p class="text-uppercase small mb-3" style="color: #D4AF37; letter-spacing: 1px;">Vice-Présidente</p>
                      <div class="social-links d-flex justify-content-center gap-3">
                          <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                              <i class="fab fa-twitter"></i>
                          </a>
                          <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                              <i class="fab fa-linkedin"></i>
                          </a>
                          <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                              <i class="fas fa-envelope"></i>
                          </a>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Ajouter les autres membres de la même manière -->
      </div>
  </div>
</section>

<!-- Section CTA -->
<section class="cta-section bg-danger text-white py-5">
  <div class="container text-center">
      <h2 class="mb-4">Rejoignez notre communauté</h2>
      <div class="d-flex justify-content-center gap-3">
          <a href="{{ route('events.index') }}" class="btn btn-outline-light">Voir tous les événements</a>
          <a href="" class="btn btn-gold">Découvrir les clubs</a>
      </div>
  </div>
</section>

@endsection

@section('extra-script')
<script>
// Initialisation du compte à rebours
function updateCountdown() {
    const countdownElements = document.querySelectorAll('.countdown-timer');
    
    countdownElements.forEach(element => {
        const targetDate = new Date(element.parentElement.dataset.date);
        const now = new Date();
        const difference = targetDate - now;

        const days = Math.floor(difference / (1000 * 60 * 60 * 24));
        const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

        element.querySelector('.days').textContent = days.toString().padStart(2, '0');
        element.querySelector('.hours').textContent = hours.toString().padStart(2, '0');
    });
}

setInterval(updateCountdown, 1000);
updateCountdown();
</script>
@endsection
