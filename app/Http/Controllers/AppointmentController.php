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
     * Display a listing of the resource.
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
        // orari negozio
        $hours = [
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
        ];


        $appointments = Appointment::all();

        //calcolo durata del servizio
        foreach ($appointments as $appt) {
            // Accede alla proprietà duration della tabella services
            $duration = ($appt->service->duration);
        }
        //prendo il giorno selezionato a calendario
        $selectDay = Appointment::pluck('day')->toArray();


        // Estrai mese e giorno dal campo day
        // $monthDay = substr($daySelected, 5, 5); // MM-DD
        // dd($monthDay);
        //prendo la colonna time dell appuntamento

        $times = Appointment::pluck('time')->toArray();

        //adeguo i formati e sommo l'appuntamento preso alla durata del servizio selezionato
        foreach ($times as $time) {
            // Prendi solo ore e minuti se il formato è HH:MM:SS
            $timeHM = substr($time, 0, 5);
            $timeCarbon = Carbon::createFromFormat('H:i', $timeHM);
            $newTime = $timeCarbon->addMinutes($duration)->format('H:i');


            // Controlla se è presente e rimuovi
            if (in_array($timeHM, $hours)) {
                $hourOccupated = array_search($timeHM, $hours);
                unset($hours[$hourOccupated]);
                //restituisce l array con i nuovi orari
                $hours[] = $newTime;
                //ordine l array in ordine crescente
                sort($hours);
            }
        }

        //riaggiorno l array aggiungendo un nuovo orario che parte dalla fine dell apputamento precedente(refreshHour e ricontrollo tutti gli orari,se già esistono,cancello quelli occupati)
        $refhreshTime = Appointment::pluck('time')->toArray();

        if (in_array($refhreshTime && $timeHM, $hours)) {
            $hourOccupated = array_search($refhreshTime && $timeHM, $hours);
            unset($hours[$hourOccupated]);
        }

        // Reindicizza l'array
        $hours = array_values($hours);

        $user = Auth::user(); // utente loggato
        $services = Service::all(); // tutti i servizi





        return view('appointment/create', compact('user', 'services', 'hours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $appointment = new Appointment;

        // Converte la data in formato MySQL
        $appointment->day = Carbon::createFromFormat('d-m-Y', $request->day)->format('Y-m-d');
        $appointment->time = $request->time;
        $appointment->service_id = $request->service_id;

        // Se vuoi salvare l’utente loggato
        $appointment->user_id = Auth::id();

        // Salva il record
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
