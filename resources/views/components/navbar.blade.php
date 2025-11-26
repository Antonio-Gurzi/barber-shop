<nav class="navbar navbar-expand-lg bg-black" data-bs-theme="dark">
    <div class="container-fluid">
        <!-- <a class="navbar-brand text-white" href="{{ route('homepage') }}">Logo</a> -->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('service') }}">Servizi</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Chi sono</a></li>

                @if(auth()->user() && auth()->user()->role === 'admin')
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.appointments') }}">Tutti gli appuntamenti</a></li>
                @endif
                @if(auth()->user() && auth()->user()->role === 'client')
                    <li class="nav-item"><a class="nav-link" href="{{ route('client.index') }}">I tuoi appuntamenti</a></li>
                @endif
            </ul>

            
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link bg-success rounded-2 text-white px-3" href="{{ route('appointment.create') }}">
                        Prenota
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                            aria-expanded="false">Benvenuto {{ auth()->user()->name }}</a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <form class="px-3 py-1" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger p-0 m-0">Logout</button>
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
