<x-layout>
    <x-slot:titleTab>Tutti gli appuntamenti</x-slot:titleTab>

    <div class="container my-5">
        <h1 class="text-center mb-4">Elenco Appuntamenti</h1>

        <x-flash />

        @if($appointments->isEmpty())
        <p class="text-center text-muted fs-5">Non ci sono appuntamenti prenotati.</p>
        @else
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach($appointments as $appointment)
            <div class="accordion-item mb-3 border-0 shadow-sm rounded-4">
                <h2 class="accordion-header d-flex align-items-center justify-content-between p-3 bg-light rounded-4" id="heading{{ $appointment->id }}">
                    <div>
                        <span class="fw-bold fs-5">{{ $appointment->user->name }}</span>
                        <div class="text-muted fs-6">
                            {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}
                            - {{ \Carbon\Carbon::parse($appointment->day)->format('d/m/Y') }}
                        </div>
                    </div>
                    <button class="btn btn-info btn-sm rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $appointment->id }}" aria-expanded="false" aria-controls="collapse{{ $appointment->id }}">
                        Dettagli <i class="bi bi-caret-down"></i>
                    </button>
                </h2>

                <div id="collapse{{ $appointment->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body bg-white rounded-3 p-3 shadow-sm">
                        <p class="mb-1"><span class="fw-bold">Fine:</span> {{ \Carbon\Carbon::parse($appointment->time)->addMinutes($appointment->service->duration)->format('H:i') }}</p>
                        <p class="mb-1"><span class="fw-bold">Cellulare:</span> {{ $appointment->user->phone }}</p>
                        <p class="mb-1"><span class="fw-bold">Servizio:</span> {{ $appointment->service->service }}</p>
                        <p class="mb-1"><span class="fw-bold">Prezzo:</span> €{{ number_format($appointment->service->price, 2) }}</p>

                        <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" class="mt-3 text-end">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm rounded-4" title="Elimina">
                                Elimina appuntamento
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif








        <!--  
        @if($appointments->isEmpty())
        <p class="text-center">Non ci sono appuntamenti prenotati.</p>
        @else
        <ul class="timeline list-unstyled">
            @foreach($appointments as $appointment)
            <li class="mb-4 position-relative ps-4">
                <i class="bi bi-scissors me-5 fs-5"></i>

                <p class="mb-1 fw-bold text-primary">
                    Giorno : {{ \Carbon\Carbon::parse($appointment->day)->format('d/m/Y') }}
                </p>

                <div class="ms-4 p-3 border rounded-3 shadow-sm bg-white">
                    <p class="mb-1"><span class="fw-bold">Inizio:</span> {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</p>
                    <p class="mb-1">
                        <span class="fw-bold">Fine:</span> {{ \Carbon\Carbon::parse($appointment->time)->addMinutes($appointment->service->duration)->format('H:i') }}
                    </p>
                    <p class="mb-1"><span class="fw-bold">Cliente:</span> {{ $appointment->user->name }} ({{ $appointment->user->phone }})</p>
                    <p class="mb-1"><span class="fw-bold">Servizio:</span> {{ $appointment->service->service }}</p>


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
        -->
    </div>

</x-layout>