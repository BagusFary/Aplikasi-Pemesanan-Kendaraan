@extends('layouts.sidebar')

@section('sidebar-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row justify-content-center">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Total Driver</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="medium text-white">{{ $totalDriver }}</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Total Kendaraan</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="medium text-white">{{ $totalKendaraan }}</div>
                    </div>
                </div>
            </div>
        {{-- <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Grafik Pemakaian Kendaraan
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div> --}}
    </div>
</main>
@endsection