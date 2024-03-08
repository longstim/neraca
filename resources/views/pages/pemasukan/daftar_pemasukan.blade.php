@extends('layouts.dashboard')
@section('page_heading', 'Daftar Pemasukan')
@section('breadcrumb')
<a href="{{url('pemasukan/index')}}" class="btn bg-primary float-right"><i class="fas fa-plus-circle"></i> &nbsp;Tambah Data</a>
@endsection
@section('content')
<style>
  #dropdown-action-id
  {
    min-width: 5rem;
  }

  #dropdown-action-id .dropdown-item:hover
  {
    color:#007bff;
  }

  #dropdown-action-id .dropdown-item:active
  {
    color:#fff;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div>
      @if(Session::has('message'))
          <input type="hidden" name="txtMessage" id="idmessage" value="{{Session::has('message')}}"></input>
          <input type="hidden" name="txtMessage_text" id="idmessage_text" value="{{Session::get('message')}}"></input>
      @endif

      @if(Session::has('failed'))
          <input type="hidden" name="txtMessageFailed" id="idmessagefailed" value="{{Session::has('failed')}}"></input>
          <input type="hidden" name="txtMessageFailed_text" id="idmessagefailed_text" value="{{Session::get('failed')}}"></input>
      @endif
    </div>

    <!-- Card -->
    <div class="card card-outline card-primary">
      <div class="card-body">

        <table id="table-view" class="table table-bordered table-hover">
          <thead>
            <tr style="color:#0056b3">
              <th>No</th>
              <th>Tanggal</th>
              <th>Akun</th>
              <th>Jumlah Pemasukan</th>
              <th>Huria (45%)</th>
              <th>BPSK (55%)</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @php
            $no = 0
            @endphp
            @foreach($pemasukan as $data)  
            <tr>
              <td>{{++$no}}</td>
              <td>{{customTanggal($data->tgl_pemasukan, 'd-m-Y')}}</td>
              <td>{{$data->akun}}</td>
              <td>{{formatMataUang($data->jumlah_pemasukan)}}</td>
              <td>{{formatMataUang($data->jumlah_huria)}}</td>
              <td>{{formatMataUang($data->jumlah_bpsk)}}</td>
              <td style="width:85px;">
                <div class="btn-group">
                  <button class="btn bg-gradient-primary btn-sm rounded-pill dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-check nav-icon"></i>
                  <span class="caret"></span>
                  </button>
                  <div class="dropdown-menu" id="dropdown-action-id">
                    <a class="dropdown-item" href="ubah-pemasukan-rutin/{{$data->id}}">Edit Data</a>
                    <a class="dropdown-item swalDelete" href="hapus-pemasukan-rutin/{{$data->id}}">Hapus Data</a>
                 </div>
                </div>
              </td>                        
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- Card -->
  </div>
</div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
$( document ).ready(function () {
    //SweetAlert Success
    var message = $("#idmessage").val();
    var message_text = $("#idmessage_text").val();

    if(message=="1")
    {
      Swal.fire({     
         icon: 'success',
         title: 'Sukses!',
         text: message_text,
         confirmButtonClass: 'btn bg-gradient-success rounded-pill',
      })
    }

    //SweetAlert Failed
    var failed = $("#idmessagefailed").val();
    var messagefailed_text = $("#idmessagefailed_text").val();

    if(failed=="1")
    {
      Swal.fire({     
         icon: 'error',
         title: 'Gagal!',
         text: messagefailed_text,
         showConfirmButton: true,
         confirmButtonClass: 'btn bg-gradient-danger rounded-pill',
      })
    }

    //SweetAlert Delete
   $(document).on("click", ".swalDelete",function(event) {  
      event.preventDefault();
      const url = $(this).attr('href');

      Swal.fire({
        title: 'Apakah anda yakin menghapus data ini?',
        text: 'Anda tidak akan dapat mengembalikan data ini!',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        confirmButtonClass: 'btn bg-gradient-danger rounded-pill',
        cancelButtonClass: 'btn bg-gradient-secondary rounded-pill',
      }).then((result) => {
      if (result.value) 
      {
          window.location.href = url;
      }
    });
  });
});
</script>
<script>
    $( document ).ready(function () {
      //DataTable

      $("#table-view").DataTable({
        "responsive": true,
        "autoWidth": true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i><span style="font-family: Source Sans Pro"> PDF &nbsp;</span>',
                className: 'btn-danger',
                orientation: 'landscape',
                pageSize: 'A4',
                title: 'Daftar Pemasukan'
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i><span style="font-family: Source Sans Pro"> Excel &nbsp;</span>',
                className: 'btn-success',
                orientation: 'landscape',
                pageSize: 'A4',
                title: 'Daftar Pemasukan'
            }, 
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i><span style="font-family: Source Sans Pro"> Print &nbsp;</span>',
                className: 'btn-secondary',
                title: 'Daftar Pemasukan',
                autoPrint: false,
            },
        ]
      });
  });
  </script>
@endsection