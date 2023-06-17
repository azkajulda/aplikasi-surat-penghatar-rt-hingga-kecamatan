<?php

namespace App\Http\Controllers;

use App\Models\ListKeluarga;
use App\Models\ListKetuaRt;
use App\Models\ListKetuaRw;
use App\Models\Profile;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ListKetuaRtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Registrasi RT/RW';
        
        return view('dashboard.data-rt-rw.addRtRw', compact('page'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registrasiWarga()
    {
        $page = 'Registrasi Warga';
        $rw = Rw::all();
        
        return view('dashboard.data-warga.addWarga', compact('page', 'rw'));
    }

    public function showListWarga()
    {
        $page = 'List Warga';
        $wargasRaw = '';
        if (Auth::user()->role === 'rt') {
            $wargasRaw = collect(DB::table('users')
            ->leftJoin('list_keluargas', 'list_keluargas.id_user', '=', 'users.id')
            ->leftJoin('profiles', 'profiles.id', '=', 'list_keluargas.id_profile')
            ->select('users.id AS user_id' ,'list_keluargas.id', 'profiles.nama', 'profiles.no_nik', 'users.no_kk')
            ->where('list_keluargas.id_rt', Auth::user()->list_keluarga->id_rt)
            ->get());
        } else {
            $wargasRaw = DB::table('users')
            ->leftJoin('list_keluargas', 'list_keluargas.id_user', '=', 'users.id')
            ->leftJoin('profiles', 'profiles.id', '=', 'list_keluargas.id_profile')
            ->select('users.id AS user_id' ,'list_keluargas.id', 'profiles.nama', 'profiles.no_nik', 'users.no_kk')
            ->where('list_keluargas.id_rw', Auth::user()->list_keluarga->id_rw)
            ->get();
        }
        $wargas = $wargasRaw->unique('no_kk');
        $wargas->values()->all();
        
        return view('dashboard.data-warga.listWarga', compact('page', 'wargas'));
    }

    public function fetchRwValidate(Request $request)
    {
        if ($request->role === 'rt') {
            $data['rws'] = Rw::all();
        } else {
            $data['rws'] = DB::table('rws')
            ->select('rws.id', 'rws.nomor_rw')
            ->LeftJoin('list_ketua_rws', 'list_ketua_rws.id_rw', '=', 'rws.id')
            ->whereNull('list_ketua_rws.id_rw')->get();
        }


        return response()->json($data);
    }

    public function fetchRtValidate(Request $request)
    {
        if ($request->role === 'rt') {
            $data['rts'] =  DB::table('rts')
            ->select('rts.id', 'rts.nomor_rt')
            ->LeftJoin('list_ketua_rts', 'list_ketua_rts.id_rt', '=', 'rts.id')
            ->whereNull('list_ketua_rts.id_rt')
            ->where('rts.id_rw', $request->id_rw)
            ->get();
        } else {
            $data['rts'] = Rt::where('id_rw', $request->id_rw)->orderBy('nomor_rt', 'asc')->get();
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = new User();
        $listKeluarga = new ListKeluarga();
        $profile = new Profile();

        if ($request->ttd) {
            $imageParts = explode(";base64,", $request->ttd);
            $imageTypeAux = explode("image/", $imageParts[0]);           
            $imageType = $imageTypeAux[1];
            $imageBase64 = base64_decode($imageParts[1]);
            $fileName = uniqid() . '.'.$imageType;
            Storage::put('public/upload/signature/'.$fileName, $imageBase64);
            $profile->ttd = url(Storage::url('upload/signature/'.$fileName));
        }

        try {
            if ($request->password !== $request->konfirmPassword){
                return redirect()->route('registrasiRTRW')->with('alert', 'Password dan konfirmasi password tidak sama, silahkan coba lagi');
            }

            $user->no_kk = $request->no_kk;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = "warga";
            $user->save();

            $filePhoto = $request->file('photo');
            $path = null;
            if ($filePhoto){
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
            $profile->golongan_darah = $request->golongan_darah;
            $profile->save();
            
            $listKeluarga->id_user = $user->id;
            $listKeluarga->id_rt = Auth::user()->list_keluarga->id_rt;
            $listKeluarga->id_rw = Auth::user()->list_keluarga->id_rw;
            $listKeluarga->id_profile = $profile->id;
            $listKeluarga->save();

        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('registrasiWarga')->with('alert','Terjadi kesalahan, silahkan coba lagi!.');
        }
        return redirect()->route('listWarga')->with('success','Data Telah Masuk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $listKeluarga = new ListKeluarga();
        $profile = new Profile();
        $listKetuaRT = new ListKetuaRt();
        $listKetuaRW = new ListKetuaRw();

        if ($request->ttd) {
            $imageParts = explode(";base64,", $request->ttd);
            $imageTypeAux = explode("image/", $imageParts[0]);           
            $imageType = $imageTypeAux[1];
            $imageBase64 = base64_decode($imageParts[1]);
            $fileName = uniqid() . '.'.$imageType;
            Storage::put('public/upload/signature/'.$fileName, $imageBase64);
            $profile->ttd = url(Storage::url('upload/signature/'.$fileName));
        }

        try {
            if ($request->password !== $request->konfirmPassword){
                return redirect()->route('registrasiRTRW')->with('alert', 'Password dan konfirmasi password tidak sama, silahkan coba lagi');
            }

            $user->no_kk = $request->no_kk;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->save();

            $filePhoto = $request->file('photo');
            $path = null;
            if ($filePhoto){
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
            $profile->golongan_darah = $request->golongan_darah;
            $profile->save();
            
            $listKeluarga->id_user = $user->id;
            $listKeluarga->id_rt = $request->id_rt;
            $listKeluarga->id_rw = $request->id_rw;
            $listKeluarga->id_profile = $profile->id;
            $listKeluarga->save();

            if ($request->role === 'rt'){
                $listKetuaRT->id_rt = $request->id_rt;
                $listKetuaRT->id_profile = $profile->id;
                $listKetuaRT->save();
            } else {
                $listKetuaRW->id_rw = $request->id_rw;
                $listKetuaRW->id_profile = $profile->id;
                $listKetuaRW->save();
            }

        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('registrasiRTRW')->with('alert','Terjadi kesalahan, silahkan coba lagi!.');
        }
        return redirect()->route('listRw')->with('success','Data Telah Masuk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListKetuaRt  $listKetuaRt
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = 'RT/RW';
        $listKetuaRT = Rt::where('id_rw', $id)->get();
        $listProfiles = DB::table('profiles')
        ->select('profiles.id', 'profiles.nama', 'users.id as id_user')
        ->leftJoin('list_keluargas', 'list_keluargas.id_profile', '=', 'profiles.id')
        ->leftJoin('users', 'users.id', '=', 'list_keluargas.id_user')
        ->where([
            ['users.role', 'warga'],
            ['list_keluargas.id_rw', $id]
        ])->get();
        return view('dashboard.data-rt-rw.listRt', compact('page', 'listKetuaRT', 'listProfiles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListKetuaRt  $listKetuaRt
     * @return \Illuminate\Http\Response
     */
    public function edit(ListKetuaRt $listKetuaRt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListKetuaRt  $listKetuaRt
     * @retur   n \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sliceId = explode('-', $request->id_profile);
        $user = User::findOrFail($sliceId[1]);

        try {
            if ($request->jabatan === 'rt') {
                if (empty($id)) {
                    $listKetuaRT = new ListKetuaRt();
                    $listKetuaRT->id_rt = $request->id_rt_rw;
                    $listKetuaRT->id_profile = $sliceId[0];
                    $listKetuaRT->save();
                } else {
                    $listKetuaRT = ListKetuaRt::findOrFail($id);
                    $listKetuaRT->id_profile = $sliceId[0];
                    $listKetuaRT->update();

                    $userOld = User::findOrFail($request->id_old_rt);
                    $userOld->role = "warga";
                    $userOld->update();    
                }
                $user->role = "rt";
                $user->update();
            } else {
                $listKetuaRW = ListKetuaRw::findOrFail($id);
                $userOld = User::findOrFail($request->id_old_rt);

                $listKetuaRW->id_profile = $sliceId[0];
                $listKetuaRW->update();

                $userOld->role = "warga";
                $userOld->update();    

                $user->role = "rw";
                $user->update();
            }
            return redirect()->route('listRw')->with('success','Data Telah Diubah');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('listRw')->with('alert','Terjadi kesalahan, silahkan coba lagi!.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListKetuaRt  $listKetuaRt
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $listWarga = ListKeluarga::findOrFail($id);
            $listWarga->delete();

            $listProfiles = Profile::findOrFail($listWarga->id_profile);
            $listProfiles->delete();

            $listUser = User::findOrFail($listWarga->id_user);
            $listUser->delete();
        } catch (\Throwable $th) {
            return redirect()->route('listWarga')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
        }
        return redirect()->route('listWarga')->with('success','Data Telah Terhapus');
        

    }

    public function detailWarga($id) {
        $page = 'List Warga';
        $isBack = true;
        $listKeluargas = ListKeluarga::where('id_user', $id)->get();

        return view('dashboard.dataKeluarga', compact('page', 'listKeluargas', 'isBack'));
    }
}
