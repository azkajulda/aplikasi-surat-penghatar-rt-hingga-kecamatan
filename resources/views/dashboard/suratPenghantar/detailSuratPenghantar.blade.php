@extends('layouts.dashboard')

@section('page', 'Detail Surat')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box box-default">

        <div class="box-header">
          <h3 class="box-title">
            <a href="{{url()->previous()}}">
              <i class="fa fa-arrow-circle-left"></i> <span>Kembali</span>
            </a>
          </h3>
        </div>

        <div class="box-body">
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
          <div class="row">
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-file-text"></i>

                  <h3 class="box-title">{{$surat->kepentingan->jenis_kepentingan}}</h3>
                </div>
                
                <div class="box-body">
                  <div class="header-profile">
                    <div class="col-md-3">
                      <img class="img-circle img-profile" src="{{$surat->profile->photo ??  asset('./img/default_user.png')}}" alt="profile-img">
                    </div>
                    <div class="col-md-9">
                      <h3>
                        {{$surat->profile->nama}}
                      </h3>
                      
                      <h5 class="my-20">
                        {{$surat->profile->no_nik}}
                      </h5>

                      <h5>
                        {{$surat->profile->alamat}}
                      </h5>
                    </div>
                    
                    </div>
                </div>

                <div class="body-profile">
                  <div class="col-md-6">
                    <div class="my-20">
                      <b>RT/RW</b>
                      <p>{{$surat->profile->list_kelaurga->rt->nomor_rt}}/{{$surat->profile->list_kelaurga->rw->nomor_rw}}</p>
                    </div>

                    <div class="my-20">
                      <b>Jenis Kelamin</b>
                      <p>{{$surat->profile->jenis_kelamin}}</p>
                    </div>

                    <div class="my-20">
                      <b>Pendidikan</b>
                      <p>{{$surat->profile->pendidikan}}</p>
                    </div>

                    <div class="my-20">
                      <b>Golongan Darah</b>
                      <p>{{$surat->profile->golongan_darah}}</p>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="my-20">
                      <b>Agama</b>
                      <p>{{$surat->profile->agama}}</p>
                    </div>

                    <div class="my-20">
                      <b>Tempat, Tanggal lahir</b>
                      <p>{{$surat->profile->tempat_lahir}}, {{date('d M Y', strtotime($surat->profile->tanggal_lahir))}}</p>
                    </div>

                    <div class="my-20">
                      <b>Pekerjaan</b>
                      <p>{{$surat->profile->pekerjaan}}</p>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <b>Tanda Tangan</b>
                    <p>
                      <img src="{{$surat->profile->ttd ??  asset('./img/default_img.jpeg')}}" alt="ttd-img">
                    </p>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-md-3">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <i class="fa fa-pencil-square-o"></i>

                  <h3 class="box-title">Lampiran Berkas</h3>
                </div>
                <div class="box-body">
                  @foreach (json_decode($surat->berkas) as $dataBerkas)
                    <a href="{{$dataBerkas}}" target="_blank">{{$loop->iteration}}. {{strlen(basename($dataBerkas)) > 10 ? substr(basename($dataBerkas), 15, strlen(basename($dataBerkas))): basename($dataBerkas)}}</a>
                    <br>
                  @endforeach
                  @if (Auth::user()->role === 'lurah')
                    <a href="{{route('suratRtRw', $surat->id)}}" target="_blank">{{count(json_decode($surat->berkas)) + 1}}. Surat Penghantar RT dan RW</a>
                  @endif
                </div>
              </div>

              <div class="box box-warning">
                <div class="box-header with-border">
                  <i class="fa fa-pencil-square-o"></i>

                  <h3 class="box-title">Aksi</h3>
                </div>
                <div class="box-body">
                  <form action="{{route('aprrove', $surat->id)}}" method="POST">
                    @csrf
                    <button class="btn btn-success w-full"><i class="fa fa-check mr-10"></i>
                      Approve
                    </button>
                  </form>
                  <button class="btn btn-danger w-full mt-20" data-toggle="modal" data-target="#modal-tolak"><i class="fa fa-close mr-10"></i>
                    Tolak
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal modal-default fade" id="modal-tolak">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tolak Surat Penghantar</h4>
        </div>
        <form action="{{route('tolak', $surat->id)}}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="form-group col-md-12">
                <label>Keterangan penolakan*</label>
                <textarea class="form-control" name="keterangan_penolakan" rows="9" placeholder="Keterangan Penolakan" required></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection