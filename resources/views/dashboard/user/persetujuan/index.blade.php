@extends('layouts.sidebar')

@section('sidebar-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Persetujuan Pemesanan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Persetujuan Pemesanan</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List Data Persetujuan Pemesanan
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Dibuat Oleh</th>
                            <th>Driver</th>
                            <th>Kendaraan</th>
                            <th>Jadwal Mulai</th>
                            <th>Jadwal Berakhir</th>
                            <th>Konsumsi BBM per KM</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPemesanan as $item)
                        <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->driver->nama }}</td>
                            <td>{{ $item->kendaraan->nama }}</td>
                            <td>{{ $item->jadwal_start }}</td>
                            <td>{{ $item->jadwal_end }}</td>
                            <td>{{ 'Rp ' . number_format($item->konsumsi_bbm, 2, ',', '.') }}</td>
                            <td>
                                @if ($item->status === 'menunggu')
                                    <span class="badge rounded-pill text-bg-secondary">MENUNGGU PERSETUJUAN</span>
                                @elseif($item->status === 'disetujui')
                                    <span class="badge rounded-pill text-bg-info">DISETUJUI</span>
                                @elseif($item->status === 'ditolak')
                                    <span class="badge rounded-pill text-bg-danger">DITOLAK</span>
                                @elseif($item->status === 'selesai')
                                    <span class="badge rounded-pill text-bg-success">SELESAI</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $item->id }}">
                                        <i class="fa-regular fa-eye" ></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalDetail-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Persetujuan Pihak</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6>
                                        User : {{ $item->user->name }}
                                    </h6>
                                    <br>
                                    <h6>
                                        Driver : {{ $item->driver->nama }}
                                    </h6>
                                    <br>
                                    <h6>
                                        Kendaraan : {{ $item->kendaraan->nama }}
                                    </h6>
                                    <br>
                                    <h6>
                                        Jadwal Start : {{ $item->jadwal_start }}
                                    </h6>
                                    <br>
                                    <h6>
                                        Jadwal End : {{ $item->jadwal_end }}
                                    </h6>
                                    <br>
                                    <h6>
                                        Konsumsi BBM per KM : {{ 'Rp ' . number_format($item->konsumsi_bbm, 2, ',', '.') }}
                                    </h6>
                                    <br>
                                    <h6>
                                        Status Pemesanan : 
                                        @if ($item->status === 'menunggu')
                                            <span class="badge rounded-pill text-bg-secondary">MENUNGGU PERSETUJUAN</span>
                                        @elseif($item->status === 'disetujui')
                                            <span class="badge rounded-pill text-bg-info">DISETUJUI</span>
                                        @elseif($item->status === 'ditolak')
                                            <span class="badge rounded-pill text-bg-danger">DITOLAK</span>
                                        @elseif($item->status === 'selesai')
                                            <span class="badge rounded-pill text-bg-success">SELESAI</span>
                                        @endif
                                    </h6>
                                    <br>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <div>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    <div class="d-flex mr-5 gap-1">
                                        @if ($item->status === 'selesai')
                                        
                                        @else
                                        <form action="/setuju" method="post">
                                        @csrf
                                            <input type="hidden" name="pemesanan_id" value="{{ $item->id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <button type="submit" class="btn btn-danger" name="decline">TIDAK SETUJU</button>
                                            <button type="submit" class="btn btn-success" name="approve">SETUJU</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection