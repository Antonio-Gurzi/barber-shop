<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
public function index()
{
    $appointments = Appointment::orderBy('day', 'asc')
        ->orderBy('time', 'asc')
        ->get();

    return view('admin.appointments', compact('appointments'));
}
}
