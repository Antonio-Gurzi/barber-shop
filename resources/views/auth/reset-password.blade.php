<x-layout>
    <x-slot:titleTab>Resetta la tua password</x-slot:titleTab>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center">Imposta Nuova Password</div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('password.update') }}" class="text-center">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control mx-auto"
                                    value="{{ old('email', $request->email) }}" required>
                                @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Nuova Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control mx-auto" required>
                                @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Conferma Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control mx-auto" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Resetta Password</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>







</x-layout>