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

<body>
    <div class="wrapper" style="width: 60mm;height: 100%;font-family:Calibri;color: black;">
        <!-- Main content -->
        <section class="invoice">
            <div class="row text-center">
                <div class="col-12">
                    <span style="font-size: xx-large;"><b>{{ $toko->nama_toko }}</b></span>
                    <br>{{ $toko->alamat }}
                    <br>{{ $toko->telp }}
                    <br>Kpd : {{ $penjualan->member->nama }}
                    <br>Tgl Pemb: {{ date('d/M/Y H:i:s', strtotime($penjualan->created_at)) }}
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    ============================
                    <!-- ############################ -->
                    <!-- **************************** -->
                    <table style="width: 60mm;">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Hrg</th>
                                <th>Qty</th>
                                <th>Disk</th>
                                <th>Sub</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penjualan->penjualan_detail as $prod)
                            <tr>
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
            </div>
            <div class=" row">
                <div class="col-12">
                    ============================
                    <!-- **************************** -->
                    <!-- ############################ -->
                    <div class="table-responsive">
                        <table style="width: 100%;">
                            <tr>
                                <th>Total Harga :</th>
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
                    ============================
                    <!-- **************************** -->
                    <!-- ############################ -->
                    <div class="text-center">
                        Cetak : {{ date('d/M/Y H:i:s') }}
                        <br>Kasir : {{ $penjualan->user->nama }}
                        ==========================
                        <!-- ************************** -->
                        <!-- ########################## -->
                        <br><b>THANK YOU</b>
                        <br><img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($penjualan->kode_penj, 'C93') }}" alt="{{ $penjualan->kode_penj }}" width="90%">
                        <br><b>{{ $penjualan->kode_penj }}</b>
                        <br>
                        <br>
                        <p style="page-break-before: always">
                    </div>


                </div>
            </div>
        </section>
    </div>
    <script>
        // window.addEventListener("load", window.print());
    </script>
</body>
<script>
    window.addEventListener("load", window.print());
</script>

</html>