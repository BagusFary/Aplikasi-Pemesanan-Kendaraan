<?php

namespace App\Http\Controllers;

use App\Exports\PemesananExport;
use App\Models\User;
use App\Models\Driver;
use App\Models\Kendaraan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PemesananRequest;
use RealRashid\SweetAlert\Facades\Alert;

class PemesananController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {

            $dataKendaraan = Kendaraan::select('id','nama')->get();
            $dataDriver = Driver::select('id','nama')->get();
            $dataPemesanan = Pemesanan::with('user:id,name','driver:id,nama','kendaraan:id,nama')->get();
            return view('dashboard.pemesanan.index',[
                "dataPemesanan" => $dataPemesanan,
                "dataKendaraan" => $dataKendaraan,
                "dataDriver" => $dataDriver
            ]);
        }
    }

    public function store(PemesananRequest $request)
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $dataKendaraan = Kendaraan::where('id',$request->kendaraan_id)->get();
            $request['konsumsi_bbm'] = $dataKendaraan[0]->konsumsi_bbm_per_km * $request->konsumsi_bbm;
            $tambahPemesanan = Pemesanan::create($request->all());

            if($tambahPemesanan)
            {
                Alert::success('Success', 'Tambah Data Berhasil');
                return redirect('/pemesanan');
                
            } else {
                
                Alert::error('Failed', 'Tambah Data Gagal');
                return redirect('/pemesanan');
            }
        }
    }

    public function update(PemesananRequest $request)
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $updatePemesanan = Pemesanan::findOrFail($request->id);
            $updatePemesanan->update($request->all());

            if($updatePemesanan)
            {
                Alert::success('Success', 'Data Berhasil Disimpan');
                return redirect('/pemesanan');
                
            } else {
                
                Alert::error('Failed', 'Data Berhasil Disimpan');
                return redirect('/pemesanan');
            }
        }
    }

    public function destroy(Request $request)
    {
        if(Auth::check() && Auth::user()->roles == 'admin')
        {
            $hapusPemesanan = Pemesanan::findOrFail($request->id);
            $hapusPemesanan->delete();

            if($hapusPemesanan)
            {
                Alert::success('Success', 'Hapus Pemesanan Berhasil');
                return redirect('/pemesanan');
                
            } else {
                
                Alert::error('Failed', 'Hapus Pemesanan Gagal');
                return redirect('/pemesanan');
            }
        }
    }

    public function exportExcel(Request $request)
    {
        if(Auth::check())
        {
            return (new PemesananExport($request->tanggal_awal,$request->tanggal_akhir))->download('DataPemesanan.xlsx');
        }
    }
}
