<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
        public function index()
    {
                $appointments = Appointment::where('user_id', Auth::id())->orderBy('day', 'asc')->get();

        return view('client.index', compact('appointments'));
    }
}
