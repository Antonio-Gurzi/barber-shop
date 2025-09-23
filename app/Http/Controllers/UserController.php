<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function booking()
    {
        return view('user.booking'); // resources/views/user/booking.blade.php
    }
}
