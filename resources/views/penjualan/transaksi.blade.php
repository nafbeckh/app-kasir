@extends('layouts.template')

@section('content')

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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if (count($penjualan))
            @foreach($penjualan as $item)
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-{{$item->status == 'Belum Bayar' ? 'danger' : 'success'}}">
                    <div class="inner">
                        <h3>{{$item->meja->nama}}</h3>
                        <p>{{$item->status}}</p>
                    </div>
                    @if ($item->status == 'Belum Bayar')
                    <a href="{{ route('penjualan.pembayaran', $item->id) }}" class="small-box-footer">Transaksi <i class="fas fa-arrow-circle-right"></i></a>
                    @else
                    <div style="margin-top: 7px"><br></div>
                    @endif
                </div>
            </div>
            <!-- ./col -->
            @endforeach
            @else
            <div class="col-12">
                <div class="callout">
                    <h5>Belum ada transaksi</h5>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection