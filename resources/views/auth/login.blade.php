@extends('master')
@section('title', 'Login')
@section('extra-style')
<style>
    .card {
        border-radius: 15px;
        border: 1px solid rgba(161, 44, 47, 0.1);
    }
    
    .form-control:focus {
        border-color: #D4AF37;
        box-shadow: 0 0 0 0.25rem rgba(161, 44, 47, 0.25);
    }
    
    .input-group-text {
        background-color: #f8f9fa;
    }
    
    .btn-outline-secondary:hover {
        background-color: #D4AF37;
        border-color: #D4AF37;
    }
</style>
@endsection
@section('content')
     <!-- Header Start -->
     <section class="heading-page header-text" id="top">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
             
              <h2>Connexion</h2>
            </div>
          </div>
        </div>
      </section>
    <!-- Header End -->
    
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <!-- Logo -->
                        <div class="text-center mb-5">
                            <img src="{{asset('assets/images/anepes-logo.jpg')}}" alt="ANEEPES Logo" style="height: 50px; width:50px" class="mb-4">
                            <h2 class="fw-bold mb-3" style="color: #A12C2F;">Connexion à l'espace membre</h2>
                            <p class="text-muted">Accédez à votre tableau de bord</p>
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="alert alert-info" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Input -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold" style="color: #A12C2F;">Adresse Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-envelope" style="color: #A12C2F;"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control border-start-0 py-3" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           autofocus
                                           placeholder="exemple@aneepes.bj">
                                </div>
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold" style="color: #A12C2F;">Mot de passe</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-lock" style="color: #A12C2F;"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control border-start-0 py-3" 
                                           id="password" 
                                           name="password" 
                                           required
                                           placeholder="••••••••">
                                    <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember" style="accent-color: #A12C2F;">
                                    <label class="form-check-label text-muted" for="remember_me">
                                        Se souvenir de moi
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: #A12C2F;">
                                        Mot de passe oublié ?
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn w-100 py-3 text-white fw-bold" 
                                    style="background-color: #A12C2F; border-radius: 8px; transition: all 0.3s;">
                                Se connecter
                                <i class="fas fa-sign-in-alt ms-2"></i>
                            </button>

                            <!-- Registration Link -->
                            <div class="text-center mt-4">
                                <p class="text-muted">Pas encore membre ? 
                                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #D4AF37;">
                                        Créer un compte
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra-script')
<script>
    // Toggle Password Visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        icon.classList.toggle('fa-eye-slash');
    });
</script>
@endsection
