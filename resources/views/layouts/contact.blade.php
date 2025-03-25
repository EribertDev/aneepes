@extends('master')

@section('extra-style')
<style>
  .contact-hero {
      background: linear-gradient(rgba(161, 44, 47, 0.9), rgba(161, 44, 47, 0.9)),
                  url('https://source.unsplash.com/1920x600/?contact') center/cover;
      padding: 100px 0;
  }

  .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.4);
  }

  .contact-form-card {
      transition: transform 0.3s ease;
      border-radius: 1rem;
  }

  .hover-lift:hover {
      transform: translateY(-10px);
  }

  .contact-info-card {
      position: relative;
      overflow: hidden;
      background: #A12C2F;
  }

  .contact-info-card::before {
      content: '';
      position: absolute;
      top: -50px;
      right: -50px;
      width: 100px;
      height: 100px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
  }

  .icon-box {
      width: 45px;
      height: 45px;
      display: flex;
      align-items: center;
      justify-content: center;
  }

  .form-control {
      border-width: 2px;
  }

  .form-control:focus {
      border-color: #D4AF37;
      box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
  }

  .map-container {
      height: 450px;
      border-radius: 1rem;
      border: 3px solid #A12C2F;
  }
</style>

@endsection
@section('content')
<section class="contact-hero bg-dark position-relative">
    <div class="container position-relative z-index-1">
        <div class="row justify-content-center text-center py-8">
            <div class="col-lg-10">
                <h1 class="display-3 text-white mb-4 animate__animated animate__fadeInDown">Contactez-nous</h1>
                <p class="lead text-light opacity-75 animate__animated animate__fadeInUp">Nous sommes à votre écoute 24h/24</p>
            </div>
        </div>
    </div>
    <div class="hero-overlay"></div>
</section>

<section class="contact-main py-6">
    <div class="container">
        <div class="row g-5">
            <!-- Formulaire -->
            <div class="col-lg-7">
                <div class="card contact-form-card border-0 shadow-lg hover-lift">
                    <div class="card-body p-5">
                      @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                      @endif
                        <h2 class="mb-4 text-danger">Envoyez-nous un message</h2>
                        
                        <form id="contactForm" method="POST" action="{{route('contact.submit')}}">
                            @csrf
                            
                            <div class="row g-4">
                                <!-- Nom -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control border-danger @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name"
                                               placeholder="Votre nom"
                                               required>
                                        <label for="name" class="text-muted">
                                            <i class="fas fa-user me-2 text-danger"></i>Votre nom complet
                                        </label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" 
                                               class="form-control border-danger @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email"
                                               placeholder="name@example.com"
                                               required>
                                        <label for="email" class="text-muted">
                                            <i class="fas fa-envelope me-2 text-danger"></i>Adresse email
                                        </label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Sujet -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control border-danger @error('subject') is-invalid @enderror" 
                                               id="subject" 
                                               name="subject"
                                               placeholder="Sujet"
                                               required>
                                        <label for="subject" class="text-muted">
                                            <i class="fas fa-tag me-2 text-danger"></i>Sujet du message
                                        </label>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control border-danger @error('message') is-invalid @enderror" 
                                                  id="message" 
                                                  name="message"
                                                  placeholder="Votre message"
                                                  style="height: 150px"
                                                  required></textarea>
                                        <label for="message" class="text-muted">
                                            <i class="fas fa-comment-dots me-2 text-danger"></i>Votre message
                                        </label>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Bouton -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-danger btn-lg px-5 py-3">
                                        <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Informations de contact -->
            <div class="col-lg-5">
                <div class="contact-info-card bg-danger text-white rounded-3 p-5 shadow-lg">
                    <h3 class="text-white mb-5"><i class="fas fa-map-marker-alt me-2"></i>Nos coordonnées</h3>
                    
                    <ul class="list-unstyled">
                        <!-- Téléphone -->
                        <li class="d-flex mb-4">
                            <div class="icon-box bg-white text-danger rounded-circle me-3">
                                <i class="fas fa-phone fa-lg"></i>
                            </div>
                            <div>
                                <h5>Téléphone</h5>
                                <a href="tel:+1234567890" class="text-white">+1 (234) 567-890</a>
                            </div>
                        </li>

                        <!-- Email -->
                        <li class="d-flex mb-4">
                            <div class="icon-box bg-white text-danger rounded-circle me-3">
                                <i class="fas fa-envelope fa-lg"></i>
                            </div>
                            <div>
                                <h5>Email</h5>
                                <a href="mailto:contact@anepes.com" class="text-white">contact@anepes.com</a>
                            </div>
                        </li>

                        <!-- Adresse -->
                        <li class="d-flex mb-4">
                            <div class="icon-box bg-white text-danger rounded-circle me-3">
                                <i class="fas fa-map-marked-alt fa-lg"></i>
                            </div>
                            <div>
                                <h5>Adresse</h5>
                                <address class="mb-0">123 Rue de l'Innovation<br>75000 Paris, France</address>
                            </div>
                        </li>

                        <!-- Horaires -->
                        <li class="d-flex">
                            <div class="icon-box bg-white text-danger rounded-circle me-3">
                                <i class="fas fa-clock fa-lg"></i>
                            </div>
                            <div>
                                <h5>Horaires</h5>
                                <p class="mb-0">Lun-Ven : 8h-19h<br>Samedi : 9h-17h</p>
                            </div>
                        </li>
                    </ul>

                    <!-- Réseaux sociaux -->
                    <div class="social-links mt-5 pt-3">
                        <h5 class="mb-3">Suivez-nous</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-linkedin fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte -->
        <div class="row mt-6">
            <div class="col-12 mt-3">
                <div class="map-container rounded-3 overflow-hidden shadow-lg">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9916256937596!2d2.292292615509614!3d48.85837007928746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1624458165787!5m2!1sfr!2sfr" 
                            width="100%" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection