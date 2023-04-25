@extends('layouts.dashboard')

@section('page', 'Buat Surat Penghantar')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box box-primary">

        <div class="box-header">
          <h3 class="box-title">
            <a href="{{route("dataKeluarga")}}">
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
          <div class="row">

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection