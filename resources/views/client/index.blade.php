<x-layout>
    <x-slot:titleTab>Tutti gli appuntamenti</x-slot:titleTab>

    <div class="container my-5">
        <h1 class="text-center mb-4">Elenco Appuntamenti</h1>

        <x-flash />

        @if($appointments->isEmpty())
        <p class="text-center">Non ci sono appuntamenti prenotati.</p>
        @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Orario</th>
                    <th>Servizio</th>
                    <th>Prezzo</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($appointment->day)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</td>
                    <td>{{ $appointment->service->service }}</td>
                    <td>€{{ number_format($appointment->service->price, 2) }}</td>
                    <td>
                        <form action="{{ route('client.appointments.destroy', $appointment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"class="btn btn-danger btn-sm">Elimina</button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

</x-layout>