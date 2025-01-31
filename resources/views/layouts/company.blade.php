 <!DOCTYPE html>
 <html lang="es">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>@yield('title', 'Company - Portal')</title>
     <link rel="stylesheet" href="{{ asset('css/Company/layout/company.css') }}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <lnk rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
 <body>
     <div class="container">
         <!-- Sidebar -->
         <aside class="sidebar">
             <div class="logo" style="display: flex;">
                <img src="{{ asset('images/logo/logo2.png') }}" alt="Talent Select Logo">
                <div class="close-sidebar-btn" style=" margin-left: 63px; margin-top: 9px;">
                    <i class="fa-solid fa-xmark" style=" font-size: 24px; color: #3064FE;"></i>
                </div>
             </div>

             <nav>
                 <ul class="nav-menu">
                     <li class="nav-item">
                         <a draggable="false" href="{{ route('company.dashboard') }}" class="nav-link {{ Request::is('company/dashboard') ? 'active' : '' }}">
                             <i class="fas fa-home"></i>
                             Inicio
                         </a>
                     </li>
                     <li class="nav-item">
                         <a draggable="false" href="{{ route('company.my.offers') }}" class="nav-link {{ Request::is('company/myOffers') || Request::is('company/offers/*') ? 'active' : '' }}">
                             <i class="fas fa-file-alt"></i>
                             Mis solicitudes
                         </a>
                     </li>
                     {{-- <li class="nav-item">
                         <a draggable="false" href="{{ route('candidat.search.offers') }}" class="nav-link {{ Request::is('candidat/ofertas') ? 'active' : '' }}">
                             <i class="fas fa-search"></i>
                             Ver ofertas
                         </a>
                     </li> --}}
                     <li class="nav-item">
                         <a draggable="false" href="{{ route('company.profile') }}" class="nav-link {{ Request::is('company/profile') || Request::is('company/edit-profile') || Request::is('company/add-in-equipe') || Request::is('company/view-team-member/*')  || Request::is('company/edit-team-member/*') ? 'active' : ''}}">
                             <i class="fas fa-user"></i>
                             Mi perfil de empresa
                         </a>
                     </li>
                     <li class="nav-item">
                         <form method="POST" action="{{ route('company.logout') }}" style="margin: 0;">
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
                        $personalPicturePath = 'images/companies_images/' . Auth::user()->personel_pic;
                        $personalDefaultPicturePath = 'images/companies_images/100x100.svg';
                    @endphp
                    @if (Auth::user()->personel_pic && file_exists(public_path($personalPicturePath)))
                        <img src="{{ asset($personalPicturePath) }}" alt="Foto de perfil" class="profile-image">
                    @else
                        <img src="{{ asset($personalDefaultPicturePath) }}" alt="Foto de perfil" class="profile-image">
                    @endif
                    <div class="profile-info">
                        <span class="profile-name">
                            @php
                                $responsable = App\Models\TeamMember::where('company_id', Auth::user()->id)
                                                                    ->where('role', 'responsable')
                                                                    ->first();
                            @endphp
                        
                            {{ $responsable ? $responsable->full_name : '' }}
                        </span>
                        
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
                
                {{-- <hr style="margin-top: -30px; width: 100%; color: #D6DDEB;"> --}}
            
                <!-- Contenu spécifique à la page -->
                <div class="content">
                    @yield('content')
                </div>
            </main>        
     </div>
 
     <script src="{{ asset('js/candidats.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
          const toggleButton = document.querySelector('.toggle-sidebar');
          const sidebar = document.querySelector('.sidebar');
      
          toggleButton.addEventListener('click', () => {
            sidebar.classList.remove('closed');
            sidebar.classList.toggle('open');
          });
        });
      </script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const closeButton = document.querySelector('.close-sidebar-btn'); // Bouton pour fermer
        const sidebar = document.querySelector('.sidebar'); // Élément sidebar
    
        // Fonction pour fermer la sidebar
        closeButton.addEventListener('click', () => {
            sidebar.classList.remove('open');
            sidebar.classList.toggle('closed'); // Basculer la classe 'closed' pour masquer/afficher
        });
        });
    </script>
   --}}



  
  <script>
    document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.querySelector('.toggle-sidebar');
    const closeButton = document.querySelector('.close-sidebar-btn');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    const header = document.querySelector('.header');

    function toggleSidebar() {
        sidebar.classList.toggle('open');
        document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
    }

    toggleButton.addEventListener('click', toggleSidebar);
    closeButton.addEventListener('click', toggleSidebar);

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 1170 &&
            !sidebar.contains(e.target) &&
            !toggleButton.contains(e.target) &&
            sidebar.classList.contains('open')) {
            toggleSidebar();
        }
    });
});
  </script>
  
  
  
      
 </body>
 </html>
 