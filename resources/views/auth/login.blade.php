<x-layout>
    <x-slot:titleTab>Accedi</x-slot:titleTab>

    <div class="container d-flex justify-content-center align-items-center py-4 py-md-5">
        <div class="card-form shadow-lg border-0 rounded-4 w-100" style="max-width: 500px;">
            <div class="card-body p-3 p-md-4">
                <h2 class="text-center mb-4 fw-bold text-primary">Accedi</h2>

                <form method="POST" action="{{ route('login') }}" class="text-center">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Indirizzo Email</label>
                        <input type="email" class="form-control rounded-pill mx-auto" id="email" name="email" placeholder="tuamail@example.it" required>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control rounded-pill mx-auto" id="password" name="password" placeholder="Inserisci la tua password" required autocomplete="off">
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <x-flash />

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-success rounded-pill shadow-sm">
                            Accedi
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="text-center d-flex flex-column gap-3">
        <a href="{{route('register')}}" class="text-decoration-none">Non sei registrato?Clicca qui</a>
        <a href="{{route('password.request')}}" class="text-decoration-none mb-3">Hai dimenticato la password?Clicca qui</a>
    </div>
</x-layout>