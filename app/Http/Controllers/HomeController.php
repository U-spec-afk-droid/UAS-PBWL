<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;

class HomeController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('home', compact('ruangan'));
    }
}
