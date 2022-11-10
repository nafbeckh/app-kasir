@extends('layouts.template')

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
                    <li class="breadcrumb-item"><a href="{{ route('notifikasi.index') }}">Notifikasi</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">

            <div class="card-body">
                <h4><b>{{$notif->pesan}}</b></h4><hr>
                <h5><table>{!!$notif->pesan_detail!!}</table></h5>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{route('notifikasi.index')}}" class="btn btn-sm btn-success">Kembali</a>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
</section>
<!-- /.content -->

@endsection