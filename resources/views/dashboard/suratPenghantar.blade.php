@extends('layouts.dashboard')

@section('page', 'Surat Penghantar')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
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
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Sedang Diajukan</a></li>
          <li><a href="#tab_2" data-toggle="tab">Sudah Disetujui</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="table-responsive">
              <table id="table-diajukan" class="table table-bordered table-striped" aria-describedby="table-diajukan">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Permohonan</th>
                    <th>NIK</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    {{-- <th>Berkas</th> --}}
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($suratPending as $dataPending)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$dataPending->tanggal_permohonan}}</td>
                      <td>{{$dataPending->profile->no_nik}}</td>
                      <td>{{$dataPending->kepentingan->jenis_kepentingan}}</td>
                      <td>{{$dataPending->status}}
                        @if ($dataPending->keterangan_penolakan && str_contains($dataPending->status, 'Ditolak'))
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{$dataPending->keterangan_penolakan}}"></i>
                        @endif
                      </td>
                      {{-- <td>
                        @foreach (json_decode($dataPending->berkas) as $dataBerkas)
                          <img src="{{$dataBerkas}}" alt="" class="w-80">
                        @endforeach
                      </td> --}}
                      <td class="text-center">
                        <a href="{{route('editSuratPenghantar', $dataPending->id)}}">
                          <button class="btn btn-warning"><i class="fa fa-pencil"></i>
                            Edit
                          </button>
                        </a>
                        <a href="{{route('batalkanSurat', $dataPending->id)}}">
                          <button class="btn btn-danger"><i class="fa fa-trash"></i>
                            Batalkan
                          </button>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
            <div class="table-responsive">
              <table id="table-disetujui" class="table table-bordered table-striped" aria-describedby="table-diajukan">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Permohonan</th>
                    <th>NIK</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    {{-- <th>berkas</th> --}}
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($suratApproved as $dataApproved)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$dataApproved->tanggal_permohonan}}</td>
                      <td>{{$dataApproved->profile->no_nik}}</td>
                      <td>{{$dataApproved->kepentingan->jenis_kepentingan}}</td>
                      <td>{{$dataApproved->status}}</td>
                      {{-- <td>
                        @foreach (json_decode($dataApproved->berkas) as $dataBerkas)
                          <img src="{{$dataBerkas}}" alt="" class="w-80">
                        @endforeach
                      </td> --}}
                      <td class="text-center">
                        @if ($dataApproved->tipe_berkas !== 'Kelurahan')
                          <a href="{{route('suratLurah', $dataApproved->id)}}">
                            <button class="btn btn-success"><i class="fa fa-print"></i>
                              Cetak
                            </button>
                          </a>
                        @else
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Silakan ambil surat di kelurahan"></i>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>
  </div>
@endsection

@section('js-add-on')
  <script>
    $(function () {
      $('#table-diajukan').DataTable({
        responsive: true
      })
      $('#table-disetujui').DataTable({
        responsive: true
      })
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
@endsection