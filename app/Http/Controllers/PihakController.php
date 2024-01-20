<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PihakRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PihakController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $dataPihak = User::where('roles','user')->select('id','name','email')->get();
            return view('dashboard.admin.pihak.index',['dataPihak' => $dataPihak]);
        }
    }

    public function store(Pihakrequest $request)
    {
        dd(Carbon::now());
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $tambahPihak = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(12345678),
                'roles' => 'user',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

            if($tambahPihak)
            {
                Alert::success('Success', 'Tambah Data Berhasil');
                return redirect('/pihak');
                
            } else {
                
                Alert::error('Failed', 'Tambah Data Gagal');
                return redirect('/pihak');
            }
        }else {
            return view('error.401');
        }
    }

    public function update(PihakRequest $request)
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $updatePihak = User::findOrFail($request->id);
            $updatePihak->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            if($updatePihak)
            {
                Alert::success('Success', 'Update Data Pihak Berhasil');
                return redirect('/pihak');
                
            } else {
                
                Alert::error('Failed', 'Update Data Pihak Gagal');
                return redirect('/pihak');
            }
        }else {
            return view('error.401');
        }
    }

    public function destroy(Request $request)
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $hapusPihak = User::findOrFail($request->id);
            $hapusPihak->delete();

            if($hapusPihak)
            {
                Alert::success('Success', 'Hapus Pihak Berhasil');
                return redirect('/pihak');
                
            } else {
                
                Alert::error('Failed', 'Hapus Pihak Gagal');
                return redirect('/pihak');
            }

        }else {
            return view('error.401');
        }
    }
}
