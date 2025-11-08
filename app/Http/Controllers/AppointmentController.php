<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource (facoltativo).
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $services = Service::all();
        $freeHours = [];

        if ($request->has('day') && !empty($request->day)) {
            $formatDay = Carbon::createFromFormat('d-m-Y', $request->day)->format('Y-m-d');

            // Recupero tutti gli appuntamenti del giorno selezionato con durata del servizio
            $appointments = Appointment::with('service')
                ->where('day', $formatDay)
                ->get();

            // Orari base (solo ore intere dalle 09:00 alle 18:00)
            $baseHours = [];
            for ($hour = 9; $hour <= 18; $hour++) {
                $baseHours[] = sprintf('%02d:00', $hour);
            }

            // Partiamo dagli slot liberi iniziali
            $freeHours = $baseHours;

            foreach ($appointments as $appointment) {
                $start = Carbon::createFromFormat('H:i:s', $appointment->time);
                $end = $start->copy()->addMinutes($appointment->service->duration);

                // Rimuovo tutti gli slot che cadono dentro l'appuntamento
                $freeHours = array_filter($freeHours, function ($slot) use ($start, $end) {
                    $slotTime = Carbon::createFromFormat('H:i', $slot);
                    return $slotTime->lt($start) || $slotTime->gte($end);
                });

                // Aggiungo come nuovo slot disponibile la fine del servizio
                $freeHours[] = $end->format('H:i');
            }

            // Riordino in ordine crescente
            usort($freeHours, fn($a, $b) => strtotime($a) <=> strtotime($b));
            $freeHours = array_values($freeHours);
        } else {
            // Se non è stato selezionato il giorno → flash message
            session()->flash('danger', 'Seleziona un giorno per vedere gli orari disponibili.');
        }

        return view('appointment.create', compact('user', 'services', 'freeHours', 'request'));
    }







    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required|date_format:d-m-Y',
            'time' => 'required',
            'service_id' => 'required|exists:services,id',
        ]);

        $appointment = new Appointment();
        $appointment->day = Carbon::createFromFormat('d-m-Y', $request->day)->format('Y-m-d');
        $appointment->time = $request->time;
        $appointment->service_id = $request->service_id;
        $appointment->user_id = Auth::id();
        $appointment->save();

        return redirect()->back()->with('success', 'Appuntamento creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
