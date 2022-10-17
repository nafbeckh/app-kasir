<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>

    <style>
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr>
            @foreach ($data as $produk)
            <td class="text-center" style="border: 1px solid #333;">
                <p>{{ $produk->nama_prod }} - Rp. {{ format_uang($produk->harga_jual) }}</p>
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk->kode_prod, 'C39') }}" alt="{{ $produk->kode_prod }}" width="180" height="60">
                <br>
                {{ $produk->kode_prod }}
            </td>
            @if ($no++ % 3 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
</body>
<script>
    // $(document).ready(function() {
        // window.print();

    // })
</script>

</html>