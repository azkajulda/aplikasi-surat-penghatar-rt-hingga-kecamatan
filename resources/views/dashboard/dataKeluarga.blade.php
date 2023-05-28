@extends('layouts.dashboard')

@section('page', 'Data Keluarga')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box">
        <div class="box-header mb-20">
          <h3 class="box-title">Nomor Kartu Keluarga : {{Auth::user()->no_kk}}</h3>

          <div class="box-tools">
            <a href="{{route('addKeluarga')}}">
              <button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>
                Tambah Anggota Keluarga
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
                <th>Nama Warga</th>
                <th>Pejerkaan</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $listKeluargas as $listKeluarga)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$listKeluarga->profile->nama}}</td>
                  <td>{{$listKeluarga->profile->pekerjaan}}</td>
                  <td>{{$listKeluarga->profile->tempat_lahir .', '. date('d M Y', strtotime($listKeluarga->profile->tanggal_lahir))}}</td>
                  <td>{{$listKeluarga->profile->jenis_kelamin}}</td>
                  <td class="text-center w-300">
                    <a href={{route('profile', $listKeluarga->profile->id)}}>
                      <button class="btn btn-success w-80"><i class="fa fa-id-card"></i>
                        Detail
                      </button>
                    </a>
                    <a href={{route('editProfile', $listKeluarga->profile->id)}}>
                      <button class="btn btn-warning w-80"><i class="fa fa-pencil"></i>
                        Edit
                      </button>
                    </a>
                    @if (count($listKeluarga->profile->surat) > 0)
                      <button class="btn btn-danger w-80" data-toggle="modal" data-target="#modal-cant-delete"><i class="fa fa-trash"></i>
                        Delete
                      </button>
                    @else
                      <a href={{route('deleteKeluarga', $listKeluarga->id)}}>
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
          <p>Tidak bisa menghapus anggota keluarga jika sedang mengajukan surat pengantar </p>
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