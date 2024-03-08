@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}}</b>
@endsection
@section('content')
  <!-- Main content -->
      <!-- /.col -->
    <div>
      @if(Session::has('message'))
          <input type="hidden" name="txtMessage" id="idmessage" value="{{Session::has('message')}}"></input>
          <input type="hidden" name="txtMessage_text" id="idmessage_text" value="{{Session::get('message')}}"></input>
      @endif
      @if(Session::has('failed'))
          <input type="hidden" name="txtFailed" id="idfailed" value="{{Session::has('failed')}}"></input>
          <input type="hidden" name="txtFailed_text" id="idfailed_text" value="{{Session::get('failed')}}"></input>
      @endif
    </div>
    <div class="col-md-12">
        <form role="form" id="arsip" method="post" action="{{url('pemasukan/proses-ubah-pemasukan-rutin')}}">
        {{ csrf_field() }}
          <div class="card">
              <div class="card-body">
                  <input type="hidden" name="id_pemasukan" value="{{$pemasukan->id}}">
                  <div class="form-group col-md-12 row">
                      <div class="col-md-3">
                          <label>Tanggal Pemasukan</label>
                      </div>
                      <div class="col-md-4">
                        <div class="input-group date">
                            <input type="text" name="tgl_pemasukan" id="datepicker" class="form-control" placeholder="dd/mm/yyyy" value="@if(!empty($pemasukan->tgl_pemasukan)){{date('d/m/Y', strtotime($pemasukan->tgl_pemasukan))}}@endif" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="form-group col-md-12 row">
                    <div class="col-md-3">
                      <label>Jenis Kegiatan</label>
                    </div>
                    <div class="col-md-9">
                      <select name="jenis_kegiatan" class="form-control select2bs4" id="jeniskegiatanSlc" style="width: 100%;" required>
                                <option value="" selected="selected">-- Pilih Satu --</option>
                              @foreach($jeniskegiatan as $data)
                                  <option value="{{$data->id}}" @if($pemasukan->jenis_kegiatan==$data->id) selected @endif>{{$data->akun}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="form-group col-md-12 row">
                    <div class="col-md-3">
                        <label>Jumlah Pemasukan</label>
                    </div>
                    <div class="col-md-9">
                          <input type="text" name="jumlah_pemasukan" class="form-control" value="{{formatMataUang($pemasukan->jumlah_pemasukan)}}" id="txtJumlahPemasukan" required>
                    </div>
                  </div>
                  <div class="form-group col-md-12 row">
                    <div class="col-md-3">
                        <label>Huria</label>
                    </div>
                    <div class="col-md-9">
                      <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              45%
                            </span>
                          </div>
                          <input type="text" name="jumlah huria" class="form-control" id="txtJumlahHuria" value="{{formatMataUang($pemasukan->jumlah_huria)}}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-12 row">
                    <div class="col-md-3">
                        <label>BPSK</label>
                    </div>
                    <div class="col-md-9">
                      <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              55%
                            </span>
                          </div>
                          <input type="text" name="jumlah_bpsk" class="form-control" id="txtJumlahBPSK" value="{{formatMataUang($pemasukan->jumlah_bpsk)}}"readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" style="margin-left:10px;">Simpan</button>
                </div>
                <!-- /.card-body -->
              </div>
            </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

  

<!-- ChartJS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
 $( document ).ready(function () {

    //SweetAlert Success
      var message = $("#idmessage").val();
      var message_text = $("#idmessage_text").val();

      if(message=="1")
      {
        Swal.fire({     
           icon: 'success',
           title: 'Success!',
           text: message_text,
           showConfirmButton: false,
           timer: 1500
        })
      }

      //SweetAlert Failed
      var failed = $("#idfailed").val();
      var messagefailed_text = $("#idfailed_text").val();

      if(failed=="1")
      {
          Swal.fire({     
             icon: 'error',
             title: 'Failed!',
             text: messagefailed_text,
             showConfirmButton: true,
          })
      }  
})

$(document).ready(function () {
  $("#txtJumlahPemasukan").keyup(function(){
       $("#txtJumlahPemasukan").val(formatRupiah($(this).val()));

       txtPemasukan = $(this).val();
       txtPemasukan = txtPemasukan.replaceAll(".", "");
       valPemasukan = parseFloat(txtPemasukan);

       huria = Math.round(valPemasukan * 0.45).toString();
       bpsk = Math.round(valPemasukan * 0.55).toString();

       $("#txtJumlahHuria").val(formatRupiah(huria));
       $("#txtJumlahBPSK").val(formatRupiah(bpsk));
    });
});

function formatRupiah(angka)
{
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
  split       = number_string.split(','),
  sisa        = split[0].length % 3,
  rupiah      = split[0].substr(0, sisa),
  ribuan      = split[0].substr(sisa).match(/\d{3}/gi);
 
  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if(ribuan){
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }
 
  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return rupiah;
}
   
</script>
@endsection
