<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $toko->nama_toko }} | {{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>

<body class="text-sm">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <i class="fas fa-globe"></i> {{ $toko->nama_toko }}
                        <small class="float-right">Tanggal Cetak: {{ date('d/M/Y H:i:s') }}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Dari
                    <address>
                        <strong>{{ $toko->nama_toko }}</strong><br>
                        {{ $toko->alamat }}<br>
                        Telepon: {{ $toko->telp }}<br>
                        Kasir: {{ $penjualan->user->nama }}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Kepada
                    <address>
                        <strong>{{ $penjualan->member->nama }}</strong><br>
                        {{ $penjualan->member->alamat }}<br>
                        Telepon: {{ $penjualan->member->telp }}<br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <br>
                    <b>Invoice</b>
                    <br>{{ $penjualan->kode_penj }}<br>
                    <b>Tanggal Pembayaran:</b> {{ date('d/M/Y H:i:s', strtotime($penjualan->created_at)) }}<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Diskon</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penjualan->penjualan_detail as $prod)
                            <tr>
                                <td>{{ $prod->produk->kode_prod }}</td>
                                <td>{{ $prod->produk->nama_prod }}</td>
                                <td>{{ format_uang($prod->harga_jual) }}</td>
                                <td>{{ $prod->jumlah }}</td>
                                <td>{{ $prod->diskon }}</td>
                                <td>{{ format_uang($prod->subtotal) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Note :</p>
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan.
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Total Harga :</th>
                                <td>Rp. {{ format_uang($penjualan->total_harga) }}</td>
                            </tr>
                            <tr>
                                <th>Diskon :</th>
                                <td>{{ $penjualan->diskon }}</td>
                            </tr>
                            <tr>
                                <th>Grand Total :</th>
                                <td>Rp. {{ format_uang($penjualan->bayar) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>