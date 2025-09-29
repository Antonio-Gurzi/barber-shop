<x-layout>
    <x-slot:titleTab>Prenota</x-slot:titleTab>
    @vite('resources/js/calendar.js')


    <form action="{{ route('appointment.store') }}" method="POST" class="container d-flex flex-column gap-2 my-5">
        @csrf

        <div class="row g-3 d-flex justify-content-center">
            <div class="col-12 col-md-4">
                <p class="fs-4 text-center">Ciao {{ $user->name }}, prenota pure il tuo appuntamento!</p>
            </div>
        </div>



        <section class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow-lg border-0" style="max-width: 500px; width: 100%;">
                <div class="card-body p-4 text-center">

                    <h4 class="mb-4">Prenotazione</h4>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control mx-auto w-50 text-center" id="email"
                            name="email" value="{{ $user->email }}">
                    </div>

                    {{-- Calendario --}}
                    <div class="mb-3">
                        <label for="day" class="form-label">Giorno</label>
                        <input type="text" name="day" id="day"
                            class="form-control mx-auto w-50 text-center datepicker" value="{{ old('day') }}">
                    </div>

                    {{-- Dropdown servizi --}}
                    <div class="mb-3">
                        <label for="service_id" class="form-label">Servizio</label>
                        <select id="service_id" name="service_id" class="form-select mx-auto w-50 text-center" required>
                            <option value="" selected>Seleziona un servizio</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->service }} - {{ $service->duration }} min - €{{ $service->price }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Orari --}}
                    <div class="mb-4">
                        <label for="orario" class="form-label">Orario</label>
                        <select name="orario" id="orario" class="form-select mx-auto w-50 text-center">
                            @foreach ($hours as $hour)
                                <option value="{{ $hour }}">{{ $hour }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Button prenotazione --}}
                    <div>
                        <button type="submit" class="btn btn-success btn-sm rounded-3 w-25">
                            Prenota
                        </button>
                    </div>
                </div>
            </div>
        </section>



    </form>


</x-layout>


















{{-- ------------------------------------- --}}

<!-- <div class="row g-3 d-flex justify-content-center">
            <div class="col-12 col-md-4">
                <label for="title" class="form-label">Titolo</label>
                <input type="email" class="form-control text-center" id="email" name="email" value="Email:{{ $user->email }}">
            </div>
        </div> -->
<!-- Selezione giorno e orario -->
{{-- <div class="container mt-5 d-flex flex-column align-items-center"> --}}

<!-- Calendario centrato -->
{{-- <div id="calendar"></div> --}}

<!-- Select container -->
{{-- <div id="selectionContainer" class="mt-4 w-100" style="max-width: 350px;"> --}}

<!-- Dropdown servizi -->
{{-- <div class="mb-3 text-center">
            <select id="service_id" name="service_id" class="form-control" required>
                <option value="" selected>Seleziona un servizio</option>
                @foreach ($services as $service)
                <option value="{{ $service->id }}">
                    {{ $service->service }} - {{ $service->duration }} min - €{{ $service->price }}
                </option>
                @endforeach
            </select>
        </div> --}}

{{-- <!-- Dropdown orari generato da JS -->
        <div class="mb-3 text-center">
            <label class="form-label">Seleziona orario</label>
            <div id="time"></div>
        </div> --}}

{{--
    </div> --}}

<!-- Hidden input per la data selezionata -->
{{-- <input type="hidden" id="day" name="day"> --}}


{{-- <div>
        <button type="submit" class="btn btn-success rounded-3">Prenota</button>
    </div> --}}


{{--
</div> --}}
