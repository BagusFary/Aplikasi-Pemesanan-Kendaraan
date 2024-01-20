@extends('layouts.sidebar')

@section('sidebar-content')
<main>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Riwayat Pemakaian {{ $detailKendaraan->nama }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Riwayat Pemakaian Kendaraan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ $detailKendaraan->nama }} ({{ $detailKendaraan->plat }})
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Dibuat Oleh</th>
                            <th>Driver</th>
                            <th>Jadwal Mulai</th>
                            <th>Jadwal Berakhir</th>
                            <th>Konsumsi BBM per KM</th>
                            <th>Status</th>
                            <th>Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailKendaraan->pemesanan as $item)
                        <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->driver->nama }}</td>
                            <td>{{ $item->jadwal_start }}</td>
                            <td>{{ $item->jadwal_end }}</td>
                            <td>{{ $item->konsumsi_bbm }}</td>
                            <td>
                                @if($item->status === 'selesai')
                                    <span class="badge rounded-pill text-bg-success">SELESAI</span>
                                @endif
                            </td>
                            <td>{{ $item->dibuat_pada }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection