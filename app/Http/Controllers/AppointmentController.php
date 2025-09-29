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
    public function create()
    {
        $user = Auth::user(); // utente loggato
        $services = Service::all(); // tutti i servizi
        // orari
        $hours = [];
        for ($h = 9; $h < 13; $h++) {
            foreach ([0, 30] as $m) {
                $hours[] = sprintf("%02d:%02d", $h, $m);
            }
        }
        for ($h = 15; $h < 18; $h++) {
            foreach ([0, 30] as $m) {
                $hours[] = sprintf("%02d:%02d", $h, $m);
            }
        }
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
        $appointment->user_id = auth()->id();

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
