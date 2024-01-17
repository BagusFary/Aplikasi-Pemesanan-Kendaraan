@extends('layouts.template')

@if (Auth::user()->roles == 'admin')
    @section('title','Halaman Admin')
@elseif(Auth::user()->roles == 'user')
    @section('title','Halaman User')
@endif

@section('content')
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/">
        Dashboard 
        @if (Auth::user()->roles == 'admin')
            Admin
        @elseif(Auth::user()->roles == 'user')
            User
        @endif
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li><hr class="dropdown-divider" /></li>
                <form action='/logout' method="POST">
                    @csrf
                    <div class="justify-content-center">
                        <button type="submit" class="dropdown-item">Logout</button>
                    </div>
                </form>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading" style="color:white">Manage</div>
                    <a class="nav-link" href="/">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-line" style="color:white"></i></div>
                        Dashboard
                    </a>
                    @if (Auth::user()->roles == 'admin')
                    <a class="nav-link" href="/driver">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-person" style="color:white"></i></div>
                        Data Driver
                    </a>
                    <a class="nav-link" href="/kendaraan">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-car-side" style="color:white"></i></div>
                        Data Kendaraan
                    </a>
                    <a class="nav-link" href="/pemesanan">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-bell" style="color:white"></i></div>
                        Pemesanan
                    </a>
                    @endif
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small" style="color:white">Logged in as:</div>
                @if (Auth::user()->roles == 'admin')
                <div class="strong" style="color:white">
                    Admin
                </div>    
                @elseif(Auth::user()->roles == 'user')
                <div class="strong" style="color:white">
                    User
                </div>
                @endif
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
       @yield('sidebar-content')
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
@endsection