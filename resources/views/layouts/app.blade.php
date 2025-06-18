<!DOCTYPE html>
<html lang="pt-BR" class="h-100">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title', 'Novotel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Novotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Olá, {{ auth()->user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        @if(auth()->user()->isStaff())
                            <a class="nav-link" href="{{ route('staff.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout Staff
                            </a>
                            <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a class="nav-link" href="{{ route('client.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout Cliente
                            </a>
                            <form id="logout-form" action="{{ route('client.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endif
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('client.login') }}">Sou Cliente</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('staff.login') }}">Sou Colaborador</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="flex-grow-1 container py-4">
    @yield('content')
</main>

@include('components.footer')

<!-- JS compilado -->
<script src="{{ asset('js/app.js') }}" defer></script>
@stack('scripts')
</body>
</html>
