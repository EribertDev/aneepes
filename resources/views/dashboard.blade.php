<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/anepes-logo.jpg') }}" type="image/x-icon">
    <meta name="description" content="ANEEPES Admin Dashboard">
    <meta name="keywords" content="ANEEPES, Admin, Dashboard, Management">
    <meta name="author" content="ANEEPES Team">
    <meta name="theme-color" content="#A12C2F">
    <meta name="application-name" content="ANEEPES Admin">
    <meta name="apple-mobile-web-app-title" content="ANEEPES Admin">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-TileColor" content="#A12C2F">
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/anepes-logo.jpg') }}">
    <title>ANEEPES Admin - @yield('title')</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.2"></script>
    
    <style>
        :root {
            --primary-color: #A12C2F;
            --accent-color: #D4AF37;
            --sidebar-width: 280px;
        }
        

        .main-sidebar {
            background: #2a2a2a;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-sidebar .nav-item:hover .nav-link {
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-sidebar .nav-link.active {
            background: var(--primary-color);
            border-left: 4px solid var(--accent-color);
        }

        .brand-link {
            background: var(--primary-color);
            border-bottom: 2px solid var(--accent-color);
        }

        .content-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }
    </style>
    @yield('extra-style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars" style="color: var(--primary-color);"></i>
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          
            
            <!-- User Menu -->

           
            
            @if(Auth::check())

              <div class="col-md-6 text-md-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown">
                                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}" 
                                alt="Avatar de {{ auth()->user()->name }}" 
                                class="rounded-circle"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><i class="fas fa-sign-out-alt me-2"> <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            
                 
            @else
                 <div class="auth-links">
                     <a href="{{ route('login') }}" style="color: #fff;">Login</a>
                 </div>
                 
             @endif 



        
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/admin" class="brand-link">
            <img src="{{asset('assets/images/anepes-logo.jpg')}}" alt="ANEEPES Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">PANEL ADMIN</span>
        </a>

        <!-- Sidebar Menu -->
        <div class="sidebar">
            <nav class="mt-4">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Tableau de bord</p>
                        </a>
                    </li>
            
                    
  
                    <li class="nav-item">
                        <a href="{{route('staff')}}" class="nav-link {{ request()->is('staff') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Gestion des utilisateurs</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('members.index')}}" class="nav-link {{ request()->is('members') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Gestion des membres</p>
                        </a>
                    </li>

                      <li class="nav-item">
                        <a href="{{route('subscription')}}" class="nav-link {{ request()->is('subscription') ? 'active' : '' }}">
                            <i class="nav-icon fas  fa-money-check-alt"></i>
                            <p>Subscription</p>
                        </a>
                    </li>
                
             
                    <li class="nav-item">
                        <a href="{{route('events.index')}}" class="nav-link {{ request()->is('admin/evenements*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Événements</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('news.index') }}" class="nav-link {{ request()->is('news/index') ? 'active' : '' }}">
                            <i class="nav-icon fas  fa-bullhorn"></i>
                            <p>Actualités</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.polls.index') }}" class="nav-link {{ request()->is('admin/polls/index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-poll-h"></i>
                            <p>Sondage</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('subscriptions.index') }}" class="nav-link {{ request()->is('/cotisations') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>Payer ma cotisation</p>
                        </a>
                    </li>
                    

               
                     <li class="nav-item">
                        <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->is('admin/posts*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>Blog</p>
                        </a>
                   </li>
             
                    

                    <!-- Additional Menu Items -->
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('page-title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>


        





    </div>

    <!-- Footer -->
  
</style>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@yield('extra-scripts')
</body>
</html>