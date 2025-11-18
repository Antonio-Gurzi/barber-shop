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


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $services = Service::all();
        $freeHours = [];

        if ($request->has('day') && !empty($request->day)) {

            // Formatto la data
            $formatDay = Carbon::createFromFormat('d-m-Y', $request->day)->format('Y-m-d');
            $selectedDay = Carbon::parse($formatDay);
            $now = Carbon::now();
            $openingTime = Carbon::createFromTime(9, 0);

            // togli Domenica e Lunedì
            if ($selectedDay->isSunday() || $selectedDay->isMonday()) {
                return redirect()->back()->with('warning', 'Il negozio è chiuso la domenica e il lunedì.');
            }

            //Blocca oggi se l’orario di apertura è già passato
            if ($selectedDay->isToday() && $now->greaterThan($openingTime)) {
                return redirect()->back()->with('warning', 'Per oggi non è più possibile prendere appuntamento.');
            }

            // Recupero tutti gli appuntamenti del giorno selezionato
            $appointments = Appointment::with('service')
                ->where('day', $formatDay)
                ->orderBy('time', 'asc')
                ->get();

            // Slot orari base (09:00 - 18:00)
            $baseHours = [];
            for ($hour = 9; $hour <= 18; $hour++) {
                $baseHours[] = sprintf('%02d:00', $hour);
            }

            // Partenza slot disponibili
            $freeHours = $baseHours;

            foreach ($appointments as $appointment) {
                $start = Carbon::createFromFormat('H:i:s', $appointment->time);
                $end = $start->copy()->addMinutes($appointment->service->duration);

                // Rimuovo gli slot che cadono nell'intervallo occupato
                $freeHours = array_filter($freeHours, function ($slot) use ($start, $end) {
                    $slotTime = Carbon::createFromFormat('H:i', $slot);
                    return $slotTime->lt($start) || $slotTime->gte($end);
                });

                // Aggiungo come slot la fine del servizio
                $endTime = $end->format('H:i');
                if ($endTime <= '18:00') {
                    $freeHours[] = $endTime;
                }
            }

            // Riordino gli slot
            usort($freeHours, fn($a, $b) => strtotime($a) <=> strtotime($b));
            $freeHours = array_values($freeHours);

            //Rimuovi 18:00 se è occupato in modo da non prendere appuntamenti oltre l'orario di chiusura
            $eighteenOccupied = $appointments->contains(function ($appointment) {
                return Carbon::createFromFormat('H:i:s', $appointment->time)
                    ->format('H:i') === '18:00';
            });

            if ($eighteenOccupied) {
                $key = array_search('18:00', $freeHours);
                if ($key !== false) {
                    unset($freeHours[$key]);
                    $freeHours = array_values($freeHours);
                }
            }
            // Controllo sovrapposizioni se sono stati selezionati orario e servizio
            if ($request->has('time') && $request->has('service_id')) {

                $selectedTime = Carbon::createFromFormat('H:i', $request->time);
                $service = Service::find($request->service_id);

                if ($service) {
                    $endTime = $selectedTime->copy()->addMinutes($service->duration);

                    // Trovo il prossimo appuntamento dopo l'orario scelto
                    $nextAppointment = Appointment::where('day', $formatDay)
                        ->where('time', '>', $selectedTime->format('H:i'))
                        ->orderBy('time', 'asc')
                        ->first();

                    if ($nextAppointment) {
                        $nextStart = Carbon::createFromFormat('H:i:s', $nextAppointment->time);

                        // Se sfora blocco la prenotazione
                        if ($endTime->gt($nextStart)) {
                            return redirect()->back()->with('warning', 'Questo servizio non può essere prenotato perché si sovrappone al prossimo appuntamento.');
                        }
                    }
                }
            }
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

        // Formatto la data
        $formatDay = Carbon::createFromFormat('d-m-Y', $request->day)->format('Y-m-d');

        // Orario selezionato
        $selectedTime = Carbon::createFromFormat('H:i', $request->time);

        // Recupero servizio e durata
        $service = Service::find($request->service_id);

        // Calcolo fine servizio scelto
        $endTime = $selectedTime->copy()->addMinutes($service->duration);

        // Trovo il prossimo appuntamento dopo l'orario scelto
        $nextAppointment = Appointment::where('day', $formatDay)
            ->where('time', '>', $selectedTime->format('H:i'))
            ->orderBy('time', 'asc')
            ->first();

        if ($nextAppointment) {
            $nextStart = Carbon::createFromFormat('H:i:s', $nextAppointment->time);

            // Se sfora, blocco la prenotazione
            if ($endTime->gt($nextStart)) {
                return redirect()->back()->with('danger', 'Questo servizio non può essere prenotato perché finirebbe oltre il prossimo appuntamento.');
            }
        }

        //salvo l'appuntamento
        $appointment = new Appointment();
        $appointment->day = $formatDay;
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
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->back()->with('success', 'Appuntamento cancellato con successo');
    }
}
