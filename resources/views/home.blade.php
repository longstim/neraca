@extends('layouts.dashboard')
@section('content')
  <!-- Main content -->
      <!-- /.col -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>Rp {{formatMataUang(jlhPemasukan())}}</h3>

                  <p>Jumlah Pemasukan</p>
                </div>
                <div class="icon">
                  <i class="ion ion-compose"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>Rp {{formatMataUang(jlhPengeluaran())}}</h3>

                  <p>Jumlah Pengeluaran</p>
                </div>
                <div class="icon">
                  <i class="ion ion-load-a"></i>
                </div>
              </div>
            </div>
          <!-- ./col -->
        </div>

        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><b>Overview Pemasukan</b></h3>
        </div>
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
            </tr>
            @endforeach
          </tbody>
        </table>
        </div><!-- /.card-body -->
        <div class="card-footer text-right">
          <a href="{{url('pemasukan/daftar-pemasukan')}}" class="btn btn-outline-primary">Lihat Selengkapnya</a>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><b>Overview Pengeluaran</b></h3>
        </div>
        <div class="card-body">
        <table id="table-view" class="table table-bordered table-hover">
          <thead>
            <tr style="color:#0056b3">
              <th>No</th>
              <th>Tanggal</th>
              <th>Akun</th>
              <th>Jumlah Pengeluaran</th>
            </tr>
            </thead>
            <tbody>
            @php
            $no = 0
            @endphp
            @foreach($pengeluaran as $data)  
            <tr>
              <td>{{++$no}}</td>
              <td>{{customTanggal($data->tgl_pengeluaran, 'd-m-Y')}}</td>
              <td>{{$data->akun}}</td>
              <td>{{formatMataUang($data->jumlah_pengeluaran)}}</td>                     
            </tr>
            @endforeach
          </tbody>
        </table>
        </div><!-- /.card-body -->
        <div class="card-footer text-right">
          <a href="{{url('pemasukan/daftar-pengeluaran')}}" class="btn btn-outline-primary">Lihat Selengkapnya</a>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->


<!-- ChartJS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>

<script type="text/javascript">
  $( document ).ready(function () {
      //DataTable

      $("#table-view").DataTable({
        "responsive": true,
        "autoWidth": true,
        "searching": false,
        "lengthChange": false,
        "paging": false,
        "info": false,
      });
  });
</script>
@endsection
