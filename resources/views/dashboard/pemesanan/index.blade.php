@extends('layouts.sidebar')

@section('sidebar-content')


<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pemesanan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Pemesanan</li>
        </ol>
        <div class="d-flex justify-content-end mb-2">
            <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fa-solid fa-plus"></i>
                Tambah Pemesanan
            </button>
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
                            <th>User</th>
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
                            <td>{{"Rp " . number_format($item->konsumsi_bbm,2,',','.')  }}</td>
                            <td>
                                @if ($item->is_status == false)
                                    <span class="badge rounded-pill text-bg-secondary">INACTIVE</span>
                                @elseif($item->is_status == true)
                                    <span class="badge rounded-pill text-bg-success">ACTIVE</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit-{{ $item->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $item->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
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


<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Pemesanan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="/store-pemesanan" method="post">
        @csrf
        <div class="mb-2">
            <label for="user_id">User</label>
            <select class="form-select" id="user_id" name="user_id" required>
                @foreach ($dataUser as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
        </div>
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
            <input type="number" class="form-control" id="konsumsi_bbm" name="konsumsi_bbm" placeholder="Inputkan Angka" required>
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
  <div class="modal fade" id="modalDelete-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
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
                Konsumsi BBM per KM : {{"Rp " . number_format($item->konsumsi_bbm,2,',','.')  }}
            </h6>
            <br>
            <h6>
                Status : 
                @if ($item->is_status == false)
                    <span class="badge rounded-pill text-bg-secondary">INACTIVE</span>
                @elseif($item->is_status == true)
                    <span class="badge rounded-pill text-bg-success">ACTIVE</span>
                @endif
            </h6>
            <br>
        </div>
        <form action="/delete-pemesanan" method="post">
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


<div class="modal fade" id="modalEdit-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Pemesanan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="/update-pemesanan" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $item->id }}">
        <div class="mb-2">
            <label for="user_id">User</label>
            <select class="form-select" id="user_id" name="user_id" required>
                <option value="{{ $item->user->id }}">{{ $item->user->name }}</option>
                @foreach ($dataUser as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
        </div>
        <div class="mb-2">
            <label for="driver_id">Driver</label>
            <select class="form-select" id="driver_id" name="driver_id">
                {{-- <option value="{{ $item->driver->id }}" selected>{{ $item->driver->nama }}</option> --}}
                @foreach ($dataDriver as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
              </select>
        </div>
        <div class="mb-2">
            <label for="kendaraan_id">Kendaraan</label>
            <select class="form-select" id="kendaraan_id" name="kendaraan_id">
                {{-- <option value="{{ $item->kendaraan->id }}" selected>{{ $item->kendaraan->nama }}</option> --}}
                @foreach ($dataKendaraan as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
              </select>
        </div>
        <div class="mb-2">
            <label for="konsumsi_bbm">Jarak Konsumsi BBM (KM)</label>
            <input type="number" class="form-control" id="konsumsi_bbm" name="konsumsi_bbm" placeholder="Inputkan Angka" value="{{ $item->konsumsi_bbm }}">
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
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
    </form>
      </div>
    </div>
  </div>
  @endforeach

  


    
@endsection