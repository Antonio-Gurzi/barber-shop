<x-layout>
    <x-slot:titleTab>Registrazione</x-slot:titleTab>

    <div class="container d-flex justify-content-center align-items-center py-4 py-md-5">
        <div class="card-form shadow-lg border-0 rounded-4 w-100" style="max-width: 500px;">
            <div class="card-body p-3 p-md-4">
                <h2 class="text-center mb-4 fw-bold text-primary">Crea il tuo account</h2>

                <form method="POST" action="{{ route('register')}}" class="text-center">
                    @csrf

                    <div class="mb-3">
                        <label for="first_name" class="form-label">Nome</label>
                        <input type="text" class="form-control rounded-pill mx-auto" id="first_name" name="first_name" placeholder="Il tuo nome" required>
                        @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Cognome</label>
                        <input type="text" class="form-control rounded-pill mx-auto" id="last_name" name="last_name" placeholder="Il tuo cognome" required>
                        @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

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

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Conferma Password</label>
                        <input type="password" class="form-control rounded-pill mx-auto" id="password_confirmation" name="password_confirmation" placeholder="Conferma la tua password" required autocomplete="off">
                        @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <x-flash />

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-success rounded-pill shadow-sm">
                            Registrati
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-layout>