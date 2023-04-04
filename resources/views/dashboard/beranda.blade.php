@extends('layouts.dashboard')

@section('page', 'Beranda')

@section('content')
  <div class="row">
    <div class="col-md-4">
      <img class="image-beranda" src="{{asset('./img/online-teaching.png')}}" alt="beranda1">
    </div>
    <div class="col-md-4 text-center">
      <h4>Sugeng Rawuh Riky Aditya</h4>
      <img class="img-logo-beranda" src="{{asset('./img/LOGO_KABUPATEN_KLATEN.png')}}" alt="beranda1">
      <p class="mb-34">Ajukan surat pengantar dengan mudah kapanpun dan dimanapun. klik tombol buat surat dibawah untuk memulai mengajukan surat anda.</p>
      <a href="/surat-penghantar">
        <button type="button" class="btn btn-block btn-primary btn-beranda">Buat Surat</button>
      </a>
    </div>
    <div class="col-md-4">
      <img class="image-beranda" src="{{asset('./img/online-exam.png')}}" alt="beranda1">
    </div>
  </div>
@endsection