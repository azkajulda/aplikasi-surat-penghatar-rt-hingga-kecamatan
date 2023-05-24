@extends('layouts.dashboard')

@section('page', 'Edit Surat Penghantar')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box box-default">
        <form method="POST" action="{{route('updateSuratPenghantar', $surat[0]->id)}}" enctype="multipart/form-data">
          @csrf
          <div class="box-header">
            <h3 class="box-title">
              <a href="{{url()->previous()}}">
                <i class="fa fa-arrow-circle-left"></i> <span>Kembali</span>
              </a>
            </h3>

            <div class="box-tools">
              <a href="{{route('addKeluarga')}}">
                <button class="btn btn-primary btn-lg" type="submit">
                  Simpan
                </button>
              </a>
            </div>
          </div>

          <div class="box-body">
            @if (session('alert'))
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Terjadi Kesalahan</h4>
                {{ session('alert') }}
              </div>
            @endif
            <div class="box box-primary">
              <div class="box-header with-border">
                <h5 class="box-title">ISI FORMULIR DIBAWAH SESUAI DENGAN KETENTUAN</h5>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="form-group col-md-8">
                  <label>Pilih Nama Pengaju*</label>
                  <select class="form-control" name="id_profile" id="profile_state" required disabled>
                    <option value="{{$surat[0]->id_profile}}">{{$surat[0]->profile->nama}}</option>
                  </select>
                </div>
                <div class="form-group col-md-8">
                  <label for="noNikSurat">No Induk Kependudukan*</label>
                  <input type="number" name="no_nik" class="form-control" id="noNikSurat" placeholder="Nomor Induk Kependudukan" value="{{$surat[0]->profile->no_nik}}" required disabled>
                </div>
                <div class="form-group col-md-8">
                  <label>Alamat*</label>
                  <textarea class="form-control" name="alamat" rows="4" placeholder="Alamat" id="alamatSurat" disabled>{{$surat[0]->profile->alamat}}</textarea>
                </div>
                <div class="form-group col-md-8">
                  <label>Keperluan Pembuatan*</label>
                  <select class="form-control" name="id_kepentingan" id="keperluanSurat" required disabled>
                    <option value="{{$surat[0]->id_kepentingan}}">{{$surat[0]->kepentingan->jenis_kepentingan}}</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="tanggal_permohonan">Tanggal Permohonan*</label>
                  <input type="date" name="tanggal_permohonan" class="form-control" id="tanggal_permohonan" value="{{$surat[0]->tanggal_permohonan}}" required>
                </div>
                <div class="form-group col-md-8">
                  <label for="berkas">Lampirkan Berkas*</label>
                  <input type="file" id="berkas" name="berkas[]" accept="image/png, image/jpeg, application/pdf" multiple required>
                  @if ($surat[0]->id_kepentingan === 3)
                    <p class="help-block txt-red">* Unggah File KTP, Kartu Keluarga, dan Akta Cerai / Surat Kematian untuk keterangan Janda/Duda *(.jpg, .png, .pdf)</p>
                  @else
                    <p class="help-block txt-red">* Unggah File KTP dan Kartu Keluarga *(.jpg, .png, .pdf)</p>
                  @endif
                </div>
                <div class="form-group col-md-8">
                  <label for="tipe_berkas">Tipe Surat*</label>
                  <div id="tipe_berkas">
                    <label class="radio-inline"><input type="radio" name="tipe_berkas" value="Mandiri" {{$surat[0]->tipe_berkas === "Mandiri" ? 'checked' : ''}} required>Cetak Mandiri</label>
                    <label class="radio-inline"><input type="radio" name="tipe_berkas" value="Kelurahan" {{$surat[0]->tipe_berkas === "Kelurahan" ? 'checked' : ''}} required>Ambil Di Kelurahan</label>
                    <div id="notes-surat"></div>
                  </div>
                </div>
              </div>  
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('js-add-on')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#keperluanSurat').change(function(event) {
        const idKepentingan = this.value;

        $('#notes-berkas').html('');
        switch (idKepentingan) {
          case "3":
            $('#notes-berkas').append('<p class="help-block txt-red">* Unggah File KTP, Kartu Keluarga, dan Akta Cerai / Surat Kematian untuk keterangan Janda/Duda *(.jpg, .png, .pdf)</p>');
            break;
            
            default:
            $('#notes-berkas').append('<p class="help-block txt-red">* Unggah File KTP dan Kartu Keluarga *(.jpg, .png, .pdf)</p>');
            break;
        }

      });

      $('#profile_state').change(function(event) {
        const idProfile = this.value;

        $.ajax({
          url: "{{route('fetchProfile')}}",
          type: 'POST',
          dataType: 'json',
          data: {id_profile: idProfile, _token:"{{csrf_token() }}"},
          success: function(response){
            $.each(response.profiles,function(index, val){
              $('#noNikSurat').val(val.no_nik);
              $('#alamatSurat').val(val.alamat);
            });
          }
        });
      });
    });
  </script>
@endsection