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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users mr-1" data-toggle="tooltip" title="{{ $title }}"></i>{{ $title }}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('setting.toko.update') }}" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label"><i class="fas fa-file-signature mr-1" data-toggle="tooltip" title="Nama Toko"></i> Nama Toko</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama Toko" value="{{ $toko->nama_toko }}" required minlength="3" maxlength="25">
                            @error('nama')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telp" class="col-sm-2 col-form-label"><i class="fas fa-phone mr-1" data-toggle="tooltip" title="No Telp Toko"></i>No Telp Toko</label>
                        <div class="col-sm-10">
                            <input type="number" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="Masukkan No Telp Toko" value="{{ $toko->telp }}" required minlength="3" maxlength="25">
                            @error('telp')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label"><i class="fas fa-image mr-1" data-toggle="tooltip" title="Logo Toko"></i>Logo Toko :</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto">
                                <label class="custom-file-label" for="foto">Choose file</label>
                            </div>
                            @error('foto')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                            <img src="{{ asset('assets/dist/img') }}/{{ $toko->path_logo }}" alt="Logo Toko" width="100px" height="100px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label"><i class="fas fa-map-marker mr-1" data-toggle="tooltip" title="Alamat Toko"></i>Alamat Toko</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat">{{ $toko->alamat }}</textarea>
                            @error('alamat')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-info"><i class="fab fa-telegram-plane mr-1"></i>Submit</button>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
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
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
    })
</script>
@endpush