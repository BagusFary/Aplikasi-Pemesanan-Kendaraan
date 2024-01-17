@extends('layouts.sidebar')

@section('sidebar-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kendaraan</h1>
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item active">Data Kendaraan</li>
        </ol>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fa-solid fa-plus"></i>
                Tambah Kendaraan
            </button>
            <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Kendaraan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/store-kendaraan" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="L300"
                                        required>
                                </div>
                                <div class="mb-2">
                                    <label for="plat" class="form-label">Plat</label>
                                    <input type="text" class="form-control" name="plat" id="plat" placeholder="GH 5500"
                                        required>
                                </div>
                                <div class="mb-2">
                                    <label for="konsumsi_bbm_per_km" class="form-label">Konsumsi BBM /KM</label>
                                    <input type="number" class="form-control" name="konsumsi_bbm_per_km"
                                        id="konsumsi_bbm_per_km" placeholder="15000" required>
                                </div>
                                <div class="mb-2">
                                    <label for="kepemilikan" class="form-label">Kepemilikan</label>
                                    <select class="form-select" name="kepemilikan" id="kepemilikan"
                                        aria-label="Default select example">
                                        <option value="perusahaan" selected>Perusahaan</option>
                                        <option value="sewaan">Sewaan</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                                    <select class="form-select" name="jenis_kendaraan" id="jenis_kendaraan"
                                        aria-label="Default select example">
                                        <option value="angkutan_orang" selected>Angkutan Orang</option>
                                        <option value="angkutan_barang">Angkutan Barang</option>
                                    </select>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed</strong> {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="card mb-4 mt-2">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List Data Kendaraan
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Plat</th>
                            <th>Konsumsi BBM /KM</th>
                            <th>Kepemilikan</th>
                            <th>Jenis Kendaraan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataKendaraan as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->plat }}</td>
                            <td>{{"Rp " . number_format($item->konsumsi_bbm_per_km,2,',','.')  }}</td>
                            <td>
                                @if ($item->kepemilikan == 'perusahaan')
                                Perusahaan
                                @elseif($item->kepemilikan == 'sewaan')
                                Sewaan
                                @endif
                            </td>
                            <td>
                                @if ($item->jenis_kendaraan == 'angkutan_orang')
                                Angkutan Orang
                                @elseif($item->jenis_kendaraan == 'angkutan_barang')
                                Angkutan Barang
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit-{{ $item->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $item->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="modalEdit-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="/update-kendaraan" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Kendaraan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <div class="mb-2">
                                                            <label for="nama" class="form-label">Nama</label>
                                                            <input type="text" class="form-control" name="nama" id="nama"  value="{{ $item->nama }}"
                                                                required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="plat" class="form-label">Plat</label>
                                                            <input type="text" class="form-control" name="plat" id="plat" value="{{ $item->plat }}"
                                                                required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="konsumsi_bbm_per_km" class="form-label">Konsumsi BBM /KM</label>
                                                            <input type="number" class="form-control" name="konsumsi_bbm_per_km" value="{{ $item->konsumsi_bbm_per_km }}"
                                                                id="konsumsi_bbm_per_km"  required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="kepemilikan"
                                                                class="form-label">Kepemilikan</label>
                                                            <select class="form-select" name="kepemilikan"
                                                                id="kepemilikan"
                                                                aria-label="Default select example">
                                                        
                                                                <option value="perusahaan" @if ($item->kepemilikan
                                                                    == 'perusahaan')
                                                                    selected
                                                                    @else
                                                        
                                                                    @endif
                                                                    >Perusahaan</option>
                                                                <option value="sewaan" @if ($item->kepemilikan ==
                                                                    'sewaan')
                                                                    selected
                                                                    @else
                                                        
                                                                    @endif
                                                                    >Sewaan</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="jenis_kendaraan" class="form-label">Jenis
                                                                Kendaraan</label>
                                                            <select class="form-select" name="jenis_kendaraan"
                                                                id="jenis_kendaraan"
                                                                aria-label="Default select example">
                                                                <option value="angkutan_orang" @if ($item->
                                                                    jenis_kendaraan == 'angkutan_orang')
                                                                    selected
                                                                    @else
                                                        
                                                                    @endif
                                                                    >Angkutan Orang</option>
                                                                <option value="angkutan_barang" @if ($item->
                                                                    jenis_kendaraan == 'angkutan_barang')
                                                                    selected
                                                                    @else
                                                        
                                                                    @endif
                                                                    >Angkutan Barang</option>
                                                            </select>
                                                        </div>
                        
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning">Simpan</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>


                                    
                                    <div class="modal fade" id="deleteModal-{{ $item->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus
                                                        Kendaraan?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h6>
                                                        Nama : {{ $item->nama }}
                                                    </h6>
                                                    <br>
                                                    <h6>
                                                        Plat : {{ $item->plat }}
                                                    </h6>
                                                    <br>
                                                    <h6>
                                                        Kepemilikan :
                                                        @if ($item->kepemilikan == 'perusahaan')
                                                        Perusahaan
                                                        @elseif($item->kepemilikan == 'sewaan')
                                                        Sewaan
                                                        @endif
                                                    </h6>
                                                    <br>
                                                    <h6>
                                                        Jenis Kendaraan :
                                                        @if ($item->jenis_kendaraan == 'angkutan_orang')
                                                        Angkutan Orang
                                                        @elseif($item->jenis_kendaraan == 'angkutan_barang')
                                                        Angkutan Barang
                                                        @endif
                                                    </h6>
                                                    <br>
                                                </div>
                                                <form action="/delete-kendaraan" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
</main>
@endsection