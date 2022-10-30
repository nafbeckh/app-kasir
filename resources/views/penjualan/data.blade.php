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
                <form method="POST" action="" id="formDeleteBatch">
                    <table id="tableData" class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center checkbox-column dt-no-sorting"><input type="checkbox" class="text-center new-control-input chk-parent select-customers-info" data-toggle="tooltip" title="Select All Data"></th>
                                <th>Tanggal</th>
                                <th>Meja</th>
                                <th>Total Item</th>
                                <th>Total Harga</th>
                                <th>Total Bayar</th>
                                <th>Kasir</th>
                                <th class="text-center dt-no-sorting">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</section>

<div class="modal animated fade fadeInDown" id="modalDetail" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-eye mr-1" data-toggle="tooltip" title="Detail Data"></i>Detail Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <table id="tbDetail" class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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
    $(document).ready(function() {

        var table = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            rowId: 'id',
            ajax: "{{ route('penjualan.index') }}",
            lengthChange: false,
            'stateSave': false,
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<i class="fas fa-arrow-alt-circle-left"></i>',
                    "sNext": '<i class="fas fa-arrow-alt-circle-right"></i>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<i class="fas fa-search"></i>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [
                [10, 50, 100, 1000],
                ['10 rows', '50 rows', '100 rows', '1000 rows']
            ],
            "pageLength": 10,
            "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",

            autoWidth: false,
            columnDefs: [{
                    "className": "text-center",
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7]
                },
                {
                    targets: 0,
                    width: "30px",
                    className: "text-center",
                    orderable: !1,
                }, {
                    targets: 7,
                    className: "text-center",
                    orderable: !1,
                }
            ],
            'select': {
                'style': 'multi'
            },
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<input type="checkbox" name="id[]" value="${data}" class="new-control-input child-chk select-customers-info">`
                    }
                },
                {
                    data: 'created_at',
                    title: "Tanggal",
                    render: function(data, type, row, meta) {
                        return indo_date(data)
                    }
                },
                {
                    data: 'meja.nama',
                    title: "Meja",
                    render: function(data, type, row, meta) {
                        return `<span class="badge badge-success">${data}</span>`
                    }
                }, {
                    data: 'total_item',
                    title: 'Total Item'
                },
                {
                    data: 'total_harga',
                    title: 'Total Harga',
                    render: function(data, type, row, meta) {
                        return harga(data)
                    }
                },{
                    data: 'bayar',
                    title: 'Bayar',
                    render: function(data, type, row, meta) {
                        return harga(data)
                    }
                }, {
                    data: 'kasir.nama',
                    title: 'Kasir',
                },
                {
                    title: 'Action',
                    "data": 'id',
                    render: function(data, type, row, meta) {
                        let text = `<div class="btn-group">
                        <button type="button" id="btnPrint" data-id="${data}" class="btn btn-xs bg-gradient-warning"><i class="fas fa-print text-white" data-toggle="tooltip" data-placement="top" title="Print"></i></button>
                        <button type="button" id="btnDetail" data-id="${data}" class="btn btn-xs bg-gradient-info"><i class="fas fa-eye text-white" data-toggle="tooltip" data-placement="top" title="Detail"></i></button>
                        `;

                        let role = "{{$user->hasRole('admin') ? 'Y' : 'N'}}";
                        role == 'Y' ? text += '<button type="button" id="btnDelete" data-id="${data}" class="btn btn-xs bg-gradient-danger"><i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Delete"></i></button></div>' : '';
                        
                        return text;
                    }
                }
            ],
            "buttons": [{
                text: '<i class="fas fa-trash"></i>Del',
                className: 'btn btn-sm btn-danger',
                attr: {
                    'id': 'delAdmin',
                    'data-toggle': 'tooltip',
                    'title': 'Delete Selected Data',
                    'hidden': 'hidden'
                },
                action: function(e, dt, node, config) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
                        confirmButtonAriaLabel: 'Thumbs up, Yes!',
                        cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
                        cancelButtonAriaLabel: 'Thumbs down',
                        padding: '2em'
                    }).then(function(result) {
                        if (result.value) {
                            $("#formDeleteBatch").submit();
                        }
                    })
                    // data = ''
                }
            }, {
                extend: "collection",
                text: '<i class="fas fa-download"></i>Export',
                attr: {
                    'data-toggle': 'tooltip',
                    'title': 'Export Data'
                },
                className: 'btn btn-sm btn-primary',
                buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                }, {
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                }, {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                }, {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                }, {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                }],
            }, {
                extend: "colvis",
                attr: {
                    'data-toggle': 'tooltip',
                    'title': 'Column Visible'
                },
                className: 'btn btn-sm btn-primary'
            }, {
                extend: "pageLength",
                attr: {
                    'data-toggle': 'tooltip',
                    'title': 'Page Length'
                },
                className: 'btn btn-sm btn-primary'
            }],
            "stripeClasses": [],
            initComplete: function() {
                $('#tableData').DataTable().buttons().container().appendTo('#tableData_wrapper .col-md-6:eq(0)');
            }
        });
        multiCheck(table);
        let role = "{{$user->hasRole('admin') ? 'Y' : 'N'}}";
        role == 'Y' ? $('#delAdmin').removeAttr('hidden') : '';

        var tbdetail = $('#tbDetail').DataTable({
            info: false,
            paging: false,
            searching: false,
            lengthchange: false,
            ordering: false,
            columnDefs: [{
                "className": "text-center",
                "targets": [0, 2, 3, 4]
            }],
            columns: [{
                render: function(data, type, row) {
                    return `<span class="badge badge-success">${data}</span>`;
                },
            }, {}, {
                render: function(data, type, row) {
                    return harga(data);
                },
            }, {}, {
                render: function(data, type, row) {
                    return harga(data);
                },
            }, ]
        });

        var id;

        $('body').on('click', '#btnDelete', function() {
            id = $(this).data("id");
            let url = "{{ route('penjualan.destroy', ':id') }}";
            url = url.replace(':id', id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
                confirmButtonAriaLabel: 'Thumbs up, Yes!',
                cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
                cancelButtonAriaLabel: 'Thumbs down',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function(res) {
                            table.ajax.reload();
                            if (res.status == true) {
                                Swal.fire(
                                    'Success!',
                                    res.message,
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    res.message,
                                    'error'
                                )
                            }
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            Swal.fire(
                                'Failed!',
                                'Server Error',
                                'error'
                            )
                        }
                    });
                }
            })
        });

        $('body').on('click', '#btnDetail', function() {
            tbdetail.clear().draw()
            id = $(this).data('id');
            let url = "{{ route('penjualan.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(res) {
                    for (i = 0; i < res.data.penjualan_detail.length; i++) {
                        tbdetail.row.add([
                            res.data.penjualan_detail[i].produk.kode_prod,
                            res.data.penjualan_detail[i].produk.nama_prod,
                            res.data.penjualan_detail[i].produk.harga_jual,
                            res.data.penjualan_detail[i].jumlah,
                            res.data.penjualan_detail[i].subtotal,
                        ]).draw()
                    }

                },
                error: function(xhr, status, error) {
                    er = xhr.responseJSON.errors
                    Swal.fire(
                        'Failed!',
                        'Server Error',
                        'error'
                    )
                }
            });
            $('#modalDetail').modal('show');

        })

        $('body').on('click', '#btnPrint', function() {
            id = $(this).data("id");
            let url = "{{ route('penjualan.print', ':id') }}";
            url = url.replace(':id', id);
            var doc = window.open(url + "?area=Small")

            // Swal.fire({
            //     title: 'Pilih Ukuran Invoice?',
            //     showDenyButton: true,
            //     showCancelButton: true,
            //     confirmButtonText: '<i class="fas fa-print mr-1">Full</i>',
            //     denyButtonText: `<i class="fas fa-print mr-1">Small</i>`,
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         let url = "{{ route('penjualan.print', ':id') }}";
            //         url = url.replace(':id', id);
            //         var doc = window.open(url + "?area=full")
            //     } else if (result.isDenied) {
            //         let url = "{{ route('penjualan.print', ':id') }}";
            //         url = url.replace(':id', id);
            //         var doc = window.open(url + "?area=small")
            //     }
            // })

        });

        $('#formDeleteBatch').submit(function(event) {
            var form = this;

            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ route('penjualan.destroy.batch') }}",
                data: $(form).serialize(),
                beforeSend: function() {
                    console.log('otw')
                },
                success: function(res) {
                    table.ajax.reload();
                    if (res.status == true) {
                        Swal.fire(
                            'Deleted!',
                            res.message,
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Failed!',
                            res.message,
                            'error'
                        )
                    }
                },
                error: function(xhr, status, error) {

                    table.rows('.selected').nodes().to$().removeClass('selected');
                    er = xhr.responseJSON.errors
                    console.log(er);
                    Swal.fire(
                        'Failed!',
                        'Server Error',
                        'error'
                    )
                }
            })

        });

    });
</script>

@endpush