<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        return view('welcome');
    }
    public function service()
    {
        $services = Service::all();
        return view('service', compact('services'));
    }
}
