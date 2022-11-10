@extends('layouts.template')

@push('css')

<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
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
            <!-- /.col -->
            <div class="col-md">
              <div class="card card-primary card-outline">

                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                    </button>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default btn-sm" onclick="formDeleteBatch()" data-toggle="tooltip" title="Delete">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </div>
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm" onclick="formReadBatch()"  data-toggle="tooltip" title="Read" onclick="window.reload()">
                      <i class="fas fa-check"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm" onclick="location.reload()" data-toggle="tooltip" title="Refresh">
                      <i class="fas fa-sync-alt"></i>
                    </button>
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover">
                      <tbody>
                        <form method="POST" action="" id="formBatch">
                          @foreach($notifikasi as $item)
                          <tr>
                            <td>
                              <div class="icheck-primary">
                                <input type="checkbox" name="id[]" value="{{$item->id}}" id="{{$item->id}}">
                                <label for="{{$item->id}}"></label>
                              </div>
                            </td>
                            <td class="mailbox-star"><a href="#">
                              @if($item->status == '0')
                              <span class="badge badge-primary">Belum dibaca</span>
                              @else
                              <span class="badge badge-success">Telah dibaca</span>
                              @endif
                            </a></td>
                            <td class="mailbox-name"><a href="read-mail.html"></a></td>
                            <td class="mailbox-subject"><b>{{$item->pesan}}</b>
                            </td>
                            <td class="mailbox-attachment"></td>
                            <td class="mailbox-date text-right">{{timeAgo($item->created_at)}}</td>
                            <td class="text-right">
                              <a href="{{route('notifikasi.show', $item->id)}}" class="btn btn-xs bg-gradient-info"><i class="fas fa-eye text-white" data-toggle="tooltip"></i></a>
                            </td>
                          </tr>
                          @endforeach
                        </form>
                      </tbody>
                    </table>
                    <!-- /.table -->
                  </div>
                  <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->
       
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
    </div>
</section>
<!-- /.content -->

@endsection

@push('js')

<script>
    $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })

  })

  function formDeleteBatch(){
    var form = $('#formBatch');
    Swal.fire({
      title : 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
      confirmButtonAriaLabel: 'Thumbs up, Yes!',
      cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
      cancelButtonAriaLabel: 'Thumbs down',
      padding: '2em'
    }).then(function (result) {
      if (result.value) {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type: 'POST',
              url: "{{ route('notifikasi.destroy.batch') }}",
              data: $(form).serialize(),
              beforeSend: function () {
                  console.log('otw')
              },
              success: function (res) {
                  if (res.status == true) {
                      Swal.fire('Deleted!', res.message, 'success')
                          .then(function () {
                              location.reload();
                          });
                  } else {
                      Swal.fire('Failed!', res.message, 'error')
                  }
              }
          })
      }
    })
  }

  function formReadBatch(){
    var form = $('#formBatch');
    Swal.fire({
      title : 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
      confirmButtonAriaLabel: 'Thumbs up, Yes!',
      cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
      cancelButtonAriaLabel: 'Thumbs down',
      padding: '2em'
    }).then(function (result) {
      if (result.value) {
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('notifikasi.read.batch') }}",
            data: $(form).serialize(),
            beforeSend: function () {
                console.log('otw')
            },
            success: function (res) {
                if (res.status == true) {
                    Swal.fire('Read!', res.message, 'success')
                        .then(function () {
                            location.reload();
                        });
                } else {
                    Swal.fire('Failed!', res.message, 'error')
                }
            }
        })
      }
    })
  }
</script>

@endpush