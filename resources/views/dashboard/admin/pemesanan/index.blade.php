@extends('layouts.sidebar')

@section('sidebar-content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pemesanan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Data Pemesanan</li>
            </ol>
            <div class="d-flex justify-content-between mb-2">
                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalExcel">
                    <i class="fa-solid fa-file-export"></i>
                    Export Pemesanan
                </button>
                <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Pemesanan
                </button>
            </div>
            <div class="my-2">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Failed.</strong> {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed</strong> {{ session('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    List Data Pemesanan
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
                                <th>Dibuat Pada</th>
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
                                    <td>{{ date_format($item->created_at, 'Y-m-d') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div class="d-flex gap-2">
                                                @if ($item->status === 'menunggu')
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit-{{ $item->id }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                @endif
                                                @if ($item->status === 'menunggu' || $item->status === 'ditolak' || $item->status === 'selesai')
                                                
                                                @else
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modalSelesai-{{ $item->id }}">
                                                        <i class="fa-regular fa-circle-check"></i>
                                                    </button>
                                                @endif
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalDelete-{{ $item->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalExcel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Export Laporan Pemesanan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/export-excel" method="post">
                            @csrf
                            <div class="mb-2">
                                <label for="tanggal_awal">Dari Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal"
                                    placeholder="Masukkan tanggal" required>
                            </div>
                            <div class="mb-2">
                                <label for="tanggal_akhir">Hingga Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir"
                                    placeholder="Masukkan tanggal" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-file-export"></i>
                                    Export Pemesanan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </main>




    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Pemesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/pemesanan/store" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="mb-2">
                            <label for="driver_id">Driver</label>
                            <select class="form-select" id="driver_id" name="driver_id">
                                @foreach ($dataDriver as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="kendaraan_id">Kendaraan</label>
                            <select class="form-select" id="kendaraan_id" name="kendaraan_id">
                                @foreach ($dataKendaraan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="konsumsi_bbm">Jarak Konsumsi BBM (KM)</label>
                            <input type="number" class="form-control" id="konsumsi_bbm" name="konsumsi_bbm"
                                placeholder="Inputkan Angka" required>
                        </div>
                        <div class="mb-2">
                            <label for="jadwal_start">Jadwal Mulai</label>
                            <input type="date" class="form-control" id="jadwal_start" name="jadwal_start" required>
                        </div>
                        <div class="mb-2">
                            <label for="jadwal_end">Jadwal Berakhir</label>
                            <input type="date" class="form-control" id="jadwal_end" name="jadwal_end" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>




    @foreach ($dataPemesanan as $item)
        <div class="modal fade" id="modalDelete-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Pemesanan</h1>
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
                            Status :
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
                    <form action="/pemesanan/delete" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalEdit-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Pemesanan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/pemesanan/update" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="status" value="{{ $item->status }}">
                            <div class="mb-2">
                                <label for="driver_id">Driver</label>
                                <select class="form-select" id="driver_id" name="driver_id">
                                    @foreach ($dataDriver as $driverSelect)
                                        <option value="{{ $driverSelect->id }}"
                                            {{ $item->driver->id == $driverSelect->id ? 'selected' : '' }}>
                                            {{ $driverSelect->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="kendaraan_id">Kendaraan</label>
                                <input type="hidden" name="kendaraan_id" value="{{ $item->kendaraan->id }}">
                                <input type="text" class="form-control" id="kendaraan_id"
                                    value="{{ $item->kendaraan->nama }}" disabled>
                            </div>
                            <div class="mb-2">
                                <label for="konsumsi_bbm">Jarak Konsumsi BBM (KM)</label>
                                <input type="text" class="form-control" id="konsumsi_bbm" name="konsumsi_bbm"
                                    value="{{ 'Rp ' . number_format($item->konsumsi_bbm, 2, ',', '.') }}"
                                    placeholder="Inputkan Angka" disabled>
                            </div>
                            <div class="mb-2">
                                <label for="jadwal_start">Jadwal Mulai</label>
                                <input type="date" class="form-control" id="jadwal_start" name="jadwal_start"
                                    value="{{ $item->jadwal_start }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="jadwal_end">Jadwal Berakhir</label>
                                <input type="date" class="form-control" id="jadwal_end" name="jadwal_end"
                                    value="{{ $item->jadwal_end }}" required>
                            </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalSelesai-{{ $item->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Status Pemesanan Dibawah Menjadi
                            Selesai?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="driver_id">Driver</label>
                            <select class="form-select" id="driver_id" name="driver_id" disabled>
                                @foreach ($dataDriver as $driverSelect)
                                    <option value="{{ $driverSelect->id }}"
                                        {{ $item->driver->id == $driverSelect->id ? 'selected' : '' }}>
                                        {{ $driverSelect->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="kendaraan_id">Kendaraan</label>
                            <input type="hidden" name="kendaraan_id" value="{{ $item->kendaraan->id }}">
                            <input type="text" class="form-control" id="kendaraan_id"
                                value="{{ $item->kendaraan->nama }}" disabled>
                        </div>
                        <div class="mb-2">
                            <label for="konsumsi_bbm">Jarak Konsumsi BBM (KM)</label>
                            <input type="text" class="form-control" id="konsumsi_bbm" name="konsumsi_bbm"
                                value="{{ 'Rp ' . number_format($item->konsumsi_bbm, 2, ',', '.') }}"
                                placeholder="Inputkan Angka" disabled>
                        </div>
                        <div class="mb-2">
                            <label for="jadwal_start">Jadwal Mulai</label>
                            <input type="date" class="form-control" id="jadwal_start" name="jadwal_start"
                                value="{{ $item->jadwal_start }}" disabled>
                        </div>
                        <div class="mb-2">
                            <label for="jadwal_end">Jadwal Berakhir</label>
                            <input type="date" class="form-control" id="jadwal_end" name="jadwal_end"
                                value="{{ $item->jadwal_end }}" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="/pemesanan-selesai" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="status" value="{{ $item->status }}">
                            <button type="submit" class="btn btn-outline-success">Selesai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
