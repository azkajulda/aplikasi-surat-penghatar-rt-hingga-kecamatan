@extends('layouts.dashboard')

@section('page', 'Data RW dan RT')

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
          <h3 class="box-title ml-20">List Ketua RT (RW {{$listKetuaRT[0]->rw->nomor_rw}})</h3>
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
                <th>Nama RT</th>
                <th>NIK</th>
                <th>No Kartu Keluarga</th>
                <th>Jabatan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $listKetuaRT as $listKetuaRt)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$listKetuaRt->ketua_rt->profile?->nama ?? '-'}}</td>
                  <td>{{$listKetuaRt->ketua_rt->profile?->no_nik ?? '-'}}</td>
                  <td>{{$listKetuaRt->ketua_rt->profile?->list_kelaurga->user->no_kk ?? '-'}}</td>
                  <td>Ketua RT {{$listKetuaRt->nomor_rt}}</td>
                  <td class="text-center w-300">
                    {{-- <a href={{route('editProfile', $listKetuaRt->profile?->id)}}> --}}
                      <button class="btn btn-warning w-80"><i class="fa fa-pencil"></i>
                        Edit
                      </button>
                    {{-- </a> --}}
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

  <div class="modal modal-danger fade" id="modal-cant-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Gagal!</h4>
        </div>
        <div class="modal-body">
          <p>Tidak bisa menghapus anggota keluarga jika sedang mengajukan surat penghantar </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@section('js-add-on')
  <script>
    $(function () {
      $('#table-keluarga').DataTable({
        responsive: true
      })
      $('#table-disetujui').DataTable({
        responsive: true
      })
    })
  </script>
@endsection