<x-layout>
    <x-slot:titleTab>Tutti gli appuntamenti</x-slot:titleTab>

    <div class="container my-5">
        <h1 class="text-center mb-4">Elenco dei tuoi appuntamenti</h1>

        <x-flash />

        @if($appointments->isEmpty())
        <p class="text-center text-muted fs-5">Non ci sono appuntamenti prenotati.</p>
        @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Orario</th>
                        <th scope="col">Servizio</th>
                        <th scope="col">Durata</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($appointment->day)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</td>
                        <td>{{ $appointment->service->service }}</td>
                        <td>{{ $appointment->service->duration }} min</td>
                        <td>€{{ number_format($appointment->service->price, 2) }}</td>
                        <td>
                            <form action="{{ route('client.appointments.destroy', $appointment->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Elimina
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </div>
</x-layout>
