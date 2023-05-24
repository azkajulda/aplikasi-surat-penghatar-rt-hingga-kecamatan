<?php

namespace App\Http\Controllers;

use App\Models\Kepentingan;
use App\Models\ListKeluarga;
use App\Models\ListKetuaRt;
use App\Models\ListKetuaRw;
use App\Models\Profile;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Surat';
        $suratPending = Surat::where([
            ['status', 'not like', 'Approved'],
            ['id_user', Auth::user()->id],
            ])->orderBy('tanggal_permohonan', 'asc')->get();
        $suratApproved = Surat::where([
            ['status', 'like', 'Approved'],
            ['id_user', Auth::user()->id],
            ])->orderBy('tanggal_permohonan', 'asc')->get();
        return view('dashboard.suratPenghantar', compact('page', 'suratPending', 'suratApproved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Tambah Surat";
        $listKeluargas = ListKeluarga::where('id_user', Auth::user()->id)->get();
        $kepentingans = Kepentingan::all();
        // dd($listKeluargas);
        return view('dashboard.suratPenghantar.addSuratPenghantar', compact('page', 'listKeluargas', 'kepentingans'));
    }

    public function fetchProfile(Request $request)
    {
        $data['profiles'] = Profile::where('id', $request->id_profile)->get();
        // dd($data);
        return response()->json($data);
    }

    public function fetchBerkas(Request $request)
    {
        $data['kepentingan'] = Kepentingan::where('id', $request->id_kepentingan)->get();
        // dd($data);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $surat = new Surat();
        try {
            if ($request->hasFile('berkas')) {
                $files = $request->file('berkas');
                $berkasArray = array();
                foreach ($files as $file) {
                    $path = $file->store('public/upload/berkas');
                    $linkPath = url(Storage::url($path));
                    $berkasArray[] = $linkPath;
                }   
                
                $surat->id_profile = $request->id_profile;
                $surat->id_user = Auth::user()->id;
                $surat->id_kepentingan = $request->id_kepentingan;
                $surat->status = 'Menunggu ACC RT';
                $surat->tanggal_permohonan = $request->tanggal_permohonan;
                $surat->berkas = json_encode($berkasArray);
                $surat->tipe_berkas = $request->tipe_berkas;
                $surat->save();
            }else {
                return redirect()->route('tambahSuratPenghantar')->with('alert','Silakan masukan berkas sesuai ketentuan!');
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('tambahSuratPenghantar')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
        }
        return redirect()->route('suratPenghantar')->with('success','Data Telah Diajukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function showSuratRTRW($id)
    {
        $page = 'Surat';
        $surat = Surat::where('id', $id)->get();
        $rt = ListKetuaRt::where('id_rt', $surat[0]->profile->list_kelaurga->id_rt)->get();
        $rw = ListKetuaRw::where('id_rw', $surat[0]->profile->list_kelaurga->id_rw)->get();
        
        return view('dashboard.suratPenghantar.suratPenghantarRtRw', compact('page', 'surat', 'rt', 'rw'));
    }

    public function showSuratLurah($id)
    {
        $page = 'Surat';
        $surat = Surat::where('id', $id)->first();
        $lurah = User::where('role', 'like', 'lurah')->first();
        
        return view('dashboard.suratPenghantar.suratKeteranganLurah', compact('page', 'surat', 'lurah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = "Surat";
        $surat = Surat::where('id', $id)->get();

        return view('dashboard.suratPenghantar.editSuratPenghantar', compact('page', 'surat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $surat = Surat::findOrFail($id);
            if ($request->hasFile('berkas')) {
                $files = $request->file('berkas');
                $berkasArray = array();
                foreach ($files as $file) {
                    $path = $file->store('public/upload/berkas');
                    $linkPath = url(Storage::url($path));
                    $berkasArray[] = $linkPath;
                }   
                
                $surat->status = 'Menunggu ACC RT';
                $surat->tanggal_permohonan = $request->tanggal_permohonan;
                $surat->berkas = json_encode($berkasArray);
                $surat->tipe_berkas = $request->tipe_berkas;
                $surat->update();
            }else {
                return redirect()->route('editSuratPenghantar')->with('alert','Silakan masukan berkas sesuai ketentuan!');
            }
            return redirect()->route('suratPenghantar')->with('success','Data Telah Diubah');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('editSuratPenghantar')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {   
            $surat = Surat::findOrFail($id);
            $surat->delete();
        } catch (\Throwable $th) {
            return redirect()->route('suratPenghantar')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
        }
        return redirect()->route('suratPenghantar')->with('success','Surat Telah Dibatalkan');
    }

    public function showPengajuan() 
    {
        $page = 'Surat';
        $conditionStatus = '';
        $conditionJabatan = '';
        $whereCondition = array();

        switch (Auth::user()->role) {
            case 'rt':
                $conditionStatus = 'Menunggu ACC RT';
                $conditionJabatan = Auth::user()->list_keluarga->id_rt;
                array_push($whereCondition, ['id_rt', '=',  $conditionJabatan], ['status', 'like', $conditionStatus]);
                break;

            case 'rw':
                $conditionStatus = 'Menunggu ACC RW';
                $conditionJabatan = Auth::user()->list_keluarga->id_rw;
                array_push($whereCondition, ['id_rw', '=',  $conditionJabatan], ['status', 'like', $conditionStatus]);
                break;
            
            default:
                $conditionStatus = 'Menunggu ACC Lurah';
                array_push($whereCondition, ['status', 'like', $conditionStatus]);
                break;
        }
        
        $suratApproved = Surat::where('status', 'like', 'Approved')->get();
        $suratPengajuan = DB::table('surats')
        ->join('profiles', 'profiles.id', '=', 'surats.id_profile')
        ->join('list_keluargas', 'list_keluargas.id', '=', 'profiles.id')
        ->join('kepentingans', 'kepentingans.id', '=', 'surats.id_kepentingan')
        ->select('surats.id', 'surats.tanggal_permohonan', 'profiles.no_nik', 'kepentingans.jenis_kepentingan', 'surats.status')
        ->where($whereCondition)->get();
        // dd($suratPengajuan, $suratApproved);

        return view('dashboard.dataPengajuan', compact('page', 'suratPengajuan', 'suratApproved'));
    }

    public function detailSurat($id)
    {
        $page = 'Surat';
        $surat = Surat::where('id', $id)->first();

        return view('dashboard.suratPenghantar.detailSuratPenghantar', compact('page', 'surat'));
    }

    public function approveSurat($id)
    {
        try {
            $surat = Surat::findOrFail($id);
            
            switch (Auth::user()->role) {
                case 'rt':
                    $surat->status = 'Menunggu ACC RW';
                    break;

                case 'rw':
                    $surat->status = 'Menunggu ACC Lurah';
                    break;
                
                default:
                    $surat->status = 'Approved';
                    break;
            }

            $surat->update();
            return redirect()->route('dataPengajuan')->with('success','Surat Telah di setujui');
        } catch (\Throwable $th) {
            return redirect()->route('detailSurat')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
        }
    }

    public function tolakSurat(Request $request, $id)
    {
        try {
            $surat = Surat::findOrFail($id);
            
            switch (Auth::user()->role) {
                case 'rt':
                    $surat->status = 'Ditolak RT';
                    break;

                case 'rw':
                    $surat->status = 'Ditolak RW';
                    break;
                
                default:
                    $surat->status = 'Ditolak Lurah';
                    break;
            }

            $surat->keterangan_penolakan = $request->keterangan_penolakan;
            $surat->update();
            return redirect()->route('dataPengajuan')->with('success','Surat Telah di setujui');
        } catch (\Throwable $th) {
            return redirect()->route('detailSurat')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
        }
    }
}
