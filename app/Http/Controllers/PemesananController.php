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
            return view('dashboard.admin.pemesanan.index',[
                "dataPemesanan" => $dataPemesanan,
                "dataKendaraan" => $dataKendaraan,
                "dataDriver" => $dataDriver
            ]);
        }else {
            return view('error.401');
        }
    }

    public function store(PemesananRequest $request)
    {
        if($request->jadwal_start > $request->jadwal_end || $request->jadwal_start >= $request->jadwal_end)
        {
            Alert::warning('Warning', 'Jadwal Berakhir tidak boleh diatas atau sama dengan jadwal Mulai');
            return redirect('/pemesanan');
        } else {
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
            }else {
                return view('error.401');
            }
        }
        
    }

    public function update(PemesananRequest $request)
    {
        if($request->status != 'menunggu')
        {
            if($request->jadwal_start > $request->jadwal_end || $request->jadwal_start >= $request->jadwal_end)
            {
                Alert::warning('Warning', 'Jadwal Berakhir tidak boleh diatas atau sama dengan jadwal Mulai');
                return redirect('/pemesanan');
            } else {
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
                }else {
                    return view('error.401');
                }
            }
        } else {
                Alert::warning('Warning', 'Ubah data tidak diperbolehkan');
                return redirect('/pemesanan');
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
        }else {
            return view('error.401');
        }
    }

    public function pemesananSelesai(Request $request)
    {
        if($request->status === 'menunggu' || $request->status === 'ditolak' || $request->status === 'selesai')
        {
            Alert::warning('Peringatan', 'Status pemesanan '. $request->status);
            return redirect('/pemesanan');
        } else {
            if(Auth::check() && Auth::user()->roles == 'admin')
            {
                $pemesananSelesai = Pemesanan::findOrFail($request->id);
                $pemesananSelesai->update([
                    'status' => 'selesai'
                ]);
    
                if($pemesananSelesai)
                {
                    Alert::success('Success', 'Status Pemesanan Berhasil Diubah');
                    return redirect('/pemesanan');
                    
                } else {
                    
                    Alert::error('Failed', 'Status Pemesanan Gagal Diubah');
                    return redirect('/pemesanan');
                }
            } else {
                return view('error.401');
            }
        }
    }

    public function exportExcel(Request $request)
    {
        if($request->tanggal_awal > $request->tanggal_akhir || $request->tanggal_awal >= $request->tanggal_akhir)
        {
            Alert::warning('Warning', 'Jadwal Berakhir tidak boleh diatas atau sama dengan jadwal Mulai');
            return redirect('/pemesanan');
        } else {
            if(Auth::check() && Auth::user()->roles == 'admin')
            {
                    return (new PemesananExport($request->tanggal_awal,$request->tanggal_akhir))->download('DataPemesanan.xlsx');
                } else {
                    return view('error.401');
            }
        }
    }
}
