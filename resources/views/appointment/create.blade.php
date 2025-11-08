<x-layout>
    <x-slot:titleTab>Prenota</x-slot:titleTab>

    {{-- Form per selezionare il giorno --}}
    <form action="{{ route('appointment.create') }}" method="GET" class="container d-flex flex-column gap-2 my-5 text-center">
        <x-flash />
        <div class="mb-2">
            <label for="day" class="form-label">Giorno</label>
            <input type="text" name="day" id="day" class="form-control mx-auto w-50 text-center datepicker"
                value="{{ request('day') }}" required>
        </div>
        <div class="mb-2 text-center">
            <button type="submit" class="btn btn-primary">Mostra orari disponibili</button>
        </div>
    </form>


    {{-- Mostra form prenotazione solo se ci sono slot liberi --}}
    @if(!empty($freeHours))
    <form action="{{ route('appointment.store') }}" method="POST" class="container d-flex flex-column gap-2 my-5 text-center">
        @csrf

        <div class="mb-2">
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

        <div class="mb-2">
            <label for="time" class="form-label">Orario</label>
            <select name="time" id="time" class="form-select mx-auto w-50 text-center" required>
                @foreach ($freeHours as $hour)
                <option value="{{ $hour }}">{{ $hour }}</option>
                @endforeach
            </select>
        </div>

        {{-- Nascondo il giorno selezionato per inviarlo allo store --}}
        <input type="hidden" name="day" value="{{ request('day') }}">

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-sm rounded-3 w-25">
                Prenota
            </button>
        </div>
    </form>
    @elseif($request->has('day'))
    {{-- Se il giorno è stato selezionato ma non ci sono slot liberi --}}
    <div class="container text-center my-3">
        <p class="text-danger">Nessun orario disponibile per questo giorno.</p>
    </div>
    @endif
</x-layout>