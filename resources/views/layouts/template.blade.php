<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $toko->nama_toko }} | {{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- pace-progress -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/pace-progress/themes/blue/pace-theme-flash.css') }}">
    @stack('css')
</head>

<body class="hold-transition sidebar-mini text-sm">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('assets/dist/img/') }}/{{ $user->foto }}" class="user-image img-circle elevation-2" alt="User Image">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="{{ asset('assets/dist/img/') }}/{{ $user->foto }}" class="img-circle elevation-2" alt="User Image">

                            <p>
                                {{ $user->nama }} - {{ $user->email }}
                                <small>Member since {{ date('M Y', $user->create_at) }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="{{ route('setting.profile') }}" class="btn btn-default btn-flat">Profile</a>
                            <a href="javascript:void(0);" onclick="logout_()" class="btn btn-default btn-flat float-right">Sign out</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="javascript:void(0);" class="brand-link">
                <img src="{{ asset('assets/dist/img') }}/{{ $toko->path_logo }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ $toko->nama_toko }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('assets/dist/img/') }}/{{ $user->foto }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="javascript:void(0);" class="d-block">{{ $user->nama }} <span class="badge @hasrole('admin') badge-success @else badge-danger @endhasrole">@hasrole('admin') admin @else kasir @endhasrole</span></a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ $title == 'Dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>
                        @hasrole('admin')
                        <li class="nav-header">DATA MASTER</li>
                        <li class="nav-item">
                            <a href="{{ route('kategori.index') }}" class="nav-link {{ $title == 'Data Kategori' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cube"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produk.index') }}" class="nav-link {{ $title == 'Data Produk' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>
                                    Produk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('meja.index') }}" class="nav-link {{ $title == 'Data Meja' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    Meja
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">TRANSAKSI</li>
                        <li class="nav-item">
                            <a href="{{ route('pengeluaran.index') }}" class="nav-link {{ $title == 'Data Pengeluaran' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>
                                    Pengeluaran
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item {{ $title == 'Data Pembelian' || $title == 'Tambah Pembelian' ? 'menu-open' : '' }}">
                            <a href="{{ route('pembelian.index') }}" class="nav-link {{ $title == 'Data Pembelian' || $title == 'Tambah Pembelian' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-download"></i>
                                <p>
                                    Pembelian
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('pembelian.index') }}" class="nav-link {{ $title == 'Data Pembelian' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Pembelian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pembelian.create') }}" class="nav-link {{ $title == 'Tambah Pembelian' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Pembelian</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <li class="nav-item {{ $title == 'Data Penjualan' || $title == 'Tambah Penjualan' ? 'menu-open' : '' }}">
                            <a href="{{ route('penjualan.index') }}" class="nav-link {{ $title == 'Data Penjualan' || $title == 'Tambah Penjualan' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-upload"></i>
                                <p>
                                    Penjualan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('penjualan.index') }}" class="nav-link {{ $title == 'Data Penjualan' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Penjualan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('penjualan.create') }}" class="nav-link {{ $title == 'Tambah Penjualan' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Penjualan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">PESANAN AKTIF</li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ $title == 'Pesanan' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Pesanan
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">LAPORAN</li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.pendapatan') }}" class="nav-link {{ $title == 'Laporan Pendapatan' ? 'active' : '' }}">
                                <i class="fas fa-file-pdf nav-icon"></i>
                                <p>Laporan Pendapatan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('laporan.pendapatan') }}" class="nav-link {{ $title == 'Laporan Menu Terlaris' ? 'active' : '' }}">
                                <i class="fas fa-file-pdf nav-icon"></i>
                                <p>Laporan Menu Terlaris</p>
                            </a>
                        </li>

                        {{-- <li class="nav-item {{ $title == 'Laporan Pendapatan' || $title == 'Laporan Kasir' || $title == 'Laporan Supplier' ? 'menu-open' : '' }}">
                            <a href="{{ route('penjualan.index') }}" class="nav-link {{ $title == 'Laporan Pendapatan' || $title == 'Laporan Kasir' || $title == 'Laporan Supplier' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-pdf"></i>
                                <p>
                                    Laporan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('laporan.pendapatan') }}" class="nav-link {{ $title == 'Laporan Pendapatan' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Pendapatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('laporan.kasir') }}" class="nav-link {{ $title == 'Laporan Kasir' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Kasir</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('laporan.supplier') }}" class="nav-link {{ $title == 'Laporan Supplier' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Supplier</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <li class="nav-header">SYSTEM</li>

                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ $title == 'Data User' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Data User
                                </p>
                            </a>
                        </li>
                        @endhasrole
                        @hasrole('kasir')
                        <li class="nav-item">
                            <a href="{{ route('penjualan.create') }}" class="nav-link {{ $title == 'Tambah Penjualan' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-upload"></i>
                                <p>
                                    Penjualan
                                </p>
                            </a>
                        </li>
                        @endhasrole
                        <li class="nav-item {{ $title == 'Setting Toko' || $title == 'Setting Profile' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $title == 'Setting Toko' || $title == 'Setting Profile' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sliders-h"></i>
                                <p>
                                    Setting
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('setting.profile') }}" class="nav-link {{ $title == 'Setting Profile' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                @hasrole('admin')
                                <li class="nav-item">
                                    <a href="{{ route('setting.toko') }}" class="nav-link {{ $title == 'Setting Toko' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Toko</p>
                                    </a>
                                </li>
                                @endhasrole
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; {{ date('Y') }} <a href="https://instagram.com/a_freelanc" target="_blank">a_freelanc</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    </div>
    <form action="{{ route('logout') }}" method="POST" id="form_logout" class="d-none">
        @csrf
    </form>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
    <!-- pace-progress -->
    <script src="{{ asset('assets/plugins/pace-progress/pace.min.js') }}"></script>

    @stack('js')
    <script>
        function logout_() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logout!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
                confirmButtonAriaLabel: 'Thumbs up, Yes!',
                cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
                cancelButtonAriaLabel: 'Thumbs down',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $('#form_logout').submit();
                }
            })
        }

        $(document).ready(function() {
            $('body').tooltip({
                selector: '[data-toggle="tooltip"]',
                delay: {
                    hide: 200
                },
            });
            // console.clear();
            // logout_()
            // Swal.fire('Any fool can use a computer')
        })
    </script>
</body>

</html>