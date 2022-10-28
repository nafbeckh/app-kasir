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
                    <label for="pilihKat" class="col-sm-2 col-form-label">Pilih Kategori :</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="pilihKat">
                            <option value="Semua">Semua</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Snack">Snack</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pilihPeriode" class="col-sm-2 col-form-label">Pilih Periode :</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="pilihPeriode">
                            <option value="Hari ini">Hari ini</option>
                            <option value="Minggu ini">Minggu ini</option>
                            <option value="Bulan ini">Bulan ini</option>
                            <option value="Kostum">Kostum Periode</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="kostumTanggal" hidden>
                    <label for="tanggal" class="col-sm-2 col-form-label">Kostum Periode :</label>
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
                                {{-- <th>Tanggal</th> --}}
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
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
            // startDate: moment().subtract(0, 'd').format("YYYY-MM-DD"),
        }).on('change', function() {
            let start = $(this).data('daterangepicker').startDate.format('YYYY-MM-DD')
            let end = $(this).data('daterangepicker').endDate.format('YYYY-MM-DD')
            $.get(`{{ route('laporan.terlaris') }}?awal=${start}&akhir=${end}`).done(function(res) {
                if (res.status == true) {
                    table.clear().draw()
                    for (i = 0; i < res.data.length; i++) {
                        table.row.add([
                            0,
                            res.data[i].tanggal,
                            res.data[i].penjualan,
                            res.data[i].pengeluaran,
                            res.data[i].pendapatan
                        ]).draw();
                    }
                } else {
                    Swal.fire(
                        'Failed!',
                        res.message,
                        'error'
                    )
                }
            })
        })

        var table = $('#table').DataTable({
            info: false,
            paging: false,
            searching: false,
            ajax: "{{ route('laporan.terlaris') }}",
            lengthchange: false,
            ordering: false,
            autoWidth: true,
            columnDefs: [{
                "className": "text-center",
                "targets": [0, 1, 2, 3]
            }],
            columns: [{
                    render: function(data, type, row, meta) {
                        return parseInt(meta.row) + parseInt(meta.settings._iDisplayStart) + 1;
                    }
                },
                // {
                //     data: 'created_at',
                //     title: "Tanggal",
                //     render: function(data, type, row, meta) {
                //         return indo_date(data)
                //     }
                // },
                {
                    data: 'nama_kat',
                    title: "Kategori",
                    render: function(data, type, row, meta) {
                        return data
                    }
                }, {
                    data: 'nama_prod',
                    title: "Nama",
                    render: function(data, type, row, meta) {
                        return data
                    }
                }, {
                    data: 'jumlah',
                    title: "Jumlah",
                    render: function(data, type, row, meta) {
                        return data
                    }
                },
            ]
        })
    })

    $('#pilihPeriode').change(function (){
        if (this.value == 'Kostum') {
            $('#kostumTanggal').removeAttr('hidden');
        } else {
            $('#kostumTanggal').attr('hidden', 'hidden');
        }
    })
</script>
@endpush