<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $toko->nama_toko }} | {{ $title }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/dist/img') }}/{{ $toko->path_logo }}" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
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
                @hasrole('waiters')
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modalCart">
                        <i class="fas fa-shopping-basket"></i>
                        <span class="badge badge-primary navbar-badge total-count"></span>
                    </a>
                </li>
                @endhasrole
                <li class="nav-item dropdown" onclick="fetchNotif()">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                      <i class="far fa-bell"></i>
                      <span class="badge badge-warning navbar-badge" data-count="" id="counterNotif"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="fetchNotf">
                      <div id="fetchNotif">
                        
                      </div>
                      <a href="{{route('notifikasi.index')}}" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
                    </div>
                </li>
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
                                <small>Member since {{ date('M Y', strtotime($user->created_at)) }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="{{ route('setting.profile') }}" class="btn btn-default btn-flat">Profile</a>
                            <a href="javascript:void(0);" onclick="logout_()" class="btn btn-default btn-flat float-right">Sign out</a>
                        </li>
                    </ul>
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
                        @hasrole('admin')
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ $title == 'Dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>
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
                        <li class="nav-item">
                            <a href="{{ route('penjualan.index') }}" class="nav-link {{ $title == 'Data Penjualan' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-upload"></i>
                                <p>
                                    Penjualan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penjualan.transaksi') }}" class="nav-link {{ $title == 'Transaksi' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>
                                    Transaksi
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
                            <a href="{{ route('laporan.terlaris') }}" class="nav-link {{ $title == 'Laporan Menu Terlaris' ? 'active' : '' }}">
                                <i class="fas fa-file-pdf nav-icon"></i>
                                <p>Laporan Menu Terlaris</p>
                            </a>
                        </li>

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
                            <a href="{{ route('penjualan.index') }}" class="nav-link {{ $title == 'Data Penjualan' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-upload"></i>
                                <p>
                                    Penjualan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penjualan.transaksi') }}" class="nav-link {{ $title == 'Transaksi' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>
                                    Transaksi
                                </p>
                            </a>
                        </li>
                        @endhasrole
                        @hasrole('waiters')
                        <li class="nav-item">
                            <a href="{{ route('menu.index') }}" class="nav-link {{ $title == 'Pemesanan Menu' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>
                                    Pemesanan Menu
                                </p>
                            </a>
                        </li>
                        @endhasrole
                        @hasrole('bartender')
                        <li class="nav-item">
                            <a href="{{ route('notifikasi.index') }}" class="nav-link {{ $title == 'Semua Notifikasi' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-bell"></i>
                                <p>
                                    Notifikasi
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

        <audio id="audioNotif" hidden src="{{ asset('assets/dist/audio/notification.mp3') }}"></audio>

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
    <script src="{{ asset('assets/dist/js/pusher.min.js') }}"></script>
    
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

            Pusher.logToConsole = true;
            var pusher = new Pusher('a2c0df40a01f5334b6a6', {
                cluster: 'ap1'
            });

            var audio = new Audio($('#audioNotif').attr('src'));
            
            var channel = pusher.subscribe('notification');
            channel.bind('NotificationEvent', function(data) {
                // console.log(JSON.stringify(data));
                for (let i = 0; i < data.length; i++){
                    if (data[i].for == {{$user->id}}) {
                        audio.play();
                        $('#counterNotif').html(data[i].count);
                    }
                }
            });

            countNotif()
        })

        function countNotif(){
            $.ajax({
                type: 'GET',
                url: "{{ route('notifikasi.cekNotif') }}",
                success: function(data){
                    $('#counterNotif').html(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function fetchNotif(){
            $.ajax({
                type: 'GET',
                url: "{{ route('notifikasi.fetchNotif') }}",
                success: function(data){
                    $('#fetchNotif').html(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    </script>
</html>