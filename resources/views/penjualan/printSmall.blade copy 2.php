<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'PT Sans', sans-serif;
        }

        @page {
            size: 50mm;
            margin-top: 0cm;
            margin-left: 0cm;
            margin-right: 0cm;
            position: relative;
        }

        table {
            width: 100%;
        }

        tr {
            width: 100%;

        }

        h1 {
            text-align: center;
            vertical-align: middle;
        }

        #logo {
            width: 60%;
            text-align: center;
            -webkit-align-content: center;
            align-content: center;
            padding: 5px;
            margin: 2px;
            display: block;
            margin: 0 auto;
        }

        header {
            width: 100%;
            text-align: center;
            -webkit-align-content: center;
            align-content: center;
            vertical-align: middle;
        }

        .items thead {
            text-align: center;
        }

        .center-align {
            text-align: center;
        }

        .bill-details td {
            font-size: 12px;
        }

        .receipt {
            font-size: medium;
        }

        .items .heading {
            font-size: small;
            text-transform: uppercase;
            border-top: 1px solid black;
            margin-bottom: 4px;
            margin-left: 0px;
            border-bottom: 1px solid black;
            vertical-align: middle;
        }

        .items thead tr th:first-child,
        .items tbody tr td:first-child {
            width: 40%;
            min-width: 40%;
            max-width: 40%;
            word-break: break-all;
            text-align: left;
        }

        .items td {
            font-size: small;
            text-align: right;
            vertical-align: top;
        }

        .price::before {
            /* content: "\20B9"; */
            font-family: Arial;
            text-align: left;
        }

        .sum-up {
            text-align: right !important;
        }

        .total {
            font-size: 13px;
            border-top: 1px dashed black !important;
            border-bottom: 1px dashed black !important;
        }

        .total.text,
        .total.price {
            text-align: right;
        }

        /* .total.price::before {
            content: "\20B9";
        } */

        .line {
            border-top: 1px solid black !important;
        }

        .heading.rate {
            width: 20%;
        }

        .heading.amount {
            width: 25%;
        }

        .heading.qty {
            width: 5%
        }

        p {
            padding: 1px;
            margin: 0;
        }

        section,
        footer {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <header>
        <p>
            <span style="font-size: x-large;"><b>{{ $toko->nama_toko }}</b></span>
            <br>{{ $toko->alamat }}
            <br>{{ $toko->telp }}
        </p>
    </header>
    <table class="bill-details line">
        <tbody>
            <tr>
                <td>Kpd : <span>{{ $penjualan->member->nama }}</span></td>
                <!-- <td>Time : <span>2</span></td> -->
            </tr>
            <tr>
                <td>Kasir : <span>{{ $penjualan->user->nama }}</span></td>
                <!-- <td>Time : <span>2</span></td> -->
            </tr>
            <tr style="text-align: center;">
                <td><span>{{ date('d-M-Y H:i:s') }}</span></td>
                <!-- <td>Bill # : <span>4</span></td> -->
            </tr>
            <!-- <tr>
                <th class="center-align" colspan="2"><span class="receipt">Original Receipt</span></th>
            </tr> -->
        </tbody>
    </table>

    <table class="items line">
        <thead>
        </thead>

        <tbody>
            @php
            $totaldisk = 0;
            @endphp

            @foreach($penjualan->penjualan_detail as $prod)
            <tr>
                <td>{{ $prod->produk->nama_prod }}</td>
                <td class="price">{{ format_uang($prod->harga_jual) }}</td>
                <td>{{ $prod->jumlah }}</td>
                <td class="price">{{ format_uang($prod->subtotal) }}</td>
            </tr>
            @php
            $totaldisk += ($prod->harga_jual*$prod->jumlah*$prod->diskon/100);
            @endphp

            @if($prod->diskon > 0)
            <tr>
                <td colspan="3" class="sum-up">Diskon : </td>
                <td class="price">(-{{ format_uang($prod->harga_jual*$prod->jumlah*$prod->diskon/100)  }})</td>
            </tr>
            @endif
            @endforeach
            <tr>
                <td colspan="2" class="sum-up line">Subtotal :</td>
                <td colspan="2" class="line price">{{ format_uang($penjualan->total_harga) }}</td>
            </tr>
            @if($penjualan->diskon > 0)
            <tr>
                <td colspan="2" class="sum-up">Diskon Toko :</td>
                <td colspan="2" class="price">{{ format_uang($penjualan->total_harga*$penjualan->diskon/100) }}</td>
            </tr>
            @endif
            <tr>
                <th colspan="2" class="total text">Grand Total :</th>
                <th colspan="2" class="total price">{{ format_uang($penjualan->bayar) }}</th>
            </tr>
            <tr>
                <td colspan="2" class="sum-up">Anda Hemat :</td>
                <td colspan="2" class="price">{{ format_uang($totaldisk + ($penjualan->total_harga*$penjualan->diskon/100)) }}</td>
            </tr>
        </tbody>
    </table>
    <section>
        <p class="line" style="text-align:center">
            <b>=====THANK YOU=====</b>
        </p>
        <p style="text-align:center">
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($penjualan->kode_penj, 'C93') }}" alt="{{ $penjualan->kode_penj }}" width="90%">
        </p>
        <p style="text-align:center">
            <b>{{ $penjualan->kode_penj }}</b>
        </p>
    </section>
    <br>
    <p style="page-break-before: always">
        <!-- <footer style="text-align:center">
        <p>THANK YOU</p>
    </footer> -->
        <br>
</body>

</html>