<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\KendaraanRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Database\Eloquent\Builder;

class KendaraanController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $dataKendaraan = Kendaraan::get();
            return view('dashboard.admin.kendaraan.index',["dataKendaraan" => $dataKendaraan]);
        }else {
            return view('error.401');
        }
    }

    public function detail(Request $request)
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $detailKendaraan = Kendaraan::with(['pemesanan' => function (Builder $query) {
                $query->where('status','selesai');
            }])->where('plat',$request->plat)->first();

            return view('dashboard.admin.kendaraan.riwayat',['detailKendaraan' => $detailKendaraan]);
        }else{
            return view('error.401');
        }
    }

    public function store(KendaraanRequest $request)
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $tambahKendaraan = Kendaraan::create($request->all());

            
            if($tambahKendaraan)
            {
                Alert::success('Success', 'Tambah Data Berhasil');
                return redirect('/kendaraan');
                
            } else {
                
                Alert::error('Failed', 'Tambah Data Gagal');
                return redirect('/kendaraan');
            }
        }else {
            return view('error.401');
        }
    }

    public function update(KendaraanRequest $request)
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $updateKendaraan = Kendaraan::findOrFail($request->id);
            $updateKendaraan->update([
                "nama" => $request->nama,
                "plat" => $request->plat,
                "konsumsi_bbm_per_km" => $request->konsumsi_bbm_per_km,
                "jenis_kendaraan" => $request->jenis_kendaraan,
                "kepemilikan" => $request->kepemilikan
            ]);

            if($updateKendaraan)
            {
                Alert::success('Success', 'Data Berhasil Disimpan');
                return redirect('/kendaraan');

            } else {

                Alert::success('Failed', 'Data Gagal Disimpan');
                return redirect('/kendaraan');

            }
        }else {
            return view('error.401');
        }
    }

    public function destroy(Request $request)
    {

        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $hapusKendaraan = Kendaraan::findOrFail($request->id);
            $hapusKendaraan->delete();
    
            if($hapusKendaraan)
            {
                Alert::success('Success', 'Berhasil Menghapus Kendaraan');
                return redirect('/kendaraan');
                
            } else {
                
                Alert::error('Failed', 'Gagal Menghapus Kendaraan');
                return redirect('/kendaraan');
            }
        }else {
            return view('error.401');
        }
    }
}
