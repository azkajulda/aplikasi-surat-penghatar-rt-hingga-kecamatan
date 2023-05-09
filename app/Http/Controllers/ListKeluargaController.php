<?php

namespace App\Http\Controllers;

use App\Models\ListKeluarga;
use App\Models\Profile;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ListKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Keluarga';
        $listKeluargas = ListKeluarga::where('id_user', Auth::user()->id)->get();

        return view('dashboard.dataKeluarga', compact('page', 'listKeluargas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Keluarga';
        $rw = Rw::all();
        return view('dashboard.data-keluarga.addDataKeluarga', compact('page', 'rw'));
    }

    public function fetchRt(Request $request)
    {
        $data['rts'] = Rt::where('id_rw', $request->id_rw)->orderBy('nomor_rt', 'asc')->get();

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
        $imageParts = explode(";base64,", $request->ttd);
        $imageTypeAux = explode("image/", $imageParts[0]);           
        $imageType = $imageTypeAux[1];
        $imageBase64 = base64_decode($imageParts[1]);
        $fileName = uniqid() . '.'.$imageType;

        Storage::put('public/upload/signature/'.$fileName, $imageBase64);

        $listKeluarga = new ListKeluarga();
        $profile = new Profile();
        try {
            $filePhoto = $request->file('photo');
            $path = null;
            if($filePhoto){
                $path = $filePhoto->store('public/upload/photo');
                $profile->photo = url(Storage::url($path));
            }

            $profile->no_nik = $request->no_nik;
            $profile->nama = $request->nama;
            $profile->jenis_kelamin = $request->jenis_kelamin;
            $profile->alamat = $request->alamat;
            $profile->tempat_lahir = $request->tempat_lahir;
            $profile->tanggal_lahir = $request->tanggal_lahir;
            $profile->pendidikan = $request->pendidikan;
            $profile->pekerjaan = $request->pekerjaan;
            $profile->agama = $request->agama;
            $profile->ttd = url(Storage::url('upload/signature/'.$fileName));
            $profile->golongan_darah = $request->golongan_darah;
            $profile->save();
            
            $listKeluarga->id_user = Auth::user()->id;
            $listKeluarga->id_rt = $request->id_rt;
            $listKeluarga->id_rw = $request->id_rw;
            $listKeluarga->id_profile = $profile->id;
            $listKeluarga->save();

        } catch (\Throwable $th) {
            if (Auth::user()->role !== 'warga'){
                return redirect()->route('profile', Auth::user()->list_keluarga->profile?->id ?? 0)->with('alert','Terjadi kesalahan, silahkan coba lagi!.');
            } else {
                return redirect()->route('dataKeluarga')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
            }
        }
        if (Auth::user()->role !== 'warga'){
            return redirect()->route('profile', $profile->id)->with('success','Data Telah Masuk');
        } else {
            return redirect()->route('dataKeluarga')->with('success','Data Telah Masuk');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListKeluarga  $listKeluarga
     * @return \Illuminate\Http\Response
     */
    public function show(ListKeluarga $listKeluarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListKeluarga  $listKeluarga
     * @return \Illuminate\Http\Response
     */
    public function edit(ListKeluarga $listKeluarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListKeluarga  $listKeluarga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListKeluarga $listKeluarga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListKeluarga  $listKeluarga
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $listKeluarga = ListKeluarga::findOrFail($id);
            $listKeluarga->delete();
        } catch (\Throwable $th) {
            return redirect()->route('dataKeluarga')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
        }
        return redirect()->route('dataKeluarga')->with('success','Data Telah Terhapus');
        
    }
}
