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
                            @php
                            $totaldisk = 0;
                            @endphp
                            @foreach($penjualan->penjualan_detail as $prod)
                            @php
                            $totaldisk += ($prod->harga_jual*$prod->jumlah*$prod->diskon/100);
                            @endphp
                            <tr>
                                <td style="text-align: left;">{{ $prod->produk->nama_prod }}</td>
                                <td style="text-align: right;">{{ format_uang($prod->harga_jual) }}</td>
                                <td style="text-align: right;">{{ $prod->jumlah }}</td>
                                <td style="text-align: right;">{{ format_uang($prod->subtotal) }}</td>
                            </tr>
                            @if($prod->diskon > 0)
                            <tr>
                                <td colspan="3" style="text-align: right;">Diskon : </td>
                                <td style="text-align: right;">(-{{ format_uang($prod->harga_jual*$prod->jumlah*$prod->diskon/100)  }})</td>
                            </tr>
                            @endif
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
                            <td style="text-align: right;">Total Harga :</td>
                            <td style="text-align: right;">{{ format_uang($penjualan->total_harga) }}</td>
                        </tr>
                        @if($penjualan->diskon > 0)
                        <tr>
                            <td style="text-align: right;">Diskon Toko :</td>
                            <td style="text-align: right;">{{ format_uang($penjualan->total_harga*$penjualan->diskon/100) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th style="text-align: right;">Grand Total :</th>
                            <th style="text-align: right;">{{ format_uang($penjualan->bayar) }}</th>
                        </tr>
                        @if($totaldisk > 0)
                        <tr>
                            <td style="text-align: right;">Anda Hemat :</td>
                            <td style="text-align: right;">{{ format_uang($totaldisk+($penjualan->total_harga*$penjualan->diskon/100)) }}</td>
                        </tr>
                        @endif
                    </table>
                    ===========================
                    <!-- **************************** -->
                    <!-- ############################ -->
                    <div class="text-center">
                        Cetak : {{ date('d-M-Y H:i:s') }}
                        <br>Kasir : {{ $penjualan->user->nama }}
                        =========================
                        <!-- ************************** -->
                        <!-- ########################## -->

                    </div>
                    <div class="text-center">
                        <b>THANK YOU</b>
                    </div>
                    <div class="text-center">
                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($penjualan->kode_penj, 'C93') }}" alt="{{ $penjualan->kode_penj }}" width="90%">
                    </div>
                    <div class="text-center mb-3">
                        <b>{{ $penjualan->kode_penj }}</b>
                        <br>
                        <br>--

                    </div>
                    <div class="mb-3"></div>
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