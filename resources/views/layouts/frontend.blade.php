<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <link href="{{asset('images/logo.png')}}" rel="icon" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title> Ejemplo 1 - @yield('title')</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                font-size: 3.5rem;
                }
            }
        </style>
        <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet" />
        <link href="{{asset('css/blog.css')}}?id={{ csrf_token() }}" rel="stylesheet" />
        <link href="{{asset('css/jquery.alerts.min.css')}}" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{asset('fontawesome-5-8/css/all.css')}}" />
        @stack('css')
    </head>
<body>

    <div class="container">
        <header class="border-bottom lh-1 py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="link-secondary" href="#">Subscribe</a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-body-emphasis text-decoration-none" href="{{route('template_inicio')}}">
                    <img src="{{asset('images/logo.png')}}" style="width: 100px;"/>
                </a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="link-secondary" href="#" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
                </a>
                <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
            </div>
            </div>
        </header>

        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-between">
            <a class="nav-item nav-link link-body-emphasis active" href="{{route('template_inicio')}}">Home</a>
            <a class="nav-item nav-link link-body-emphasis" href="{{route('formulario_inicio')}}">Formulario</a>
            <a class="nav-item nav-link link-body-emphasis" href="{{route('helper_inicio')}}">Helper</a>
            <a class="nav-item nav-link link-body-emphasis" href="{{route('email_inicio')}}">Email</a>
            <a class="nav-item nav-link link-body-emphasis" href="{{route('bd_inicio')}}">BDD MySQL</a>
            </nav>
        </div>
    </div>

    
    <main class="container">
        <!-- Content -->
        @yield('content')
        <!-- Content -->
    </main>

    <footer class="blog-footer">
        <p>Todos los derechos reservados - Desarrollado por <a href="https://github.com/GuillermoPlisich07" target="_blank">Guillermo Plisich</a>.
        <!-- <p class="mb-0">
            <a href="#">Back to top</a>
        </p> -->
    </footer>

    <script src="{{asset('js/jquery-2.0.0.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/jquery.alerts.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/funciones.js')}}"></script>
    @stack('js')
</body>
</html>