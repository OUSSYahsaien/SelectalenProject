 <!DOCTYPE html>
 <html lang="es">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>@yield('title', 'Candidato - Portal')</title>
     <link rel="stylesheet" href="{{ asset('css/candidat.css') }}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 </head>
 <body>
     <div class="container">
         <!-- Sidebar -->
         <aside class="sidebar">
             <div class="logo">
                <img src="{{ asset('images/logo/logo2.png') }}" alt="Talent Select Logo">
                <i class="fa-solid fa-xmark"></i>
             </div>

             <nav>
                 <ul class="nav-menu">
                     <li class="nav-item">
                         <a draggable="false" href="{{ route('candidat.dashboard') }}" class="nav-link {{ Request::is('candidat/dashboard') ? 'active' : '' }}">
                             <i class="fas fa-home"></i>
                             Inicio
                         </a>
                     </li>
                     <li class="nav-item">
                         <a draggable="false" href="{{ route('candidat.offers') }}" class="nav-link {{ Request::is('candidat/offers') ? 'active' : '' }}">
                             <i class="fas fa-file-alt"></i>
                             Mis solicitudes
                         </a>
                     </li>
                     <li class="nav-item">
                         <a draggable="false" href="{{ route('candidat.search.offers') }}" class="nav-link {{ Request::is('candidat/ofertas') ? 'active' : '' }}">
                             <i class="fas fa-search"></i>
                             Ver ofertas
                         </a>
                     </li>
                     <li class="nav-item">
                         <a draggable="false" href="{{ route('candidat.profile') }}" class="nav-link {{ Request::is('candidat/profile') || Request::is('candidat/edit/profile') ? 'active' : '' }}">
                             <i class="fas fa-user"></i>
                             Mi perfil
                         </a>
                     </li>
                     <li class="nav-item">
                         <form method="POST" action="{{ route('candidat.logout') }}" style="margin: 0;">
                             @csrf
                             <button onclick="changeColor(this)" type="submit" class="nav-link logout-button">
                                 <i class="fa fa-power-off" aria-hidden="true"></i>
                                 Logout
                             </button>
                         </form>
                     </li>
                 </ul>
                 <hr>
             </nav>
 
             <!-- Profile Section -->
                <div class="profile-section">
                    @php
                        $personalPicturePath = 'images/candidats_images/' . Auth::user()->personal_picture_path;
                    @endphp
                    @if (Auth::user()->personal_picture_path && file_exists(public_path($personalPicturePath)))
                        <img src="{{ asset($personalPicturePath) }}" alt="Foto de perfil" class="profile-picture">
                    @else
                        <img src="{{ asset('images/Avatar.png') }}" alt="Foto de perfil" class="profile-picture">
                    @endif
                    <div class="profile-infor">
                        <span class="profile-name">{{ Auth::user()->first_name . " " . Auth::user()->last_name  }}</span>
                        <span class="profile-email">{{ Auth::user()->email }}</span>
                    </div>
                </div>
         </aside>
 
            <!-- Main Content -->
            <main class="main-content">
                <header class="header">
                    <button class="toggle-sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title-c">@yield('page-title', 'Bienvenido')</h1>
                    <div class="right-section">
                        <a href="{{ route('candidat.login') }}" class="web-link">Volver a la página web</a>
                        <i class="fa-regular fa-bell"></i>
                    </div>
                </header>
                
                <!-- Contenu spécifique à la page -->
                <div class="content">
                    @yield('content')
                </div>
            </main>        
     </div>
 
     {{-- <script src="{{ asset('js/candidats.js') }}"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.querySelector('.toggle-sidebar');
            const closeButton = document.querySelector('.fa-xmark');
            const sidebar = document.querySelector('.sidebar');

            // Fonction pour ouvrir la sidebar
            const openSidebar = () => {
                sidebar.classList.remove('closed');
                sidebar.classList.add('open');
            };

            // Fonction pour fermer la sidebar
            const closeSidebar = () => {
                sidebar.classList.remove('open');
                sidebar.classList.add('closed');
            };

            // Gestionnaire d'événement pour le bouton d'ouverture
            toggleButton.addEventListener('click', openSidebar);

            // Gestionnaire d'événement pour le bouton de fermeture
            closeButton.addEventListener('click', closeSidebar);

            // Fermer la sidebar en cliquant en dehors
            document.addEventListener('click', (e) => {
                const isClickInsideSidebar = sidebar.contains(e.target);
                const isClickOnToggleButton = toggleButton.contains(e.target);
                
                if (!isClickInsideSidebar && !isClickOnToggleButton && sidebar.classList.contains('open')) {
                    closeSidebar();
                }
            });
        });
    </script>
    
    
      
 </body>
 </html>
 