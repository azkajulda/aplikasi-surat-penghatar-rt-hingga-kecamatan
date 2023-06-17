@extends('layouts.dashboard')

@section('page', 'Data Warga')

@section('css-add-on')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box">
        <div class="box-header mb-20">
          <h3 class="box-title">
            <a href="{{url()->previous()}}">
              <i class="fa fa-arrow-circle-left"></i> <span>Kembali</span>
            </a>
          </h3>
          <h3 class="box-title ml-20">List Warga RT {{Auth::user()->list_keluarga->rt->nomor_rt}}</h3>
        </div>
        <div class="box-body table-responsive">
          @if (session('alert'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Terjadi Kesalahan</h4>
                {{ session('alert') }}
              </div>
          @elseif(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Berhasil</h4>
                {{ session('success') }}
              </div>
          @endif
          <table id="table-keluarga" class="table table-bordered table-striped" aria-describedby="table-keluarga">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Warga</th>
                <th>NIK</th>
                <th>No Kartu Keluarga</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $wargas as $warga)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$warga->nama ?? '-'}}</td>
                  <td>{{$warga->no_nik ?? '-'}}</td>
                  <td>{{$warga->no_kk ?? '-'}}</td>
                  <td class="text-center w-300">
                    <a href={{route('detailWarga', $warga->user_id)}}>
                      <button class="btn btn-success w-80"><i class="fa fa-id-card"></i>
                        Detail
                      </button>
                    </a>
                    <a href={{route('deleteWarga', $warga->id)}}>
                      <button class="btn btn-danger w-80"><i class="fa fa-trash"></i>
                        Delete
                      </button>
                    </a>
                  </td>
                </tr>  
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- nav-tabs-custom -->
    </div>
  </div>
@endsection

@section('js-add-on')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
  <script>
    $(function () {
      $('#table-keluarga').DataTable({
        responsive: true
      })
    })
  </script>
@endsection