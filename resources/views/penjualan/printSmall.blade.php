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
    <style>
        *,
        ::after,
        ::before {
            box-sizing: unset;
        }
    </style>
</head>

<body>
    <div class="wrapper" style="width: 60mm;height: 110%;font-family:'PT Sans', sans-serif;color: black;">
        <!-- Main content -->
        <section class="invoice">
            <div class="row text-center">
                <div class="col-12">
                    <img src="{{ asset('assets/dist/img') }}/{{ $toko->path_logo }}" alt="Logo" class="brand-image" style="width: 50%;">
                    <br><b><span style="font-size: x-large;">{{ $toko->nama_toko }}</span></b>
                    <br><span style="font-size: large;">{{ $toko->alamat }}</span>
                    <br><span style="font-size: large;">{{ $toko->telp }}</span>
                    <br>Tgl Pemb: {{ date('d-M-Y H:i:s', strtotime($penjualan->created_at)) }}
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    ===========================
                    <!-- ############################ -->
                    <!-- **************************** -->
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Produk</th>
                                <th style="text-align: right;">Hrg</th>
                                <th style="text-align: right;">Qty</th>
                                <th style="text-align: right;">Sub</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penjualan->penjualan_detail as $prod)
                            <tr>
                                <td style="text-align: left;">{{ $prod->produk->nama_prod }}</td>
                                <td style="text-align: right;">{{ format_uang($prod->produk->harga_jual) }}</td>
                                <td style="text-align: right;">{{ $prod->jumlah }}</td>
                                <td style="text-align: right;">{{ format_uang($prod->subtotal) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    ===========================
                    <!-- **************************** -->
                    <!-- ############################ -->
                    <table style="width: 100%">
                        <tr>
                            <th style="text-align: right;">Total Harga :</th>
                            <th style="text-align: right;">{{ format_uang($penjualan->total_harga) }}</th>
                        </tr>
                        <tr>
                            <th style="text-align: right;">Bayar :</th>
                            <th style="text-align: right;">{{ format_uang($penjualan->diterima) }}</th>
                        </tr>
                        <tr>
                            <th style="text-align: right;">Kembali :</th>
                            <th style="text-align: right;">{{ format_uang($penjualan->diterima - $penjualan->total_harga) }}</th>
                        </tr>
                    </table>
                    ===========================
                    <!-- **************************** -->
                    <!-- ############################ -->
                    <div class="text-center">
                        Cetak : {{ date('d-M-Y H:i:s') }}
                        <br>Kasir : {{ $penjualan->kasir->nama }}
                        =========================
                        <!-- ************************** -->
                        <!-- ########################## -->

                    </div>
                </div>
            </div>
        </section>
    </div>
    <p style="page-break-before: always">

</body>
<script>
    window.addEventListener("load", window.print());
</script>

</html>