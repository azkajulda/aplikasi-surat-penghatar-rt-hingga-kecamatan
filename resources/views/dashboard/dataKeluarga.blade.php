@extends('layouts.dashboard')

@section('page', 'Data Keluarga')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box">
        <div class="box-header mb-20">
          <h3 class="box-title">Nomor Kartu Keluarga : {{Auth::user()->no_kk}}</h3>

          <div class="box-tools">
            <a href="{{route('addKeluarga')}}">
              <button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>
                Tambah Anggota Keluarga
              </button>
            </a>
          </div>
        </div>
        <div class="box-body">
          <table id="table-keluarga" class="table table-bordered table-striped" aria-describedby="table-keluarga">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Warga</th>
                <th>Pejerkaan</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Agus Saepuloh</td>
                <td>Buruh Lepas</td>
                <td>Klaten, 20-12-1997</td>
                <td>Kepala Keluarga</td>
                <td class="text-center">
                  <a href="">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i>
                      Edit
                    </button>
                  </a>
                  <a href="">
                    <button class="btn btn-danger"><i class="fa fa-trash"></i>
                      Delete
                    </button>
                  </a>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Maemunah Yori</td>
                <td>Ibu Rumah Tangag</td>
                <td>Klaten, 20-12-1996</td>
                <td>Istri</td>
                <td class="text-center">
                  <a href="">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i>
                      Edit
                    </button>
                  </a>
                  <a href="">
                    <button class="btn btn-danger"><i class="fa fa-trash"></i>
                      Delete
                    </button>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
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