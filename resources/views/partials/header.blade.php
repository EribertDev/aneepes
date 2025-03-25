<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky" style="background-color: #a12c2f;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('assets/images/anepes-logo.jpg') }}" alt="" style="width: 70px; height: 70px;">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav ">
                        <li class="nav-link hover-gold"><a href="{{ route('home') }}" class="active">Acceuil</a></li>
                        <li class="nav-link hover-gold"><a href="{{ route('about') }}">A propos</a></li> 
                        <li class="nav-link hover-gold"><a href="{{route('event')}}">Evenements</a></li>
                        
                           
                            
                    <li class="nav-link hover-gold"><a href="{{ route('actualites') }}">Actualités</a></li>
                               
                         
                    
                        <li class="nav-link hover-gold"><a href="{{ route('blog') }}">Blog</a></li>
                        <li class="nav-link hover-gold"><a href="{{ route('sondage') }}">Sondage</a></li>
                        <li class="nav-link hover-gold"><a href="{{ route('contact') }}">Contact</a></li> 
                       
                        <li> 
                            <div class="user-section">
                                @auth
                                <div class="user-dropdown">
                                    <div class="user-avatar">
                                        <img src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : asset('default-avatar.jpg') }}" 
                                             alt="{{ Auth::user()->name }}" 
                                             class="avatar-img">
                                    </div>
                                    <div class="dropdown-content">
                                        <div class="user-info">
                                            <h6>{{ Auth::user()->name }}</h6>
                                            <small>{{ Auth::user()->email }}</small>
                                        </div>
                                        <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                    </div>
                                </div>
                                @else
                                <div class="auth-buttons">
                                    <a href="{{ route('login') }}" class="btn btn-gold btn-sm">
                                        <i class="bi bi-box-arrow-in-right"></i> Connexion
                                    </a>
                                
                                </div>
                                @endauth
                            </div>
                        </li>
                    </ul> 
                 <!-- Menu Mobile -->
                 <a class='menu-trigger'>
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>


<style>
    .header-area {
        padding: 1rem 0;
        transition: all 0.3s ease;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .nav-link {
        color: white !important;
        padding: 0.8rem 1.2rem !important;
        transition: all 0.3s ease;
    }

    .hover-gold:hover {
        color: #D4AF37 !important;
        transform: translateY(-2px);
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .dropdown-item {
        padding: 0.8rem 1.5rem;
        transition: all 0.2s ease;
    }

    .user-dropdown {
        position: relative;
        cursor: pointer;
    }

    .avatar-img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 2px solid #D4AF37;
        padding: 2px;
        transition: transform 0.3s ease;
    }

    .user-dropdown:hover .avatar-img {
        transform: scale(1.1);
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background: white;
        min-width: 200px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .user-dropdown:hover .dropdown-content {
        display: block;
    }

    .user-info {
        padding: 1rem;
        border-bottom: 1px solid #eee;
    }

    .btn-gold {
        background: #D4AF37;
        color: white;
        border: none;
        padding: 0.5rem 1.2rem;
        border-radius: 25px;
    }

    .btn-outline-gold {
        border: 2px solid #D4AF37;
        color: #D4AF37;
        background: transparent;
    }

    .menu-trigger {
        display: none;
    }

    @media (max-width: 992px) {
        .main-menu {
            display: none !important;
        }
        
        .menu-trigger {
            display: block;
        }
        
        .burger-line {
            display: block;
            width: 25px;
            height: 3px;
            background: white;
            margin: 5px 0;
            transition: all 0.3s ease;
        }
    }
</style>
<!-- ***** Header Area End ***** -->