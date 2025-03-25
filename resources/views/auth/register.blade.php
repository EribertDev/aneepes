@extends('master')
@section('title', 'Register') 
@section('extra-style')
<style>
    .x-text-input {
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease;
    }

    .x-text-input:focus {
        border-color: #A12C2F;
        box-shadow: 0 0 0 3px rgba(161,44,47,0.1);
    }

    .x-primary-button {
        border-radius: 8px;
        transition: all 0.2s ease;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
   <!-- Header Start -->
   <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
         
          <h2>Nous Rejoindre</h2>
        </div>
      </div>
    </div>
  </section>
<!-- Header End -->
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6 space-y-6 mt-5">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-[#A12C2F] mb-2">Créer un compte</h2>
            <p class="text-gray-600">Rejoignez la communauté ANEEPES</p>
        </div>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Avatar Upload -->
            <div class="flex flex-col items-center">
                <div class="relative w-24 h-24 mb-4">
                    <img id="avatarPreview" class="w-full h-full rounded-full object-cover border-2 border-[#D4AF37]" 
                         src="https://ui-avatars.com/api/?name=New+User&background=A12C2F&color=fff" 
                         alt="Avatar preview">
                    <label for="avatar" class="absolute bottom-0 right-0 bg-[#D4AF37] p-1 rounded-full cursor-pointer">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </label>
                    <input id="avatar" type="file" name="avatar" class="hidden" accept="image/*">
                </div>
                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
            </div>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nom complet')" />
                <x-text-input 
                    id="name" 
                    class="block mt-1 w-full focus:ring-2 focus:ring-[#A12C2F] focus:border-[#A12C2F]" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input 
                    id="email" 
                    class="block mt-1 w-full focus:ring-2 focus:ring-[#A12C2F]" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Téléphone -->
            <div>
                <x-input-label for="phone" :value="__('Téléphone')" />
                <x-text-input 
                    id="phone" 
                    class="block mt-1 w-full focus:ring-2 focus:ring-[#A12C2F]" 
                    type="tel" 
                    name="phone" 
                    :value="old('phone')" 
                    required 
                    pattern="[0-9]{10}" 
                    placeholder="229 12345678" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input 
                    id="password" 
                    class="block mt-1 w-full focus:ring-2 focus:ring-[#A12C2F]"
                    type="password"
                    name="password"
                    required 
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                <x-text-input 
                    id="password_confirmation" 
                    class="block mt-1 w-full focus:ring-2 focus:ring-[#A12C2F]"
                    type="password"
                    name="password_confirmation" 
                    required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-[#A12C2F] hover:text-[#8a1f22] underline" href="{{ route('login') }}">
                    Déjà inscrit ?
                </a>

                <x-primary-button class="bg-[#A12C2F] hover:bg-[#8a1f22] focus:ring-2 focus:ring-[#D4AF37] px-6 py-2">
                    S'inscrire
                </x-primary-button>
            </div>
        </form>
    </div>

@endsection

@section('extra-script')
<script>
    // Gestion de la prévisualisation de l'avatar
    document.getElementById('avatar').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        }
        reader.readAsDataURL(this.files[0]);
    });
</script>
@endsection
