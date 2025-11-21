<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function index()
    {
        // Tutti gli appuntamenti ordinati per giorno e ora
        // $appointments = Appointment::orderBy('day', 'asc')
        //     ->orderBy('time', 'asc')
        //     ->get();

        //tutti gli appuntamenti esclusi quelli passati
        $appointments = Appointment::whereDate('day', '>=', today())
            ->orderBy('day', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        return view('admin.appointments', compact('appointments'));
    }
}
