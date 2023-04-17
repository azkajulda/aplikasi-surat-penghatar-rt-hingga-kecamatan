@extends('layouts.dashboard')

@section('page', 'Surat Penghantar')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Sedang Diajukan</a></li>
          <li><a href="#tab_2" data-toggle="tab">Sudah Disetujui</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="table-responsive">
              <table id="table-diajukan" class="table table-bordered table-striped" aria-describedby="table-diajukan">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Permohonan</th>
                    <th>NIK</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>30-01-2023</td>
                    <td>32032131231231</td>
                    <td>Surat Miskin</td>
                    <td>Menunggu ACC</td>
                    <td class="text-center">
                      <a href="">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i>
                          Edit
                        </button>
                      </a>
                      <a href="">
                        <button class="btn btn-danger"><i class="fa fa-trash"></i>
                          Batalkan
                        </button>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>30-01-2023</td>
                    <td>32032131231231</td>
                    <td>Pembuatan SKCK</td>
                    <td>Menunggu ACC</td>
                    <td class="text-center">
                      <a href="">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i>
                          Edit
                        </button>
                      </a>
                      <a href="">
                        <button class="btn btn-danger"><i class="fa fa-trash"></i>
                          Batalkan
                        </button>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>30-01-2023</td>
                    <td>32032131231231</td>
                    <td>Surat Keterangan</td>
                    <td>Menunggu ACC</td>
                    <td class="text-center">
                      <a href="">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i>
                          Edit
                        </button>
                      </a>
                      <a href="">
                        <button class="btn btn-danger"><i class="fa fa-trash"></i>
                          Batalkan
                        </button>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>30-01-2023</td>
                    <td>32032131231231</td>
                    <td>Pembuatan SKCK</td>
                    <td>Menunggu ACC</td>
                    <td class="text-center">
                      <a href="">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i>
                          Edit
                        </button>
                      </a>
                      <a href="">
                        <button class="btn btn-danger"><i class="fa fa-trash"></i>
                          Batalkan
                        </button>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
            <div class="table-responsive">
              <table id="table-disetujui" class="table table-bordered table-striped" aria-describedby="table-diajukan">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Permohonan</th>
                    <th>NIK</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>01-01-2023</td>
                    <td>32032131231231</td>
                    <td>Pembuatan SKCK</td>
                    <td>Approved</td>
                    <td class="text-center" style="width: 100px">
                      <a href="">
                        <button class="btn btn-success"><i class="fa fa-pencil"></i>
                          Cetak
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
                    <td>30-02-2023</td>
                    <td>344444444444</td>
                    <td>Surat Miskin</td>
                    <td>Approved</td>
                    <td class="text-center" style="width: 100px">
                      <a href="">
                        <button class="btn btn-success"><i class="fa fa-pencil"></i>
                          Cetak
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
                    <td>3</td>
                    <td>30-01-2023</td>
                    <td>32032131231231</td>
                    <td>Surat Keterangan</td>
                    <td>Approved</td>
                    <td class="text-center" style="width: 100px">
                      <a href="">
                        <button class="btn btn-success"><i class="fa fa-pencil"></i>
                          Cetak
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
                    <td>4</td>
                    <td>30-01-2023</td>
                    <td>32032131231231</td>
                    <td>Pembuatan SKCK</td>
                    <td>Approved</td>
                    <td class="text-center" style="width: 100px">
                      <a href="">
                        <button class="btn btn-success"><i class="fa fa-pencil"></i>
                          Cetak
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
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_3">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            It has survived not only five centuries, but also the leap into electronic typesetting,
            remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
            sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
            like Aldus PageMaker including versions of Lorem Ipsum.
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>
  </div>
@endsection

@section('js-add-on')
  <script>
    $(function () {
      $('#table-diajukan').DataTable({
        responsive: true
      })
      $('#table-disetujui').DataTable({
        responsive: true
      })
    })
  </script>
@endsection