<?php

namespace App\Http\Controllers;

use App\Models\Loteria;

class HomeController extends Controller
{
    //
    public function index()
    {
        $loterias = Loteria::all();
        return view('index', compact('loterias'));
    }
}
