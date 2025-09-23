<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function booking()
    {
        $user = Auth::user(); // utente loggato
        return view('user.booking', compact('user'));
    }
}
