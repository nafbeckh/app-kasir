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
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
<style>
    .daterangepicker td.in-range {
        background-color: #7ffaf0;
    }

    .daterangepicker td.active,
    .daterangepicker td.active:hover {
        background-color: #357ebd;
    }
</style>
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
                <h3 class="card-title"><i class="fas fa-download mr-1" data-toggle="tooltip" title="{{ $title }}"></i>{{ $title }}</h3>

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
                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Periode :</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="tanggal">
                            <span class="input-group-append">
                                <button type="button" id="btnPeriode" class="btn btn-info btn-flat"><i class="fa fa-arrow-right"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center dt-no-sorting">No</th>
                                <th>Tanggal</th>
                                <th>Penjualan</th>
                                <th>Pembelian</th>
                                <th>Pengeluaran</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" rowspan="4"></th>
                                <th>Total Penjualan</th>
                                <td id="totalPenjualan">0</td>
                            </tr>
                            <tr class="text-center">
                                <th>Total Pembelian</th>
                                <td id="totalPembelian">0</td>
                            </tr>
                            <tr class="text-center">
                                <th>Total Pengeluaran</th>
                                <td id="totalPengeluaran">0</td>
                            </tr>
                            <tr class="text-center">
                                <th>Total Pendapatan</th>
                                <td id="totalPendapatan">0</td>
                            </tr>
                        </tfoot>
                    </table>
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
<!-- date-range-picker -->
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#tanggal').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                separator: " sampai "
            },
            startDate: moment().subtract(7, 'd').format("YYYY-MM-DD"),
        }).on('change', function() {
            let start = $(this).data('daterangepicker').startDate.format('YYYY-MM-DD')
            let end = $(this).data('daterangepicker').endDate.format('YYYY-MM-DD')
            $.get(`{{ route('laporan.pendapatan') }}?awal=${start}&akhir=${end}`).done(function(res) {
                if (res.status == true) {
                    table.clear().draw()
                    let totalpenj = 0
                    let totalpemb = 0
                    let totalpeng = 0
                    let totalpend = 0
                    for (i = 0; i < res.data.length; i++) {
                        table.row.add([
                            0,
                            res.data[i].tanggal,
                            res.data[i].penjualan,
                            res.data[i].pembelian,
                            res.data[i].pengeluaran,
                            res.data[i].pendapatan
                        ]).draw();
                        totalpenj += parseInt(res.data[i].penjualan)
                        totalpemb += parseInt(res.data[i].pembelian)
                        totalpeng += parseInt(res.data[i].pengeluaran)
                        totalpend += parseInt(res.data[i].pendapatan)
                    }
                    $('#totalPenjualan').text(harga(totalpenj))
                    $('#totalPembelian').text(harga(totalpemb))
                    $('#totalPengeluaran').text(harga(totalpeng))
                    $('#totalPendapatan').text(harga(totalpend))
                } else {
                    Swal.fire(
                        'Failed!',
                        res.message,
                        'error'
                    )
                }
            })
        })

        $('#btnPeriode').click(function() {
            $('#tanggal').change()
        })

        var table = $('#table').DataTable({
            info: false,
            paging: false,
            searching: false,
            lengthchange: false,
            ordering: false,
            autoWidth: true,
            columnDefs: [{
                "className": "text-center",
                "targets": [0, 1, 2, 3, 4, 5]
            }],
            columns: [{
                    render: function(data, type, row, meta) {
                        return parseInt(meta.row) + parseInt(meta.settings._iDisplayStart) + 1;
                    }
                }, {
                    render: function(data, type, row) {
                        return indo_date(data);
                    }
                },
                {
                    render: function(data, type, row) {
                        return harga(data);
                    }
                },
                {
                    render: function(data, type, row) {
                        return harga(data);
                    }
                },
                {
                    render: function(data, type, row) {
                        return harga(data);
                    }
                },
                {
                    render: function(data, type, row) {
                        return harga(data);
                    }
                }
            ]
        })

        $('#tanggal').change()

    })
</script>
@endpush