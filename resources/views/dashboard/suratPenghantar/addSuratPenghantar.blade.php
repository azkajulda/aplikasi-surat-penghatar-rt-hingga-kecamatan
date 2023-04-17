@extends('layouts.dashboard')

@section('page', 'Buat Surat Penghantar')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>
        </div>
        <div class="box-body">
          
        </div>
      </div>
      <!-- nav-tabs-custom -->
    </div>
  </div>
@endsection

@section('js-add-on')
  <script>
    $(function () {
      $('#table-keluarga').DataTable({
        responsive: true
      })
      $('#table-disetujui').DataTable({
        responsive: true
      })
    })
  </script>
@endsection