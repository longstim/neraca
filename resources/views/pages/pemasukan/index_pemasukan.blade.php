@extends('layouts.dashboard')
@section('page_heading')
<b>{{$title}}</b>
@endsection
@section('breadcrumb')
<a href="{{url('pemasukan/daftar-pemasukan')}}" class="btn bg-primary float-right"><i class="fas fa-list"></i> &nbsp;Daftar Pemasukan</a>
@endsection
@section('content')
  <!-- Main content -->
      <!-- /.col -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
           <div class="row">
              <div class="col-lg-4 text-center">
                <div class="card card-default" style="border: solid 2px #0056b3; border-radius: 15px;">
                      <div class="card-header">
                          <h5 class="text-center" style="color:#0056b3"><b>Pemasukan Rutin</b></h5>
                      </div>
                      <div class="card-body text-center">
                          Silahkan tambahkan jenis pemasukan rutin!
                      </div>
                      <div class="card-footer mb-3 text-center">
                          <a href="{{url('pemasukan/tambah-pemasukan-rutin')}}" class="btn btn-outline-primary" style="width:150px"><i class="fa fa-plus-circle"></i> &nbsp;Tambah</a>
                      </div>
                  </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 text-center">
                <div class="card card-default" style="border: solid 2px #0056b3; border-radius: 15px;">
                      <div class="card-header">
                          <h5 class="text-center" style="color:#0056b3"><b>Pemasukan Huria</b></h5>
                      </div>
                      <div class="card-body text-center">
                          Silahkan tambahkan jenis pemasukan Huria!<br>
                      </div>
                      <div class="card-footer mb-3 text-center">
                          <button type="submit" class="btn btn-outline-primary" style="width:150px"><i class="fa fa-plus-circle"></i> &nbsp;Tambah</button>
                      </div>
                  </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 text-center">
                <div class="card card-default" style="border: solid 2px #0056b3; border-radius: 15px;">
                      <div class="card-header">
                          <h5 class="text-center" style="color:#0056b3"><b>Pemasukan Transitori</b></h5>
                      </div>
                      <div class="card-body text-center">
                          Silahkan tambahkan jenis pemasukan Transitori!<br>
                      </div>
                      <div class="card-footer mb-3 text-center">
                          <button type="submit" class="btn btn-outline-primary" style="width:150px"><i class="fa fa-plus-circle"></i> &nbsp;Tambah</button>
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

  

<!-- ChartJS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
@endsection
