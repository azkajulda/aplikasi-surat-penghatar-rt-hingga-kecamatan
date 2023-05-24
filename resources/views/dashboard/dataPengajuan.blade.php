@extends('layouts.dashboard')

@section('page', 'Data Pengajuan')

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
          @if (Auth::user()->role === 'lurah')
            <li><a href="#tab_2" data-toggle="tab">Sudah Disetujui</a></li>
          @endif
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="table-responsive">
              <table id="table-pengajuan" class="table table-bordered table-striped" aria-describedby="table-pengajuan">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Permohonan</th>
                    <th>NIK</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($suratPengajuan as $dataPengajuan)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$dataPengajuan->tanggal_permohonan}}</td>
                      <td>{{$dataPengajuan->no_nik}}</td>
                      <td>{{$dataPengajuan->jenis_kepentingan}}</td>
                      <td>{{$dataPengajuan->status}}</td>
                      <td class="text-center">
                        <a href="{{route('detailSurat', $dataPengajuan->id)}}">
                          <button class="btn btn-primary"><i class="fa fa-file-text"></i>
                            Cek Pengajuan
                          </button>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          @if (Auth::user()->role === 'lurah')
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
                          <a href="{{route('suratLurah', $dataApproved->id)}}">
                            <button class="btn btn-success"><i class="fa fa-print"></i>
                              Cetak
                            </button>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          @endif
        </div>
      </div>
      <!-- nav-tabs-custom -->
    </div>
  </div>
@endsection

@section('js-add-on')
  <script>
    $(function () {
      $('#table-pengajuan').DataTable({
        responsive: true
      })
      $('#table-disetujui').DataTable({
        responsive: true
      })
    })
  </script>
@endsection