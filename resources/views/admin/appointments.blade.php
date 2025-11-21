<x-layout>
    <x-slot:titleTab>Tutti gli appuntamenti</x-slot:titleTab>

    <div class="container my-5">
        <h1 class="text-center mb-4">Elenco Appuntamenti</h1>

        <x-flash />

        @if($appointments->isEmpty())
        <p class="text-center">Non ci sono appuntamenti prenotati.</p>
        @else
        <ul class="timeline list-unstyled">
            @foreach($appointments as $appointment)
            <li class="mb-4 position-relative ps-4">
                <!-- Punto della timeline -->
                <i class="bi bi-scissors me-5 fs-5"></i>

                <!-- Data -->
                <p class="mb-1 fw-bold text-primary">
                   Giorno : {{ \Carbon\Carbon::parse($appointment->day)->format('d/m/Y') }}
                </p>

                <!-- Dettagli appuntamento -->
                <div class="ms-4 p-3 border rounded-3 shadow-sm bg-white">
                    <p class="mb-1"><span class="fw-bold">Orario:</span> {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</p>
                    <p class="mb-1"><span class="fw-bold">Cliente:</span> {{ $appointment->user->name }} ({{ $appointment->user->phone }})</p>
                    <p class="mb-1"><span class="fw-bold">Servizio:</span> {{ $appointment->service->service }}</p>
                    <p class="mb-1">
                        <span class="fw-bold">Fine:</span> {{ \Carbon\Carbon::parse($appointment->time)->addMinutes($appointment->service->duration)->format('H:i') }}
                    </p>

                    <p class="mb-1"><span class="fw-bold">Prezzo:</span> €{{ number_format($appointment->service->price, 2) }}</p>

                    <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" class="mt-2 text-end">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-5" title="Elimina">
                            <span>Elimina l'appuntamento</span>
                        </button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
        @endif
    </div>

</x-layout>