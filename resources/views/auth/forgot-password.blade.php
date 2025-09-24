<x-layout>
    <x-slot:titleTab>Resetta la tua password</x-slot:titleTab>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center">Reset Password</div>
                    <div class="card-body">


                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3 d-flex align-items-center flex-column">
                                <label for="email" class="form-label">Inserisci la tua Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control"
                                    value="{{ old('email') }}" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Invia link di reset</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



</x-layout>