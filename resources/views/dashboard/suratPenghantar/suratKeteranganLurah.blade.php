@extends('layouts.dashboard')

@section('css-add-on')
    <style>
      @media print {
        body {
          visibility: hidden;
        }
        #printarea {
          visibility: visible;
          /* position: absolute;
          left: 0;
          top: 0; */
        }
      }
    </style> 
@endsection

@section('page', 'Surat Penghantar RT/RW')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="box box-default">
        <div class="box-header">
          <h3 class="box-title">
            <a href="{{url()->previous()}}">
              <i class="fa fa-arrow-circle-left"></i> <span>Kembali</span>
            </a>
          </h3>
        </div>
        
        <div class="box-body">
          <div id="printarea">
            <table  class="w-full" align="center" onload="window.print()">
              <tr>
                <td width="100"><img src="{{asset('./img/LOGO_KABUPATEN_KLATEN.png')}}" alt="logo" class="img-kop-surat"></td>
                <td>
                  <div class="text-center">
                    <p class="title-kop-surat">PEMERINTAH DESA BULAN</p>
                    <p class="title-kop-surat">KECAMATAN WONOSARI</p>
                    <p class="title-rt-rw">DESA BULAN</p>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><hr class="divider-kop-1"><hr class="divider-kop-3"></td>
              </tr>
            </table>
            <table  class="w-full">
              <tr>
                <td><i>No. Kode Desa : 33.10.15.2008</i></td>
              </tr>
              <tr>
                <td  colspan="2">
                  <p class="txt-judul-surat mt-20 text-capitalize">SURAT {{$surat->kepentingan->tipe_surat}}</p>
                  <p class="txt-kop-surat text-center m-0">Nomor: {{$surat->id}}/{{$surat->profile->list_kelaurga->rt->nomor_rt}}/{{$surat->profile->list_kelaurga->rw->nomor_rw}}/{{date("m")}}/{{date("Y")}}</p>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <p class="txt-kop-surat text-justify my-20">Yang bertanda tangan di bawah ini Kepala Desa Bulan:</p>
                </td>
              </tr>
            </table>
            <table  class="w-95p m-auto">
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">Nama</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">{{$lurah->list_keluarga->profile->nama}}</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">Jabatan</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">Kepala Desa Bulan</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">Alamat</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">Padangan Rt 009 Rw 006, Bulan, Wonosari, Klaten</p></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="3"><p class="txt-kop-surat my-20"><b>Memberikan Rekomendasi Kepada:</b></p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">Nama</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">{{$surat->profile->nama}}</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">Tempat/Tgl Lahir</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">{{$surat->profile->tempat_lahir}}, {{date('d F Y', strtotime($surat->profile->tanggal_lahir))}}</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">Kewarganegaraan & Agama</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">Indonesia / {{$surat->profile->agama}}</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">Pekerjaan</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">{{$surat->profile->pekerjaan}}</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300" valign="baseline"><p class="txt-kop-surat">Tempat Tinggal</p></td>
                <td valign="baseline">: </td>
                <td><p class="txt-kop-surat">{{$surat->profile->alamat}} Rt {{$surat->profile->list_kelaurga->rt->nomor_rt}} Rw {{$surat->profile->list_kelaurga->rw->nomor_rw}}, Desa Bulan Kecamatan Wonosari, Kabupaten Klaten.</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300" valign="baseline"><p class="txt-kop-surat">Surat Bukti Diri</p></td>
                <td valign="baseline">: </td>
                <td>
                  <p class="txt-kop-surat">NIK   : {{$surat->profile->no_nik}}</p>
                  <p class="txt-kop-surat">No KK : {{$surat->profile->list_kelaurga->user->no_kk}}</p>
                </td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">Keperluan</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">{{$surat->kepentingan->jenis_kepentingan}}</p></td>
              </tr>
            </table>
            <table  class="w-full">
              <tr>
                <td>
                  <p class="txt-kop-surat text-justify mt-20">Demikan untuk menjadi maklum bagi yang berkepentingan dan dapat dipergunakan sebagaimana mestinya.</p>
                </td>
              </tr>
            </table>
            <table  class="w-full mt-20">
              <tr>
                <td class="w-40p"></td>
                <td class="w-20p"></td>
                <td class="w-40p"><p class="txt-kop-surat text-center">Bulan, {{date('d F Y', strtotime($surat->tanggal_permohonan))}}</p></td>
              </tr>
              <tr>
                <td class="w-40p"><p class="txt-kop-surat text-center mt-20">,</p></td>
                <td class="w-20p"></td>
                <td class="w-40p"><p class="txt-kop-surat text-center mt-20">Kepala Desa Bulan</p></td>
              </tr>
              <tr>
                <td class="w-40p text-center"></td>
                <td class="w-20p"></td>
                <td class="w-40p text-center"><img src="{{$lurah->list_keluarga->profile->ttd}}" alt="ttd" width="120"></td>
              </tr>
              <tr>
                <td class="w-40p"><p class="txt-kop-surat text-center"></p></td>
                <td class="w-20p"></td>
                <td class="w-40p"><p class="txt-kop-surat text-center">({{$lurah->list_keluarga->profile->nama}})</p></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js-add-on')
  <script type="text/javascript">
    window.onload = function() { window.print(); }
  </script>
@endsection