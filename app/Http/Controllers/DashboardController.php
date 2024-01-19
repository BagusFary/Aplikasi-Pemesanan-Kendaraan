<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $totalDriver = Driver::count();
            $totalKendaraan = Kendaraan::count();
            return view('dashboard.index',[
                'totalDriver' => $totalDriver,
                'totalKendaraan' => $totalKendaraan
            ]);
        }
    }

    public function kendaraan()
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            return view('dashboard.admin.kendaraan.index');
        }else {
            return view('error.401');
        }
    }


}
