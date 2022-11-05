@extends('layouts.template')

@push('css')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-checkboxes/css/dataTables.checkboxes.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $title }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/dist/img/') }}/{{ $user->foto }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->nama }}</h3>

                        <p class="text-muted text-center">{{ $user->email }}</p>

                        <button type="button" onclick="logout_()" class="btn btn-danger btn-block"><i class="fas fa-sign-out-alt mr-1"></i>LOGOUT</button>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-9">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info!</h5>
                    Kosongkan Password jika tidak ingin mengganti password !
                </div>
                <div class="card card-outline card-primary">
                    <div class="card-header p-2">
                        <h3 class="card-title"><i class="fas fa-user mr-1" data-toggle="tooltip" title="{{ $title }}"></i>{{ $title }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" id="form" action="{{ route('setting.profileUpdate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" required value="{{ $user->nama }}">
                                    @error('nama')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email :</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" disabled value="{{ $user->email }}">
                                    @error('email')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="foto" class="col-sm-3 col-form-label">Foto :</label>
                                <div class="col-sm-9">
                                    <div class="custom-file mb-1">
                                        <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto">
                                        <label class="custom-file-label" for="foto">Choose file</label>
                                    </div>
                                    @error('foto')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                    <img src="{{ asset('assets/dist/img') }}/{{ $user->foto }}" alt="User Profile" width="100px" height="100px">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Password :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                                    @error('password')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password2" class="col-sm-3 col-form-label">Confirm Password :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="password2" class="form-control @error('password2') is-invalid @enderror" id="password2" placeholder="Confirm Password">
                                    @error('password2')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" required> I agree to the <a href="#">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-info"><i class="fab fa-telegram-plane mr-1"></i>Submit</button>
                                </div>
                            </div>
                        </form>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</section>
@endsection

@push('js')


<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/custom.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-checkboxes/js/dataTables.checkboxes.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();

    })
</script>
@if(session()->has('success'))
<script>
    Swal.fire(
        'Success',
        "{{ session('success') }}",
        'success'
    )
</script>
@elseif(session()->has('error'))
<script>
    Swal.fire(
        'Failed!',
        "{{ session('error') }}",
        'error'
    )
</script>
@endif

@endpush