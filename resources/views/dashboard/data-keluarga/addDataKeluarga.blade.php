@extends('layouts.dashboard')

@section('css-add-on')
    <link rel="stylesheet" href="{{asset('./dashboard-asset/bower_components/signature/css/jquery.signature.css')}}">
    <style>
      .kbw-signature { width: 100%; height: 195px;}
      #sig canvas{ width: 100% !important; height: auto;}
    </style> 
@endsection

@section('page', 'Tambah Anggota Keluarga')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box box-primary">
        <form method="POST" action="{{route('createKeluarga')}}" enctype="multipart/form-data">
          @csrf

          <div class="box-header">
            <h3 class="box-title">
              <a href="{{url()->previous()}}">
                <i class="fa fa-arrow-circle-left"></i> <span>Kembali</span>
              </a>
            </h3>

            <div class="box-tools">
              <button class="btn btn-primary btn-lg" type="submit">
                Simpan
              </button>
            </div>
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
                  <select class="form-control" name="id_rw" id="rw-state" required>
                    <option value="">&mdash;Pilih RW Anda&mdash;</option>
                    @foreach ( $rw as $rws)
                      <option value="{{$rws->id}}">{{$rws->nomor_rw}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label>RT*</label>
                  <select class="form-control" name="id_rt" id="rt-state" required>
                    <option value="">&mdash;Pilih RT Anda&mdash;</option>
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
            url: "{{route('fetchRt')}}",
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