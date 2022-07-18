<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Sarpas</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/assets/css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />

</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::user()->name}}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <form action="{{url('/logout')}}" method="post" id="logout">
                                @csrf
                                <a href="#" onclick="document.getElementById('logout').submit()"
                                    class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('/') }}">Sarpras</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/') }}">SP</a>
                    </div>
                    @if (Auth::user()->role==2)
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li
                            class="nav-item dropdown <?php if(Request::is('peminjaman') || Request::is('pengembalian') || Request::is('report_peminjaman') ){ echo 'active'; }else{ echo '';} ?>">
                            <a href="#" class="nav-link has-dropdown"><i
                                    class="far fa-clipboard"></i><span>Dashboard</span></a>
                            <ul class="dropdown-menu">
                                <li
                                    class="<?php if(Request::is('report_peminjaman')){ echo 'active'; }else{ echo '';} ?>">
                                    <a class="nav-link" href="{{ url('/report_peminjaman') }}">Peminjaman Inventaris</a>
                                </li>
                                <li class="<?php if(Request::is('peminjaman')){ echo 'active'; }else{ echo '';} ?>"><a
                                        class="nav-link" href="{{ url('/peminjaman') }}">Verifikasi Peminjaman</a>
                                </li>
                                <li class="<?php if(Request::is('pengembalian') ){ echo 'active'; }else{ echo '';} ?>">
                                    <a class="nav-link" href="{{ url('/pengembalian') }}">Verifikasi Pengembalian</a>
                                </li>

                            </ul>
                        </li>

                        <li class="<?php if(Request::is('kelola_inventaris') ){ echo 'active'; }else{ echo '';} ?>"><a
                                class="nav-link" href="{{ url('/kelola_inventaris') }}"><i class="fas fa-boxes"></i>
                                <span>Kelola Inventaris</span></a></li>
                        <li class="<?php if(Request::is('kelola_lab') ){ echo 'active'; }else{ echo '';} ?>"><a
                                class="nav-link" href="{{ url('/kelola_lab') }}"><i class="fas fa-person-booth"></i>
                                <span>Kelola
                                    Laboratorium</span></a></li>
                    </ul>
                    @elseif (Auth::user()->role==3)
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="nav-item dropdown active">
                            <a href="#" class="nav-link has-dropdown"><i
                                    class="far fa-clipboard"></i><span>Dashboard</span></a>
                            <ul class="dropdown-menu">
                                <li class="<?php if(Request::is('peminjaman')){ echo 'active'; }else{ echo '';} ?>"><a
                                        class="nav-link" href="{{ url('/peminjaman') }}">Pengajuan Inventaris</a>
                                </li>
                                <li class="<?php if(Request::is('pengembalian')){ echo 'active'; }else{ echo '';} ?>"><a
                                        class="nav-link" href="{{ url('/pengembalian') }}">Pengembalian Inventaris</a>
                                </li>
                                <li
                                    class="<?php if(Request::is('riwayat_peminjaman') ){ echo 'active'; }else{ echo '';} ?>">
                                    <a class="nav-link" href="{{ url('/riwayat_peminjaman') }}">Riwayat Peminjaman</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @else
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="nav-item dropdown active">
                            <a href="#" class="nav-link has-dropdown"><i
                                    class="far fa-clipboard"></i><span>Dashboard</span></a>
                            <ul class="dropdown-menu">
                                <li class="<?php if(Request::is('report_peminjaman')){ echo 'active'; }else{ echo '';} ?>"><a class="nav-link" href="{{url('report_peminjaman')}}">Laporan Peminjaman</a>
                                </li>
                                <li class="<?php if(Request::is('report_lab')){ echo 'active'; }else{ echo '';} ?>"><a
                                        class="nav-link" href="{{url('report_lab')}}">Data Lab</a>
                                <li class=<?php if(Request::is('report_data_user')){ echo 'active'; }else{ echo '';} ?>>
                                    <a class="nav-link" href="{{url('report_data_user')}}">Data User</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif


                </aside>
            </div>
            @yield('content')
            <!-- Main Content -->
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022 <div class="bullet"></div>Pengelolaan Inventaris</a>
                </div>
            </footer>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    {{-- DATATABLE --}}
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <!-- INVENTARIS -->
    <script>
        $(document).ready(function () {
            $('#data_inven').DataTable();
        });
    </script>
    <!-- LAB -->
    <script>
        $(document).ready(function () {
            $('#kelola_lab').DataTable();
        });
    </script>

    <!-- PEMINJAMAN -->
    <script>
        $(document).ready(function () {
            $('#report_peminjaman').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'print', footer: true },
                    { extend: 'pdf', footer: true },
                    'copy', 'csv', 'excel'
                ]
            });
        });
    </script>
    <!-- PEMINJAMAN -->
    <script>
        $(document).ready(function () {
            $('#verif_peminjaman').DataTable();
        });
    </script>
    <!-- PENGEMBALIAN -->
    <script>
        $(document).ready(function () {
            $('#verif_pengembalian').DataTable();
        });
    </script>
    <!-- RIWAYAT -->
    <script>
        $(document).ready(function () {
            $('#riwayat').DataTable();
        });
    </script>
    <!-- LAB -->
    <script>
        $(document).ready(function () {
            $('#lab').DataTable();
        });
    </script>



</body>

</html>
