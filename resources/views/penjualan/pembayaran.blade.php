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
<style>
    .tampil-bayar {
        font-size: 5em;
        text-align: center;
        height: 100px;
    }

    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }

    /* .table-pembelian tbody tr:last-child {
        display: none;
    } */

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
</style>
@endpush

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

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-upload mr-1" data-toggle="tooltip" title="{{ $title }}"></i>{{ $title }}</h3>

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
                <div class="table-responsive">
                    <table id="tabletrx" class="table table-stiped table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </thead>
                    </table>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-7">
                        <div id="tampilBayar" class="tampil-bayar bg-primary">Rp. 0</div>
                        <div id="terbilang" class="tampil-terbilang"></div>
                    </div>
                    <div class="col-sm-5">
                        <form action="" class="form-pembelian" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="total" class="col-sm-4 control-label">Total</label>
                                <div class="col-sm-8">
                                    <input type="text" id="total" class="form-control" readonly value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bayar" class="col-sm-4 control-label">Bayar</label>
                                <div class="col-sm-8">
                                    <input type="text" id="bayar" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kembali" class="col-sm-4 control-label">Kembali</label>
                                <div class="col-sm-8">
                                    <input type="text" id="kembali" class="form-control" value="0" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <!-- <label for="kembali" class="col-sm-4 control-label"></label> -->
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8">
                                    <button type="button" id="simpantrx" class="btn btn-primary btn-lg btn-flat pull-right btn-block mb-1"><i class="fas fa-save mr-1"></i>Simpan Transaksi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
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
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/function.js') }}"></script>


<script>
    function hrg(x) {
        let a = parseInt(x)
        return a.toLocaleString('en-US')
    }

    $(document).ready(function() {
        var tabletrx = $('#tabletrx').DataTable({
            info: false,
            paging: false,
            ajax: "{{ route('penjualan.pembayaran', $penjualan->id) }}",
            searching: false,
            lengthchange: false,
            ordering: false,
            autoWidth: true,
            columnDefs: [{
                "className": "text-center",
                "targets": [0, 2, 3, 4]
            }],
            columns: [{
                    render: function(data, type, row, meta) {
                        return parseInt(meta.row) + parseInt(meta.settings._iDisplayStart) + 1;
                    }
                },
                {
                    data: 'nama_prod',
                    title: "Nama",
                    render: function(data, type, row, meta) {
                        return data
                    }
                },
                {
                    data: 'harga_jual',
                    title: "Harga",
                    render: function(data, type, row, meta) {
                        return hrg(data);
                    }
                },
                {
                    data: 'jumlah',
                    title: "Jumlah",
                    render: function(data, type, row, meta) {
                        return '<span id="jumlahtrx" data-val="' + data + '"></span>' + data;
                    }
                },
                {
                    data: 'subtotal',
                    title: "Subtotal",
                    render: function(data, type, row, meta) {
                        return hrg(data);
                    }
                },
            ]
        })

        let total = {{$penjualan->total_harga}}
        $('#total').val(total)
        $('#tampilBayar').text('Rp. ' + hrg(total))
        $('#terbilang').text(terbilang(total))

        $('#bayar').keyup(function() {
            let kembali = this.value - total
            $('#kembali').val(kembali)
        })

        $('#simpantrx').click(function(event) {
            let totalrp = $('#total').val()
            let bayar = $('#bayar').val()
            if (bayar - totalrp < 0) {
                Swal.fire(
                    'Failed!',
                    'Bayarnya Kurang Bosku!',
                    'error'
                    )
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Simpan Transaksi?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
                    confirmButtonAriaLabel: 'Thumbs up, Yes!',
                    cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
                    cancelButtonAriaLabel: 'Thumbs down',
                    padding: '2em'
                })
                .then(function (result) {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            }
                        });
                        $.ajax({
                            type : "PUT",
                            url: "{{ route('penjualan.update', $penjualan->id) }}",
                            data: {
                                bayar: $('#total').val(),
                                diterima: $('#bayar').val(),
                            },
                            beforeSend: function () {
                                $('#simpantrx').prop('disabled', true);
                            },
                            success: function (res) {
                                if (res.status == true) {
                                    Swal.fire('Success!', res.message, 'success');
                                    window.location.href = "{{route('penjualan.index')}}";
                                } else {
                                    Swal.fire('Failed!', res.message, 'error')
                                }
                            },
                            error: function (data) {
                                $('#simpantrx').prop('disabled', false);
                                console.log('Error:', data);
                                Swal.fire('Failed!', 'Server Error', 'error')
                            }
                        });
                    }
                })
            }
        })
    })
</script>

@endpush