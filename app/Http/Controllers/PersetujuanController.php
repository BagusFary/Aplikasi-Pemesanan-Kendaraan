<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pemesanan;
use App\Models\Persetujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PersetujuanController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->roles == 'user')
        {
            $dataPemesanan = Pemesanan::with('user:id,name','driver:id,nama','kendaraan:id,nama')->get();
            return view('dashboard.user.persetujuan.index',['dataPemesanan' => $dataPemesanan]);
        } else {
            return view('error.401');
        }
    }

    public function persetujuan(Request $request)
    {
        if(Auth::check()  && Auth()->user()->roles == 'user')
        {
            $pemesanan = Pemesanan::find($request->pemesanan_id);
            $persetujuan = $pemesanan->persetujuan()->where('user_id', $request->user_id)->exists();
            
            if ($persetujuan) 
            {
                Alert::error('Failed', 'Anda sudah melakukan persetujuan');
                return redirect('/persetujuan');
                
            } else {

                $is_approved = $request->has('approve') ? true : false;
                $dataPersetujuan = Persetujuan::create([
                    'user_id' => $request->user_id,
                    'pemesanan_id' => $request->pemesanan_id,
                    'is_approved' => $is_approved,
                ]);
                
                $persetujuan_count_true = $pemesanan->persetujuan()->where('is_approved',true)->count();
    
                if($persetujuan_count_true >= 2)
                {
                    $pemesanan->update([
                        'status' => 'disetujui'
                    ]);
                } 
    
                $userTotal = User::where('roles', 'user')->count();
    
                $total_persetujuan = $pemesanan->persetujuan()->count();
    
                if ($userTotal === $total_persetujuan) {
                    if ($persetujuan_count_true < 2) { 
                        $pemesanan->update([
                            'status' => 'ditolak',
                        ]);
                    }
                }
    
                if($dataPersetujuan)
                {
                    Alert::success('Success', 'Persetujuan Pemesanan Berhasil');
                    return redirect('/persetujuan');
                    
                } else {
                    
                    Alert::error('Failed', 'Persetujuan Pemesanan Gagal');
                    return redirect('/persetujuan');
                }
            }

        } else {
            return view('error.401');
        }
    }
}
