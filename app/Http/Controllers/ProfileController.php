<?php

namespace App\Http\Controllers;

use App\Models\ListKeluarga;
use App\Models\Profile;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $page = 'Profile';
        $profile = Profile::where('id', $id)->get();

        return view('dashboard.profile.detailProfile', compact('page', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Password lama anda salah, silahkan coba lagi!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $page = 'Profile';
        return view('dashboard.profile.updatePassword', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Profile';
        $rw = Rw::all();
        $profile = Profile::where('id', $id)->get();
        $rt = Rt::where('id_rw', $profile[0]->list_kelaurga->rw->id)->get();
        return view('dashboard.profile.editProfile', compact('page', 'rw', 'profile', 'rt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $profile = Profile::findOrFail($id);
            $listKeluarga = ListKeluarga::findOrFail($profile->list_kelaurga->id); 

            
            if($request->ttd){
                $imageParts = explode(";base64,", $request->ttd);
                $imageTypeAux = explode("image/", $imageParts[0]);           
                $imageType = $imageTypeAux[1];
                $imageBase64 = base64_decode($imageParts[1]);
                $fileName = uniqid() . '.'.$imageType;

                Storage::put('public/upload/signature/'.$fileName, $imageBase64);
                $profile->ttd = url(Storage::url('upload/signature/'.$fileName));
            } else {
                $profile->ttd = $profile->ttd;
            }

            $filePhoto = $request->file('photo');
            $path = null;
            if($filePhoto){
                $path = $filePhoto->store('public/upload/photo');
                $profile->photo = url(Storage::url($path));
            } else {
                $profile->photo = $profile->photo;
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
            $profile->update();
            
            $listKeluarga->id_user = Auth::user()->id;
            $listKeluarga->id_rt = $request->id_rt;
            $listKeluarga->id_rw = $request->id_rw;
            $listKeluarga->id_profile = $profile->id;
            $listKeluarga->update();

        } catch (\Throwable $th) {
            return redirect()->route('dataKeluarga')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
        }
        return redirect()->route('dataKeluarga')->with('success','Data Telah Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
