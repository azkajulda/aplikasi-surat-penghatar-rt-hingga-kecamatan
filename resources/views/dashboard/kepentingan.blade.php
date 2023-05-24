@extends('layouts.dashboard')

@section('page', 'List Kepentingan Surat')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box">
        <div class="box-header mb-20">
          <div class="box-tools">
            <a href="{{route('tambahKepentingan')}}">
              <button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>
                Tambah Surat Kepentingan
              </button>
            </a>
          </div>
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
                <th>Nama Kepentingan</th>
                <th>Tipe Surat</th>
                <th>Syarat Berkas</th>
                <th>Deskripsi</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $kepentingans as $kepentingan)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$kepentingan->jenis_kepentingan}}</td>
                  <td>{{$kepentingan->tipe_surat}}</td>
                  <td>{{$kepentingan->keterangan}}</td>
                  <td>{{$kepentingan->deskripsi ?? '-'}}</td>
                  <td class="text-center w-300">
                    <a href={{route('editKepentingan', $kepentingan->id)}}>
                      <button class="btn btn-warning w-80"><i class="fa fa-pencil"></i>
                        Edit
                      </button>
                    </a>
                    @if (count($kepentingan->surat) > 0)
                      <button class="btn btn-danger w-80" data-toggle="modal" data-target="#modal-cant-delete"><i class="fa fa-trash"></i>
                        Delete
                      </button>
                    @else
                      <a href={{route('deleteKepentingan', $kepentingan->id)}}>
                        <button class="btn btn-danger w-80"><i class="fa fa-trash"></i>
                          Delete
                        </button>
                      </a>
                    @endif
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
          <p>Tidak bisa menghapus kepentingan surat ini jika sedang ada yang mengajukan surat penghantar dengan kepentingan tersebut</p>
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