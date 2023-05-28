@extends('layouts.dashboard')

@section('css-add-on')
    <link rel="stylesheet" href="{{asset('./dashboard-asset/bower_components/signature/css/jquery.signature.css')}}">
    <style>
      .kbw-signature { width: 100%; height: 195px;}
      #sig canvas{ width: 100% !important; height: auto;}
    </style> 
@endsection

@section('page', 'Registrasi Warga')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box box-primary">
        <form method="POST" action="{{route('addWarga')}}" enctype="multipart/form-data">
          @csrf

          <div class="box-header">
            <h3 class="box-title">
              <a href="{{url()->previous()}}">
                <i class="fa fa-arrow-circle-left"></i> <span>Kembali</span>
              </a>
            </h3>
          </div>
          <div class="box-body">
            {{-- Account --}}
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
            <div class="box box-primary">
              <div class="box-header with-border">
                <i class="fa fa-user"></i>

                <h3 class="box-title">Registrasi Akun RT/RW</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="form-group col-md-5">
                    <label for="noKK">No Kartu Keluarga*</label>
                    <input type="number" name="no_kk" class="form-control" id="noKK" placeholder="Nomor Kartu Keluarga" required>
                  </div>
                  <div class="form-group col-md-5">
                    <label for="email">Email*</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                  </div>
                  <div class="form-group col-md-5">
                    <label for="password">Password*</label>
                    <div class="input-group">
                      <input id="password" type="password" name="password" class="form-control" required>
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-flat" onclick="showPassword('password')"><i id='eye-password' class="fa fa-eye"></i></button>
                      </span>
                    </div>
                  </div>
                  <div class="form-group col-md-5">
                    <label for="konfirm-password">Konfirmasi Password*</label>
                    <div class="input-group">
                      <input id="konfirm-password" type="password" name="konfirmPassword" class="form-control" required>
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-flat" onclick="showPassword('konfirm-password')"><i id='eye-konfirm-password' class="fa fa-eye"></i></button>
                      </span>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="box box-primary">
              <div class="box-header with-border">
                <i class="fa fa-user"></i>

                <h3 class="box-title">Profile RT/RW</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="noNik">No Induk Kependudukan*</label>
                    <input type="number" name="no_nik" class="form-control" id="noNik" placeholder="Nomor Induk Kependudukan" required>
                  </div>

                  <div class="form-group col-md-8">
                    <label for="nama">Nama Lengkap*</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="jenis_kelamin">Jenis Kelamin*</label>
                    <div id="jenis_kelamin">
                      <label class="radio-inline"><input type="radio" name="jenis_kelamin" value="Laki-laki" required>Laki-laki</label>
                      <label class="radio-inline"><input type="radio" name="jenis_kelamin" value="Perempuan" required>Perempuan</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="tempat_lahir">Tempat Lahir*</label>
                    <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" required>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="tanggal_lahir">Tanggal Lahir*</label>
                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
                  </div>

                  <div class="form-group col-md-4">
                    <label>Pendidikan*</label>
                    <select class="form-control" name="pendidikan" required>
                      <option value="">&mdash;Pilih Pendidikan Anda&mdash;</option>
                      <option value="Belum Sekolah">Belum Sekolah</option>
                      <option value="SD / Sederajat">SD / Sederajat</option>
                      <option value="SLTP / Sederajat">SLTP / Sederajat</option>
                      <option value="DIPLOMA I / II">DIPLOMA I / II</option>
                      <option value="AKADEMI/ DIPLOMA III/S. MUDA">AKADEMI/ DIPLOMA III/S. MUDA</option>
                      <option value="DIPLOMA IV/ STRATA I">DIPLOMA IV/ STRATA I</option>
                      <option value="STRATA II">STRATA II</option>
                      <option value="STRATA III">STRATA III</option>
                    </select>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="pekerjaan">Pekerjaan*</label>
                    <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" placeholder="Pekerjaan" required>
                  </div>

                  <div class="form-group col-md-4">
                    <label>Agama*</label>
                    <select class="form-control" name="agama" required>
                      <option value="">&mdash;Pilih Agama Anda&mdash;</option>
                      <option value="Islam">Islam</option>
                      <option value="Kristen">Kristen</option>
                      <option value="Hindu">Hindu</option>
                      <option value="Buddha">Buddha</option>
                      <option value="Katolik">Katolik</option>
                      <option value="Kong Hu Chu">Kong Hu Chu</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="golongan_darah">Golongan Darah*</label>
                    <div id="golongan_darah">
                      <label class="radio-inline"><input type="radio" name="golongan_darah" value="A" required>A</label>
                      <label class="radio-inline"><input type="radio" name="golongan_darah" value="B" required>B</label>
                      <label class="radio-inline"><input type="radio" name="golongan_darah" value="AB" required>AB</label>
                      <label class="radio-inline"><input type="radio" name="golongan_darah" value="O" required>O</label>
                    </div>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/png, image/jpeg">
                  </div>

                  <div class="form-group col-md-3">
                    <label>RW*</label>
                    <select class="form-control" name="id_rw" id="rw-state" required disabled>
                      <option value="{{Auth::user()->list_keluarga->id_rw}}" selected>{{Auth::user()->list_keluarga->rw->nomor_rw}}</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label>RT*</label>
                    <select class="form-control" name="id_rt" id="rt-state" required disabled>
                      <option value="{{Auth::user()->list_keluarga->id_rt}}" selected>{{Auth::user()->list_keluarga->rt->nomor_rt}}</option>
                    </select>
                  </div>

                  <div class="form-group col-md-8">
                    <label>Alamat*</label>
                    <textarea class="form-control" name="alamat" rows="9" placeholder="Alamat"></textarea>
                  </div>

                  <div class="form-group col-md-4">
                    <label class="" for="">Tanda Tangan*</label>
                    <br/>
                    <div id="sig"></div>
                    <br><br>
                    <button id="clear" class="btn btn-danger">Bersihkan Tanda Tangan</button>
                    <textarea id="signature" name="ttd" style="display: none"></textarea>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="box-footer">
            <button class="btn btn-primary btn-lg" type="submit">
              Simpan
            </button>
          </div>
        </form>
      </div>
      <!-- nav-tabs-custom -->
    </div>
  </div>
@endsection

@section('js-add-on')
  <script src="{{asset('./dashboard-asset/bower_components/signature/js/jquery.signature.js')}}"></script>
  <script type="text/javascript">
      const showPassword = (feature = '') => {
        const passwordById = document.getElementById('password').type
        const konfirmPasswordById = document.getElementById('konfirm-password').type
        const eyePassword = document.getElementById('eye-password')
        const konfirmEyePassword = document.getElementById('eye-konfirm-password')

        if (feature === 'password') {
          if(passwordById === 'password'){
            document.getElementById('password').type = 'text';
            eyePassword.classList.remove('fa-eye');
            eyePassword.classList.add('fa-eye-slash');
          } else {
            document.getElementById('password').type = 'password';
            eyePassword.classList.remove('fa-eye-slash');
            eyePassword.classList.add('fa-eye');
          }
        } else {
          if(konfirmPasswordById === 'password'){
            document.getElementById('konfirm-password').type = 'text';
            eyePassword.classList.remove('fa-eye');
            eyePassword.classList.add('fa-eye-slash');
          } else {
            document.getElementById('konfirm-password').type = 'password';
            konfirmEyePassword.classList.remove('fa-eye-slash');
            konfirmEyePassword.classList.add('fa-eye');
          }
        }
      }
    

      var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
      $('#clear').click(function(e) {
          e.preventDefault();
          sig.signature('clear');
          $("#signature").val('');
      });

      $(document).ready(function() {
        $('#role-state').change(function(event) {
          const valueRole = this.value;
          
          $('#rw-state').html('');

          $.ajax({
            url: "{{route('fetchRwValidate')}}",
            type: 'POST',
            dataType: 'json',
            data: {role: valueRole, _token:"{{csrf_token() }}"},
            success: function(response){
              $('#rw-state').html('<option value="">&mdash;Pilih RW Anda&mdash;</option>');
              $.each(response.rws,function(index, val){
                $('#rw-state').append('<option value="'+val.id+'"> '+val.nomor_rw+' </option>')
              });
            }

          })
        });

        $('#rw-state').change(function(event) {
          var idRw = this.value;
          
          $('#rt-state').html('');
          const valueRole = $('#role-state').val();

          $.ajax({
            url: "{{route('fetchRtValidate')}}",
            type: 'POST',
            dataType: 'json',
            data: {role: valueRole, id_rw: idRw, _token:"{{csrf_token() }}"},
            success: function(response){
              $('#rt-state').html('<option value="">&mdash;Pilih RT Anda&mdash;</option>');
              $.each(response.rts,function(index, val){
                $('#rt-state').append('<option value="'+val.id+'"> '+val.nomor_rt+' </option>')
              });
            }

          })
        });
      });
  </script>
@endsection