<?php

namespace App\Http\Controllers;

use App\Models\Kepentingan;
use App\Models\ListKeluarga;
use App\Models\ListKetuaRt;
use App\Models\ListKetuaRw;
use App\Models\Profile;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

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
    public function show($id)
    {
        $page = 'Surat';
        $surat = Surat::where('id', $id)->get();
        $rt = ListKetuaRt::where('id_rt', $surat[0]->profile->list_kelaurga->id_rt)->get();
        $rw = ListKetuaRw::where('id_rw', $surat[0]->profile->list_kelaurga->id_rw)->get();
        
        return view('dashboard.suratPenghantar.suratPenghantarRtRw', compact('page', 'surat', 'rt', 'rw'));
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
}
