<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            return view('dashboard.index');
        }
    }

    public function kendaraan()
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            return view('dashboard.admin.kendaraan.index');
        }
    }


}
