@extends('layouts.dashboard')

@section('css-add-on')
    <link rel="stylesheet" href="{{asset('./dashboard-asset/bower_components/signature/css/jquery.signature.css')}}">
    <style>
      .kbw-signature { width: 100%; height: 195px;}
      #sig canvas{ width: 100% !important; height: auto;}
    </style> 
@endsection

@section('page', 'Edit Profile')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box box-primary">
        <form method="POST" action="{{route('updateProfile', $profile[0]->id)}}" enctype="multipart/form-data">
          @csrf

          <div class="box-header">
            <h3 class="box-title">
              <a href="{{url()->previous()}}">
                <i class="fa fa-arrow-circle-left"></i> <span>Kembali</span>
              </a>
            </h3>
          </div>
          <div class="box-body">

              <div class="row">
                <div class="form-group col-md-4">
                  <label for="noNik">No Induk Kependudukan*</label>
                  <input type="number" value="{{$profile[0]->no_nik}}" name="no_nik" class="form-control" id="noNik" placeholder="Nomor Induk Kependudukan" required>
                </div>

                <div class="form-group {{Auth::user()->role === 'warga' ? 'col-md-4' : 'col-md-8'}}">
                  <label for="nama">Nama Lengkap*</label>
                  <input type="text" value="{{$profile[0]->nama}}" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required>
                </div>

                @if (Auth::user()->role === 'warga')
                  <div class="form-group col-md-4">
                    <label>Status Keluarga*</label>
                    <select class="form-control" name="status_keluarga" required>
                      <option value="">&mdash;Pilih Status Keluarga Anda&mdash;</option>
                      <option value="Kepala Rumah Tangga" {{$profile[0]->list_kelaurga->status_keluarga === 'Kepala Rumah Tangga' ? 'selected' : ''}}>Kepala Rumah Tangga</option>
                      <option value="Istri" {{$profile[0]->list_kelaurga->status_keluarga === 'Istri' ? 'selected' : ''}}>Istri</option>
                      <option value="Anak" {{$profile[0]->list_kelaurga->status_keluarga === 'Anak' ? 'selected' : ''}}>Anak</option>
                    </select>
                  </div>
                @endif

                <div class="form-group col-md-4">
                  <label for="jenis_kelamin">Jenis Kelamin*</label>
                  <div id="jenis_kelamin">
                    <label class="radio-inline"><input type="radio" name="jenis_kelamin" value="Laki-laki" {{$profile[0]->jenis_kelamin === "Laki-laki" ? 'checked' : ''}} required>Laki-laki</label>
                    <label class="radio-inline"><input type="radio" name="jenis_kelamin" value="Perempuan" {{$profile[0]->jenis_kelamin === "Perempuan" ? 'checked' : ''}} required>Perempuan</label>
                  </div>
                </div>

                <div class="form-group col-md-4">
                  <label for="tempat_lahir">Tempat Lahir*</label>
                  <input type="text" value="{{$profile[0]->tempat_lahir}}" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="tanggal_lahir">Tanggal Lahir*</label>
                  <input type="date" value="{{$profile[0]->tanggal_lahir}}" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
                </div>

                <div class="form-group col-md-4">
                  <label>Pendidikan*</label>
                  <select class="form-control" name="pendidikan" required>
                    <option value="">&mdash;Pilih Pendidikan Anda&mdash;</option>
                    <option value="Belum Sekolah" {{$profile[0]->pendidikan === 'Belum Sekolah' ? 'selected' : ''}}>Belum Sekolah</option>
                    <option value="SD / Sederajat" {{$profile[0]->pendidikan === 'SD / Sederajat' ? 'selected' : ''}}>SD / Sederajat</option>
                    <option value="SLTP / Sederajat" {{$profile[0]->pendidikan === 'SLTP / Sederajat' ? 'selected' : ''}}>SLTP / Sederajat</option>
                    <option value="DIPLOMA I / II" {{$profile[0]->pendidikan === 'DIPLOMA I / II' ? 'selected' : ''}}>DIPLOMA I / II</option>
                    <option value="AKADEMI/ DIPLOMA III/S. MUDA" {{$profile[0]->pendidikan === 'AKADEMI/ DIPLOMA III/S. MUDA' ? 'selected' : ''}}>AKADEMI/ DIPLOMA III/S. MUDA</option>
                    <option value="DIPLOMA IV/ STRATA I" {{$profile[0]->pendidikan === 'DIPLOMA IV/ STRATA I' ? 'selected' : ''}}>DIPLOMA IV/ STRATA I</option>
                    <option value="STRATA II" {{$profile[0]->pendidikan === 'STRATA II' ? 'selected' : ''}}>STRATA II</option>
                    <option value="STRATA III" {{$profile[0]->pendidikan === 'STRATA III' ? 'selected' : ''}}>STRATA III</option>
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="pekerjaan">Pekerjaan*</label>
                  <input type="text" value="{{$profile[0]->pekerjaan}}" name="pekerjaan" class="form-control" id="pekerjaan" placeholder="Pekerjaan" required>
                </div>

                <div class="form-group col-md-4">
                  <label>Agama*</label>
                  <select class="form-control" name="agama" value="{{$profile[0]->agama}}" required>
                    <option value="">&mdash;Pilih Agama Anda&mdash;</option>
                    <option value="Islam" {{$profile[0]->agama === 'Islam' ? 'selected' : ''}}>Islam</option>
                    <option value="Kristen" {{$profile[0]->agama === 'Kristen' ? 'selected' : ''}}>Kristen</option>
                    <option value="Hindu" {{$profile[0]->agama === 'Hindu' ? 'selected' : ''}}>Hindu</option>
                    <option value="Buddha" {{$profile[0]->agama === 'Buddha' ? 'selected' : ''}}>Buddha</option>
                    <option value="Katolik" {{$profile[0]->agama === 'Katolik' ? 'selected' : ''}}>Katolik</option>
                    <option value="Kong Hu Chu" {{$profile[0]->agama === 'Kong Hu Chu' ? 'selected' : ''}}>Kong Hu Chu</option>
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label for="golongan_darah">Golongan Darah*</label>
                  <div id="golongan_darah">
                    <label class="radio-inline"><input type="radio" name="golongan_darah" value="A"  {{$profile[0]->golongan_darah === "A" ? 'checked' : ''}} required>A</label>
                    <label class="radio-inline"><input type="radio" name="golongan_darah" value="B"  {{$profile[0]->golongan_darah === "B" ? 'checked' : ''}} required>B</label>
                    <label class="radio-inline"><input type="radio" name="golongan_darah" value="AB" {{$profile[0]->golongan_darah === "AB" ? 'checked' : ''}}  required>AB</label>
                    <label class="radio-inline"><input type="radio" name="golongan_darah" value="O"  {{$profile[0]->golongan_darah === "O" ? 'checked' : ''}} required>O</label>
                  </div>
                </div>

                <div class="form-group col-md-3">
                  <label for="photo">Photo</label>
                  <input type="file" value="{{$profile[0]->photo}}" id="photo" name="photo">
                </div>

                <div class="form-group col-md-3">
                  <label>RW*</label>
                  <select class="form-control" name="id_rw" id="rw-state" required disabled>
                    <option value="">&mdash;Pilih RW Anda&mdash;</option>
                    @foreach ( $rw as $rws)
                      <option value="{{$rws->id}}" {{$profile[0]->list_kelaurga->id_rw === $rws->id ? 'selected' : ''}}>{{$rws->nomor_rw}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label>RT*</label>
                  <select class="form-control" name="id_rt" id="rt-state" value="{{$profile[0]->list_kelaurga->rt->id}}" required disabled>
                    <option value="">&mdash;Pilih RT Anda&mdash;</option>
                    @foreach ( $rt as $rts)
                      <option value="{{$rts->id}}" {{$profile[0]->list_kelaurga->id_rt === $rts->id ? 'selected' : ''}}>{{$rts->nomor_rt}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-8">
                  <label>Alamat*</label>
                  <textarea class="form-control" name="alamat" rows="9" placeholder="Alamat">{{$profile[0]->alamat}}</textarea>
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
      var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
      $('#clear').click(function(e) {
          e.preventDefault();
          sig.signature('clear');
          $("#signature").val('');
      });

      $(document).ready(function() {
        $('#rw-state').change(function(event) {
          var idRw = this.value;
          
          $('#rt-state').html('');

          $.ajax({
            url: "/data-keluarga/fetch-rt",
            type: 'POST',
            dataType: 'json',
            data: {id_rw: idRw, _token:"{{csrf_token() }}"},
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