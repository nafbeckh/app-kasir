@extends('layouts.template')

@push('css')
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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="callout callout-success">
                  <h5>Selamat Datang Kasir {{ $user->nama }}!</h5>

                  <p><button type="button" id="newTrx" class="btn btn-lg bg-gradient-info"><i class="fas fa-upload mr-1"></i>Transaksi Baru</button></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-chart-area mr-1"></i>Grafik Laporan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="tanggal" class="col-xs-3 col-lg-3 col-form-label">Periode : </label>
                            <div class="col-xs-8 col-lg-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="tanggal">
                                </div>
                            </div>
                        </div>
                        <div class="chart">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->


@endsection

@push('js')
<!-- ChartJS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/function.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(function() {

        $('#newTrx').click(function(){
            window.location.href = "{{ route('penjualan.create') }}"
        })


        var label = []
        var datapenj = []
        var dataitem = []

        $('#tanggal').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                separator: " to "
            },
            viewMode: "months",
            minViewMode: "months",
            startDate: moment().subtract(7, 'd').format("YYYY-MM-DD"),
        }).on('change', function() {
            label = []
            datapenj = []
            dataitem = []

            let start = $(this).data('daterangepicker').startDate.format('YYYY-MM-DD')
            let end = $(this).data('daterangepicker').endDate.format('YYYY-MM-DD')
            $.get(`{{ route('laporan.penjualan.kasir') }}?awal=${start}&akhir=${end}`).done(function(res) {
                if (res.status == true) {
                    for (let i = 0; i < res.data.length; i++) {
                        label.push(moment(res.data[i].tanggal).format('DD'))
                        datapenj.push(res.data[i].penjualan)
                        dataitem.push(res.data[i].item)
                    }

                    barChartData.labels = label
                    barChartData.datasets[0].data = datapenj
                    barChartData.datasets[1].data = dataitem
                    chart.update()
                } else {
                    Swal.fire(
                        'Failed!',
                        res.message,
                        'error'
                    )
                }
            })
        })

        $('#tanggal').change()

        var areaChartData = {
            labels: label,
            datasets: [{
                    label: 'Total Penjualan',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: datapenj
                },
                {
                    label: 'Total Item',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: dataitem
                }
            ]
        }

        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }

        var chart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })

    })
</script>
@endpush