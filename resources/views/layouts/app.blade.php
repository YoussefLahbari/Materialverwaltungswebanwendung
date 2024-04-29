<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Youssef Lahbari">
    <script src="{{asset('js/xlsx.full.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    {{-- <script src="{{asset('js/jspdf.umd.min.js')}}"></script> --}}


    <title>{{ config('app.name') }}</title>

    {{-- Logo --}}
    <link rel="icon" href="{{ asset('Coat-of-arms-of-Morocco-01.png') }}" type="image/x-icon"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>

        .navbar-brand, .nav-link {
            display: flex;
            white-space: nowrap;
            align-items: center; /* Vertically align content */
            padding: 1%
        }

       
    </style>
</head>
<body>
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm header">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('Coat-of-arms-of-Morocco-01.png') }}" alt="Logo" class="logo-img me-2" style="width: 5%">
                    Préfecture Marrakech
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item col">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __("S'inscrire") }}</a>
                                </li>
                            @endif
                        @else
                            @if( Auth::user()->usertype == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ajouteruserUI') }}">
                                    Ajouter Utilisateur
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('step.zero') }}">
                                    Ajouter Matériel
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('home') }}">
                                    Tableau de bord
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    Acceuil
                                </a>
                            </li>
                            @endif
                            <li class="nav-item dropdown " >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Deconnection') }}
                                    </a>
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        {{ __('Profile') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
             <!-- Modal -->
             {{-- <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Modifier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Your form inputs go here -->
                            <form>
                                
                                <div class="mb-3">
                                    <label for="prefecture" class="form-label">Developer :</label>
                                    <input type="text" class="form-control" id="prefecture" value="YOUSSEF LAHBARI" readonly>
                                    <hr>
                                    <label>Cette fonctionalité n'est pas encore terminé, <br> 
                                        Merci de me contacter sur whatsapp: 0684797079</label>
                                </div>
                                <!-- Add more form inputs as needed -->
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Compris !</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>        --}}
            @yield('content')
        </main>
    </div>
    <!-- Any additional JavaScript scripts -->
    @yield('scripts')
    <footer class="text-center py-3 ">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col">
                    <p class="text-muted my-2">Copyright © 2024</p>
                </div>
                <div class="col">
                    <ul class="list-inline my-2">
                        <li class="list-inline-item me-4">
                            <a href="https://www.facebook.com/lbr.youssef"><div class="bs-icon-circle bs-icon-primary bs-icon"><svg class="bi bi-facebook" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"></path>
                                </svg></div></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/in/yousseflahbari/">
                                <div class="bs-icon-circle bs-icon-primary bs-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                                      </svg>
                                </div>
                            </a>
                        </li>
                        
                        
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-inline my-2">
                        <li class="list-inline-item"><a class="link-secondary" >Privacy Policy</a></li>
                        <li class="list-inline-item"><a class="link-secondary" >Terms of Use</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
