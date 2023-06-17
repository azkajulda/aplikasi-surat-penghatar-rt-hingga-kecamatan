@extends('layouts.dashboard')

@section('page', 'Buat Kepentingan Surat')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box box-default">
        <form method="POST" action="{{route('addKepentingan')}}" enctype="multipart/form-data">
          @csrf
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
            @endif
            <div class="box box-primary"></div>
            <div class="box-body">
              <div class="row">
                <div class="form-group col-md-8">
                  <label for="kepentingan">Nama Kepentingan*</label>
                  <input type="text" name="jenis_kepentingan" class="form-control" id="kepentingan" placeholder="Jenis Kepentingan" required>
                </div>
                <div class="form-group col-md-8">
                  <label for="tipe_surat">Tipe Surat*</label>
                  <div id="tipe_surat">
                    <label class="radio-inline"><input type="radio" name="tipe_surat" value="Penghantar" required>Pengantar</label>
                    <label class="radio-inline"><input type="radio" name="tipe_surat" value="Keterangan" required>Keterangan</label>
                  </div>
                </div>
                <div class="form-group col-md-8">
                  <label>Syarat Berkas*</label>
                  <select class="form-control" name="keterangan" required>
                    <option value="">&mdash;Pilih Syarat Berkas&mdash;</option>
                    <option value="KTP">KTP</option>
                    <option value="Kartu Keluarga">Kartu Keluarga</option>
                    <option value="KTP dan Kartu Keluarga">KTP dan Kartu Keluarga</option>
                    <option value="KTP, Kartu Keluarga, Dan Ijazah Terakhir">KTP, Kartu Keluarga, Dan Ijazah Terakhir</option>
                    <option value="KTP, Kartu Keluarga, Izajah terakhir, dan Akta Kelahiran">KTP, Kartu Keluarga, Izajah terakhir, dan Akta Kelahiran</option>
                    <option value="KTP, Kartu Keluarga, dan Surat Pernyataan Kepemilikan Usaha">KTP, Kartu Keluarga, dan Surat Pernyataan Kepemilikan Usaha</option>
                    <option value="KTP, Kartu Keluarga, dan Akta Cerai / Surat Kematian untuk keterangan Janda/Duda">KTP, Kartu Keluarga, dan Akta Cerai / Surat Kematian untuk keterangan Janda/Duda</option>
                    <option value="KTP, Kartu Keluarga, dan Akta Kematian">KTP, Kartu Keluarga, dan Akta Kematian</option>
                    <option value="KTP, Kartu Keluarga, dan Akta Kelahiran">KTP, Kartu Keluarga, dan Akta Kelahiran</option>
                  </select>
                </div>
                <div class="form-group col-md-8">
                  <label>Deskripsi</label>
                  <textarea class="form-control" name="deskripsi" rows="4" placeholder="Deskripsi"></textarea>
                </div>
              </div>  
            </div>
            <div class="box-footer">
              <button class="btn btn-primary btn-lg" type="submit">
                Simpan
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('js-add-on')
  <script type="text/javascript">
    
  </script>
@endsection