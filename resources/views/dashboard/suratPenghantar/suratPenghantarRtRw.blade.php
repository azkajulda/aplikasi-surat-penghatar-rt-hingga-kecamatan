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
                    <p class="title-rt-rw">RT {{$surat[0]->profile->list_kelaurga->rt->nomor_rt}} RW {{$surat[0]->profile->list_kelaurga->rw->nomor_rw}}</p>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2"><hr class="divider-kop-1"><hr class="divider-kop-2"></td>
              </tr>
            </table>
            <table  class="w-full">
              <tr>
                <td class="w-70p"></td>
                <td>
                  <p class="txt-kop-surat">
                    Kepada Yth.
                  </p>
                </td>
              </tr>
              <tr>
                <td class="w-70p"></td>
                <td>
                  <p class="txt-kop-surat">
                    Bp/Ibu Kepala Desa Bulan
                  </p>
                </td>
              </tr>
              <tr>
                <td class="w-70p"></td>
                <td>
                  <p class="txt-kop-surat">
                    Di Tempat
                  </p>
                </td>
              </tr>
              <tr>
                <td  colspan="2">
                  <p class="txt-judul-surat mt-20">SURAT PENGANTAR</p>
                  <p class="txt-kop-surat text-center m-0">Nomor: {{$surat[0]->id}}/{{$surat[0]->profile->list_kelaurga->rt->nomor_rt}}/{{$surat[0]->profile->list_kelaurga->rw->nomor_rw}}/{{date("Y")}}</p>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <p class="txt-kop-surat text-justify my-20">Yang bertanda tangan di bawah ini Ketua RT {{$surat[0]->profile->list_kelaurga->rt->nomor_rt}} RW {{$surat[0]->profile->list_kelaurga->rw->nomor_rw}} Desa Bulan Kecamatan Wonosari Kabupaten Klaten menerangkan bahwa:</p>
                </td>
              </tr>
            </table>
            <table  class="w-95p m-auto">
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">1. Nama</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">{{$surat[0]->profile->nama}}</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">2. Tempat/Tgl Lahir</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">{{$surat[0]->profile->tempat_lahir}}, {{date('d F Y', strtotime($surat[0]->profile->tanggal_lahir))}}</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">3. Kewarganegaraan & Agama</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">Indonesia / {{$surat[0]->profile->agama}}</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">4. Pekerjaan</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">{{$surat[0]->profile->pekerjaan}}</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300" valign="baseline"><p class="txt-kop-surat">5. Tempat Tinggal</p></td>
                <td valign="baseline">: </td>
                <td><p class="txt-kop-surat">{{$surat[0]->profile->alamat}} Rt {{$surat[0]->profile->list_kelaurga->rt->nomor_rt}} Rw {{$surat[0]->profile->list_kelaurga->rw->nomor_rw}}, Desa Bulan Kecamatan Wonosari, Kabupaten Klaten.</p></td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300" valign="baseline"><p class="txt-kop-surat">6. Surat Bukti Diri</p></td>
                <td valign="baseline">: </td>
                <td>
                  <p class="txt-kop-surat">NIK   : {{$surat[0]->profile->no_nik}}</p>
                  <p class="txt-kop-surat">No KK : {{$surat[0]->profile->list_kelaurga->user->no_kk}}</p>
                </td>
              </tr>
              <tr>
                <td></td>
                <td class="w-300"><p class="txt-kop-surat">7. Keperluan</p></td>
                <td>: </td>
                <td><p class="txt-kop-surat">{{$surat[0]->kepentingan->jenis_kepentingan}}</p></td>
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
                <td class="w-40p"><p class="txt-kop-surat text-center">Klaten, {{date('d F Y', strtotime($surat[0]->tanggal_permohonan))}}</p></td>
              </tr>
              <tr>
                <td class="w-40p"></td>
                <td class="w-20p"></td>
                <td class="w-40p"><p class="txt-kop-surat text-center">Pemohon,</p></td>
              </tr>
              <tr>
                <td class="w-40p"></td>
                <td class="w-20p"></td>
                <td class="w-40p text-center"><img src="{{$surat[0]->profile->ttd}}" alt="ttd" width="120"></td>
              </tr>
              <tr>
                <td class="w-40p"></td>
                <td class="w-20p"></td>
                <td class="w-40p"><p class="txt-kop-surat text-center">({{$surat[0]->profile->nama}})</p></td>
              </tr>
              <tr>
                <td class="w-40p"><p class="txt-kop-surat text-center mt-20">Pengurus RW,</p></td>
                <td class="w-20p"></td>
                <td class="w-40p"><p class="txt-kop-surat text-center mt-20">Pengurus RT,</p></td>
              </tr>
              <tr>
                <td class="w-40p text-center"><img src="{{$rw[0]->profile->ttd}}" alt="ttd" width="120"></td>
                <td class="w-20p"></td>
                <td class="w-40p text-center"><img src="{{$rt[0]->profile->ttd}}" alt="ttd" width="120"></td>
              </tr>
              <tr>
                <td class="w-40p"><p class="txt-kop-surat text-center">({{$rw[0]->profile->nama}})</p></td>
                <td class="w-20p"></td>
                <td class="w-40p"><p class="txt-kop-surat text-center">({{$rt[0]->profile->nama}})</p></td>
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