<nav class="navbar navbar-expand-lg bg-black" data-bs-theme="dark">
    <div class="container-fluid text-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{route('homepage')}}">home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('service')}}">servizi</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="#">negozio</a></li> -->
                <li class="nav-item"><a class="nav-link" href="{{ route('appointment.create') }}">Prenota</a></li>
                @if(auth()->user() && auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.appointments') }}">Tutti gli appuntamenti</a>
                </li>
                @endif
                @if(auth()->user() && auth()->user()->role === 'client')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.index') }}">I tuoi appuntamenti</a>
                </li>
                @endif

            </ul>
        </div>

        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">Benvenuto {{auth()->user()->name}}</a>
            <div class="dropdown-menu">
                <!-- <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a> -->
                <!-- <div class="dropdown-divider"></div> -->

                <form class="nav-link d-flex justify-content-center" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn m-0 p-0 text-danger">Logout</button>
                </form>
            </div>
        </li>
        @endauth

    </div>
</nav>