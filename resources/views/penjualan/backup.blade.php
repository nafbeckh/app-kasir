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
                <form method="POST" action="" class="mb-2">
                    @csrf
                    <div class="input-group row mb-2">
                        <label for="meja" class="col-sm-2 col-form-label">meja</label>
                        <select id="meja" class="form-control col-sm-9 select2 select2bs4">
                            <option value="">Pilih Meja</option>
                        </select>
                        <div class="input-group-append">
                            <button type="button" id="btnMeja" class="btn btn-primary btn-flat" data-toggle="tooltip" title="Tambah Meja">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="input-group row">
                        <label for="inputProduk" class="col-sm-2 col-form-label">Kode Produk</label>
                        <select name="" id="inputProduk" class="form-control col-sm-9 select2 select2bs4">
                            <option value="">Pilih Produk</option>
                        </select>
                        <div class="input-group-append">
                            <button type="button" id="btnProduk" class="btn btn-primary btn-flat" data-toggle="tooltip" title="Pilih Produk">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="tabletrx" class="table table-stiped table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Diskon</th>
                            <th>Subtotal</th>
                            <th><i class="fa fa-cog"></i></th>
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
                                <label for="diskon" class="col-sm-4 control-label">Diskon</label>
                                <div class="col-sm-8">
                                    <input type="number" name="diskon" id="diskon" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bayar" class="col-sm-4 control-label">Bayar</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="bayar" class="form-control" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text" data-toggle="tooltip" title="Lunas">
                                                <input type="checkbox" id="lunas">
                                            </span>
                                        </div>
                                    </div>
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
                                <div class="col-sm-4">
                                    <button type="button" id="printLast" class="btn btn-primary btn-lg bg-gradient-info pull-right mb-1"><i class="fas fa-print mr-1"></i>Print</button>
                                </div>
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

<div class="modal animated fade fadeInDown" id="modalProduk" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-cubes mr-1" data-toggle="tooltip" title="Data Produk"></i>Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="table-responsive">
                        <table id="produk" class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Harga Jual</th>
                                    <th>Diskon</th>
                                    <th>Stok</th>
                                    <th class="text-center dt-no-sorting">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal animated fade fadeInDown" id="modalMeja" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-user mr-1" data-toggle="tooltip" title="Tambah Meja"></i>Tambah Meja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <form id="formMeja" action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label"><i class="fas fa-address-card mr-1" data-toggle="tooltip" title="Nama"></i>Nama :</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" minlength="2" maxlength="50" required>
                                <span id="err_nama" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telp" class="col-sm-3 col-form-label"><i class="fas fa-phone mr-1" data-toggle="tooltip" title="No Telp"></i>Telp :</label>
                            <div class="col-sm-9">
                                <input type="number" name="telp" class="form-control" id="telp" placeholder="Masukkan No Telp" required maxlength="18">
                                <span id="err_telp" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label"><i class="fas fa-map-marker mr-1" data-toggle="tooltip" title="Alamat"></i>Alamat</label>
                            <div class="col-sm-9">
                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat" required maxlength="50"></textarea>
                                <span id="err_alamat" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-lg btn-primary" id="trig">TRIGGER</button> -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1" data-toggle="tooltip" title="Close"></i>Close</button>
                    <button type="reset" id="reset" class="btn btn-warning"><i class="fas fa-undo mr-1" data-toggle="tooltip" title="Reset"></i>Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1" data-toggle="tooltip" title="Save"></i>Save</button>
                </div>
            </form>
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
    function hrg(x) {
        let a = parseInt(x)
        return a.toLocaleString('en-US')
    }

    $(document).ready(function() {
        $("#printLast").click(function() {
            Swal.fire({
                title: 'Pilih Ukuran Invoice?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-print mr-1">Full</i>',
                denyButtonText: `<i class="fas fa-print mr-1">Small</i>`,
            }).then((result) => {
                if (result.isConfirmed) {
                    var doc = window.open("{{ route('penjualan.print.last') }}?area=full")
                } else if (result.isDenied) {
                    var doc = window.open("{{ route('penjualan.print.last') }}?area=small")
                }
            })

        })

        $('.select2').select2()

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $("#meja").select2({
            theme: 'bootstrap4',
            ajax: {
                delay: 1000,
                url: "{{ route('meja.index') }}",
                processResults: function(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return {
                                text: item.nama,
                                id: item.id,
                                nama: item.nama,
                                alamat: item.alamat,
                                telp: item.telp,
                                kode: item.kode_meja
                            }
                        })
                    };
                },
            }
        })

        $('#btnMeja').click(function() {
            $('#modalMeja').modal('show')
        })

        $('#formMeja').submit(function(event) {
            event.preventDefault();
        }).validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            submitHandler: function(form) {
                var formData = new FormData($(form)[0]);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('meja.store') }}",
                    mimeType: 'application/json',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('button[type="submit"]').prop('disabled', true);
                        console.log('loading bro');
                        $('#formMeja .error.invalid-feedback').each(function(i) {
                            $(this).hide();
                        });
                        $('#formMeja input.is-invalid').each(function(i) {
                            $(this).removeClass('is-invalid');
                        });
                    },
                    success: function(res) {
                        table.ajax.reload();
                        $('button[type="submit"]').prop('disabled', false);
                        $('#reset').click();
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
                    error: function(xhr, status, error) {
                        $('button[type="submit"]').prop('disabled', false);
                        er = xhr.responseJSON.errors
                        erlen = Object.keys(er).length
                        for (i = 0; i < erlen; i++) {
                            obname = Object.keys(er)[i];
                            $('#' + obname).addClass('is-invalid');
                            $('#err_' + obname).text(er[obname][0]);
                            $('#err_' + obname).show();
                        }
                    }
                });
            }
        });

        $("#inputProduk").select2({
            theme: 'bootstrap4',
            ajax: {
                delay: 1000,
                url: "{{ route('produk.index') }}",
                processResults: function(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return {
                                text: item.kode_prod + ' - ' + item.nama_prod,
                                id: item.id,
                                nama: item.nama_prod,
                                harga: item.harga_jual,
                                kode: item.kode_prod,
                                diskon: item.diskon,
                                stok: item.stok
                            }
                        })
                    };
                },
            }
        }).on('change', function() {
            data = $(this).select2('data')
            tbldttrx = tabletrx.rows().data().toArray()
            if (tbldttrx.length > 0) {
                let ada = false
                for (let i = 0; i < tbldttrx.length; i++) {
                    if (tbldttrx[i][0] == data[0].id) {
                        ada = true
                        break
                    } else {
                        ada = false
                    }
                }
                if (ada == true) {
                    Swal.fire(
                        data[0].nama_prod,
                        'Barang Sudah Dipilih',
                        'error'
                    )
                } else {
                    if (data[0].stok <= 0) {
                        Swal.fire(
                            data[0].nama_prod,
                            'Stok Kosong',
                            'error'
                        )
                    } else {
                        tabletrx.row.add([data[0].id, data[0].kode, data[0].nama, data[0].harga, 0, data[0].diskon, 0, data[0].stok]).draw();
                    }
                }
            } else {
                if (data[0].stok <= 0) {
                    Swal.fire(
                        data[0].nama_prod,
                        'Stok Kosong',
                        'error'
                    )
                } else {
                    tabletrx.row.add([data[0].id, data[0].kode, data[0].nama, data[0].harga, 0, data[0].diskon, 0, data[0].stok]).draw();
                }
            }

        });

        $('#bayar').on('change', function() {
            total(tabletrx)
        })

        $('#lunas').on('change', function() {
            total(tabletrx)
        })

        $('#diskon').on('change', function() {
            total(tabletrx)
        })

        $('#btnProduk').click(function() {
            $('#modalProduk').modal('show')
        })

        $('#produk tbody').on('click', "#btnPilih", function() {
            let row = $(this).parents('tr')[0];
            tbldt = table.row(row).data()
            tbldttrx = tabletrx.rows().data().toArray()
            if (tbldttrx.length > 0) {
                let ada = false
                for (let i = 0; i < tbldttrx.length; i++) {
                    if (tbldttrx[i][0] == tbldt.id) {
                        ada = true
                        break
                    } else {
                        ada = false
                    }
                }
                if (ada == true) {
                    Swal.fire(
                        tbldt.nama_prod,
                        'Barang Sudah Dipilih',
                        'error'
                    )
                } else {
                    if (tbldt.stok <= 0) {
                        Swal.fire(
                            tbldt.nama_prod,
                            'Stok Kosong',
                            'error'
                        )
                    } else {
                        tabletrx.row.add([tbldt.id, tbldt.kode_prod, tbldt.nama_prod, tbldt.harga_jual, 0, tbldt.diskon, 0, tbldt.stok]).draw();
                        Swal.fire(
                            tbldt.nama_prod,
                            'Berhasil Tambah ke Transaksi',
                            'success'
                        )
                    }
                }
            } else {
                if (tbldt.stok <= 0) {
                    Swal.fire(
                        tbldt.nama_prod,
                        'Stok Kosong',
                        'error'
                    )
                } else {
                    tabletrx.row.add([tbldt.id, tbldt.kode_prod, tbldt.nama_prod, tbldt.harga_jual, 0, tbldt.diskon, 0, tbldt.stok]).draw();
                    Swal.fire(
                        tbldt.nama_prod,
                        'Berhasil Tambah ke Transaksi',
                        'success'
                    )
                }
            }

            total(tabletrx)
        });

        $('#tabletrx').on('click', '#deletetrx', function() {
            let row = $(this).parents('tr');
            if ($(row).hasClass('child')) {
                tabletrx.row($(row).prev('tr')).remove().draw();
            } else {
                tabletrx
                    .row($(this).parents('tr'))
                    .remove()
                    .draw();
            }
            total(tabletrx)
        });

        $('#tabletrx').on('change', '#jumlahtrx', function() {
            let row = $(this).parents('tr')[0];
            tbldt = tabletrx.row(row).data()
            stok = parseInt(tbldt[7])
            harga = parseInt(tbldt[3])
            disk = parseInt(tbldt[5])
            jumlah = $(this).val() == '' ? 0 : $(this).val()
            if (jumlah > stok) {
                Swal.fire(
                    tbldt[2],
                    'Stok Sisa : ' + tbldt[7],
                    'error'
                )
                tbldt[4] = parseInt(stok)
                jumlah = stok
            } else {
                tbldt[4] = parseInt(jumlah)
            }
            tbldt[6] = (harga * jumlah) - (harga * jumlah * disk / 100)
            tabletrx.row(row).data(tbldt).draw();
            total(tabletrx)

        });

        var tabletrx = $('#tabletrx').DataTable({
            info: false,
            paging: false,
            searching: false,
            lengthchange: false,
            ordering: false,
            autoWidth: true,
            columnDefs: [{
                "className": "text-center",
                "targets": [0, 1, 3, 4, 5, 6, 7]
            }],
            columns: [{
                    render: function(data, type, row, meta) {
                        return parseInt(meta.row) + parseInt(meta.settings._iDisplayStart) + 1;
                    }
                }, {
                    render: function(data, type, row) {
                        return `<span class="badge badge-success">${data}</span>`;
                    }
                },
                {},
                {
                    render: function(data, type, row) {
                        return hrg(data);
                    }
                },
                {
                    render: function(data, type, row) {
                        return `<input type="number" id="jumlahtrx" class="form-control" value="${data}" min="0">`;
                    }
                }, {
                    render: function(data, type, row) {
                        return `${data}%`;
                    }

                }, {
                    render: function(data, type, row) {
                        return hrg(data);
                    }

                }, {
                    render: function(data, type, row) {
                        return `<button id="deletetrx" type="button" class="btn btn-xs btn-danger btn-flat"><i class="fas fa-trash-alt"></i></button>`;
                    }
                }
            ]
        })

        var table = $('#produk').DataTable({
            processing: true,
            serverSide: true,
            rowId: 'id',
            ajax: "{{ route('produk.index') }}",
            "paging": true,
            lengthChange: true,
            buttons: [],
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
                [10, 50, 100, -1],
                ['10 rows', '50 rows', '100 rows', 'Show all']
            ],
            "pageLength": 10,
            autoWidth: false,
            columnDefs: [{
                "className": "text-center",
                "targets": [0, 2, 3, 4, 5]
            }, {
                targets: 5,
                className: "text-center",
                orderable: !1,
            }],
            columns: [{
                    data: 'kode_prod',
                    title: "Kode",
                    render: function(data, type, row, meta) {
                        return `<span class="badge badge-success">${data}</span>`
                    }
                },
                {
                    data: 'nama_prod',
                    title: "Nama",
                }, {
                    data: 'harga_jual',
                    title: 'Harga Jual',
                    render: function(data, type, row, meta) {
                        return hrg(data)
                    }
                }, {
                    data: 'diskon',
                    title: 'Diskon'
                }, {
                    data: 'stok',
                    title: 'Stok'
                },
                {
                    title: 'Action',
                    "data": 'id',
                    render: function(data, type, row, meta) {
                        let text = `<button type="button" id="btnPilih" data-id="${data}" class="btn btn-xs btn-info btn-flat"><i class="fas fa-check-circle text-white  mr-1" data-toggle="tooltip" data-placement="top" title="Pilih"></i>Pilih</button>`;
                        return text;
                    }
                }
            ],
        });

        $('#simpantrx').click(function(event) {
            event.preventDefault();
            let memb = $('#meja').val()
            if (memb == '') {
                Swal.fire(
                    'Failed!',
                    'Pilih Meja!',
                    'error'
                )
            } else {
                let data = tabletrx.rows().data().toArray();
                let total = 0
                for (var i = 0; i < data.length; i++) {
                    total += parseInt(data[i][4]);
                }
                if (data.length <= 0) {
                    Swal.fire(
                        'Failed!',
                        'Belum Ada Produk yang dipilih',
                        'error'
                    )
                } else {
                    let totalrp = $('#total').val()
                    let bayar = $('#bayar').val()
                    let diskon = $('#diskon').val()
                    let hargadiskon = totalrp * diskon / 100
                    let totalbaru = totalrp - hargadiskon
                    if (bayar - totalbaru < 0) {
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
                        }).then(function(result) {
                            if (result.value) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    }
                                });
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('penjualan.store') }}",
                                    data: {
                                        meja_id: $('#meja').select2('data')[0].id,
                                        total_item: total,
                                        total_harga: $('#total').val(),
                                        diskon: $('#diskon').val(),
                                        bayar: $('#total').val() - ($('#total').val() * $('#diskon').val() / 100),
                                        diterima: $('#bayar').val() - $('#kembali').val(),
                                        produk: data
                                    },
                                    beforeSend: function() {
                                        $('#simpantrx').prop('disabled', true);
                                    },
                                    success: function(res) {
                                        $('#simpantrx').prop('disabled', false);
                                        tabletrx.clear().draw()
                                        $('#meja').val('').change()
                                        $('#diskon').val(0)
                                        $('#lunas').prop('checked', false).change()
                                        $('#bayar').val(0).change()
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
                                        $('#simpantrx').prop('disabled', false);
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
                    }

                }
            }

        })

    });

    function total(t) {
        let diskon = $('#diskon').val() == '' ? 0 : $('#diskon').val()
        let bayar = $('#bayar').val() == '' ? 0 : $('#bayar').val()
        let total = 0
        let data = t.rows().data().toArray();
        for (var i = 0; i < data.length; i++) {
            total += data[i][6];
        }

        let hargadiskon = total * diskon / 100
        let totalbaru = total - hargadiskon
        let kembali = parseInt(bayar) - parseInt(totalbaru)

        if ($('#lunas').prop('checked') == true) {
            $('#bayar').prop('disabled', true)
            $('#bayar').val(totalbaru)
            $('#kembali').val(0)
        } else {
            $('#bayar').prop('disabled', false)
            $('#bayar').val(bayar)
            $('#kembali').val(kembali).change()
        }

        $('#total').val(total)
        $('#tampilBayar').text('Rp. ' + hrg(totalbaru))
        $('#terbilang').text(terbilang(totalbaru))

    }
</script>

@endpush