<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Requests\DriverRequest;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DriverController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $dataDriver = Driver::get();
            return view('dashboard.admin.driver.index',["dataDriver" => $dataDriver]);
        }else {
            return view('error.401');
        }
    }

    public function store(DriverRequest $request)
    {   
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $tambahDriver = Driver::create($request->all());

            if($tambahDriver)
            {
                Alert::success('Success', 'Tambah Data Berhasil');
                return redirect('/driver');
            } else {
                Alert::success('Failed', 'Tambah Data Gagal');
                return redirect('/driver');
            }
        }else {
            return view('error.401');
        }
    }

    public function update(DriverRequest $request)
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $updateDriver = Driver::findOrFail($request->id);
            $updateDriver->update([
                "nama" => $request->nama,
                "email" => $request->email,
                "phone" => $request->phone
            ]);

            if($updateDriver)
            {
                Alert::success('Success', 'Data Berhasil Disimpan');
                return redirect('/driver');
            } else {
                Alert::success('Failed', 'Data Berhasil Disimpan');
                return redirect('/driver');
            }
        }else {
            return view('error.401');
        }
    }

    public function destroy(Request $request)
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $hapusDriver = Driver::findOrFail($request->id);
            $hapusDriver->delete();

            if($hapusDriver)
            {
                Alert::success('Success', 'Hapus Data Berhasil');
                return redirect('/driver');
            } else {
                Alert::success('Failed', 'Hapus Data Gagal');
                return redirect('/driver');
            }
        }else {
            return view('error.401');
        }
    }
}
