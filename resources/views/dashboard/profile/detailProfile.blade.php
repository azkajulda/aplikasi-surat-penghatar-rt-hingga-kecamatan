@extends('layouts.dashboard')

@section('page', 'Profile')

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
                  <i class="fa fa-user"></i>

                  <h3 class="box-title">Profile Anda</h3>
                </div>

                @if (!$profile)
                <div class="text-center">
                  <h3>Data Profile Kosong</h3>
                  <h5>Silahkan Isi Data Anda Disini</h5>
                  <a href={{route('addKeluarga')}}>
                    <button class="btn btn-primary my-20"><i class="fa fa-book mr-10"></i>
                      Tambah Data Kepala Keluarga
                    </button>
                  </a>
                </div>
                @else
                  <div class="box-body">
                    <div class="header-profile">
                      <div class="col-md-3">
                        <img class="img-circle img-profile" src="{{$profile[0]->photo ??  asset('./img/default_user.png')}}" alt="profile-img">
                      </div>
                      <div class="col-md-9">
                        <h3>
                          {{$profile[0]->nama}}
                        </h3>
                        
                        <h5 class="my-20">
                          {{$profile[0]->no_nik}}
                        </h5>

                        <h5>
                          {{$profile[0]->alamat}}
                        </h5>
                      </div>
                      
                      </div>
                  </div>

                  <div class="body-profile">
                    <div class="col-md-6">
                      <div class="my-20">
                        <b>RT/RW</b>
                        <p>{{$profile[0]->list_kelaurga->rt->nomor_rt}}/{{$profile[0]->list_kelaurga->rw->nomor_rw}}</p>
                      </div>

                      <div class="my-20">
                        <b>Jenis Kelamin</b>
                        <p>{{$profile[0]->jenis_kelamin}}</p>
                      </div>

                      <div class="my-20">
                        <b>Pendidikan</b>
                        <p>{{$profile[0]->pendidikan}}</p>
                      </div>

                      <div class="my-20">
                        <b>Golongan Darah</b>
                        <p>{{$profile[0]->golongan_darah}}</p>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="my-20">
                        <b>Agama</b>
                        <p>{{$profile[0]->agama}}</p>
                      </div>

                      <div class="my-20">
                        <b>Tempat, Tanggal lahir</b>
                        <p>{{$profile[0]->tempat_lahir}}, {{date('d M Y', strtotime($profile[0]->tanggal_lahir))}}</p>
                      </div>

                      <div class="my-20">
                        <b>Pekerjaan</b>
                        <p>{{$profile[0]->pekerjaan}}</p>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <b>Tanda Tangan</b>
                      <p>
                        <img src="{{$profile[0]->ttd ??  asset('./img/default_img.jpeg')}}" alt="ttd-img">
                      </p>
                    </div>
                  </div>
                @endif

              </div>
            </div>

            <div class="col-md-3">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <i class="fa fa-pencil-square-o"></i>

                  <h3 class="box-title">Aksi</h3>
                </div>
                <div class="box-body">
                  @if ($profile)
                    <a href={{route('editProfile', $profile[0]->id)}}>
                      <button class="btn btn-primary w-full my-20"><i class="fa fa-pencil mr-10"></i>
                        Edit Profile
                      </button>
                    </a>
                  @endif
                  <a href={{route('changePassword')}}>
                    <button class="btn btn-primary w-full"><i class="fa fa-lock mr-10"></i>
                      Ubah Password
                    </button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection