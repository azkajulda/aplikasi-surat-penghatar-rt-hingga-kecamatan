@extends('layouts.dashboard')

@section('page', 'Ubah Password')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box box-primary">
        <form method="POST" action="{{route('updatePassword')}}" enctype="multipart/form-data">
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
              <div class="col-md-4"></div>
              <div class="col-md-4">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-20">
                    <label for="oldPasswordInput" class="form-label">Password Lama</label>
                    <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                        placeholder="Password Lama">
                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-20">
                    <label for="newPasswordInput" class="form-label">Password Baru</label>
                    <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                        placeholder="Password Baru">
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-20">
                    <label for="confirmNewPasswordInput" class="form-label">Konfirmasi Password Baru</label>
                    <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                        placeholder="Konfirmasi Password Baru">
                </div>
              </div>
              <div class="col-md-4"></div>
            </div>
          </div>

          <div class="box-footer">
            <button class="btn btn-primary btn-lg" type="submit">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection