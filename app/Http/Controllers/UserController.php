<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function booking()
    {
        $user = Auth::user(); // utente loggato
        $services = Service::all(); // tutti i servizi
        return view('user.booking', compact('user','services'));
    }
}
