<?php

namespace App\Exports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PemesananExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public $tanggal_awal;
    public $tanggal_akhir;

    public function __construct($tanggal_awal, $tanggal_akhir)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
    }
    
    public function query()
    {
        return Pemesanan::with('user:id,name','driver:id,nama','kendaraan:id,nama')
                        ->whereBetween('dibuat_pada',[$this->tanggal_awal,$this->tanggal_akhir]);
    }

    public function map($pemesanan): array
    {

        if($pemesanan->status === 'menunggu')
        {
            $pemesanan['status'] = 'MENUNGGU PERSETUJUAN';
        } elseif($pemesanan->status === 'disetujui')
        {
            $pemesanan['status'] = 'DISETUJUI';
        }elseif($pemesanan->status === 'ditolak')
        {
            $pemesanan['status'] = 'DITOLAK';
        }elseif($pemesanan->status === 'selesai')
        {
            $pemesanan['status'] = 'SELESAI';
        }

        return [
            $pemesanan->user->name,
            $pemesanan->driver->nama,
            $pemesanan->kendaraan->nama,
            $pemesanan->jadwal_start,
            $pemesanan->jadwal_end,
            $pemesanan->konsumsi_bbm,
            $pemesanan->status,
            $pemesanan->created_at
        ];
    }

    public function headings(): array
    {
        return [
           'Dibuat Oleh',
           'Driver',
           'Kendaraan',
           'Jadwal Mulai',
           'Jadwal Berakhir',
           'Konsumsi BBM',
           'Status',
           'Pesanan dibuat pada'
        ];
    }
}
