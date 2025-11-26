<x-layout>

    <x-slot:titleTab>Prenota</x-slot:titleTab>

    {{-- Form per selezionare il giorno --}}
    <div class="container my-5">
        <x-flash />

        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <form action="{{ route('appointment.create') }}" method="GET" class="card p-4 shadow-sm">
                    <h3 class="text-center mb-4 fw-bold">Seleziona il giorno</h3>

                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="day" class="form-label fw-semibold">Giorno</label>
                        <input type="text" name="day" id="day" class="form-control text-center datepicker"
                            value="{{ request('day') }}" placeholder="GG/MM/AAAA" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-bold">Mostra orari disponibili</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Mostra form prenotazione solo se ci sono slot liberi --}}
    @if(!empty($freeHours))
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('appointment.store') }}" method="POST" class="card p-4 shadow-sm">
                    @csrf
                    <h3 class="text-center mb-4 fw-bold">Prenota un orario</h3>

                    <div class="row g-3">
                        {{-- Servizio --}}
                        <div class="col-md-8">
                            <label for="service_id" class="form-label fw-semibold">Servizio</label>
                            <select id="service_id" name="service_id" class="form-select" required>
                                <option value="" selected>Seleziona un servizio</option>
                                @foreach ($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->service }} - {{ $service->duration }} min - €{{ $service->price }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Orario --}}
                        <div class="col-md-4">
                            <label for="time" class="form-label fw-semibold">Orario</label>
                            <select name="time" id="time" class="form-select" required>
                                @foreach ($freeHours as $hour)
                                <option value="{{ $hour }}">{{ $hour }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Nascondo il giorno selezionato per inviarlo allo store --}}
                    <input type="hidden" name="day" value="{{ request('day') }}">

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success fw-bold">
                            Prenota
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @elseif($request->has('day'))
    {{-- Se il giorno è stato selezionato ma non ci sono slot liberi --}}
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-danger text-center mb-0">
                    Nessun orario disponibile per questo giorno.
                </div>
            </div>
        </div>
    </div>
    @endif

</x-layout>