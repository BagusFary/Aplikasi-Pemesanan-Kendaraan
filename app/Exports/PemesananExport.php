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
    protected $jadwal_start;
    protected $jadwal_end;

    public function __construct($jadwal_start, $jadwal_end)
    {
        $this->jadwal_start = $jadwal_start;
        $this->jadwal_end = $jadwal_end;
    }
    
    public function query()
    {
        return Pemesanan::with('user:id,name','driver:id,nama','kendaraan:id,nama')
                        ->where('jadwal_start',$this->jadwal_start)
                        ->where('jadwal_end',$this->jadwal_end);
    }

    public function map($pemesanan): array
    {

        if($pemesanan->status === 0)
        {
            $pemesanan['status'] = 'MENUNGGU PERSETUJUAN';
        } elseif($pemesanan->status === 1)
        {
            $pemesanan['status'] = 'DISETUJUI';
        }elseif($pemesanan->status === 2)
        {
            $pemesanan['status'] = 'DITOLAK';
        }elseif($pemesanan->status === 3)
        {
            $pemesanan['status'] = 'SELESAI';
        }

        return [
            $pemesanan->user->name,
            $pemesanan->driver->nama,
            $pemesanan->kendaraan->nama,
            $pemesanan->jadwal_start,
            $pemesanan->jadwal_end,
            $pemesanan->konsumsi_bmm,
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
