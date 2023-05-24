<?php

namespace App\Http\Controllers;

use App\Models\Kepentingan;
use App\Models\Surat;
use Illuminate\Http\Request;

class KepentinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Kepentingan';
        $kepentingans = Kepentingan::all();
        // dd($kepentingans[1]->surat);

        return view('dashboard.kepentingan', compact('page', 'kepentingans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Kepentingan';
        return view('dashboard.data-kepentingan.addKepentingan', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kepentingan = new Kepentingan();
        try {
            $kepentingan->jenis_kepentingan = $request->jenis_kepentingan;
            $kepentingan->tipe_surat = $request->tipe_surat;
            $kepentingan->keterangan = $request->keterangan;
            $kepentingan->deskripsi = $request->deskripsi;
            $kepentingan->save();
        } catch (\Throwable $th) {
            return redirect()->route('tambahKepentingan')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
        }
        return redirect()->route('kepentingan')->with('success','Data Telah Diajukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kepentingan  $kepentingan
     * @return \Illuminate\Http\Response
     */
    public function show(Kepentingan $kepentingan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kepentingan  $kepentingan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Kepentingan';
        $kepentingan = Kepentingan::where('id', $id)->first();

        return view('dashboard.data-kepentingan.editKepentingan', compact('page', 'kepentingan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kepentingan  $kepentingan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $kepentingan = Kepentingan::findOrFail($id);
            $kepentingan->jenis_kepentingan = $request->jenis_kepentingan;
            $kepentingan->tipe_surat = $request->tipe_surat;
            $kepentingan->keterangan = $request->keterangan;
            $kepentingan->deskripsi = $request->deskripsi;
            $kepentingan->update();
        } catch (\Throwable $th) {
            return redirect()->route('editKepentingan')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
        }
        return redirect()->route('kepentingan')->with('success','Data Telah Diajukan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kepentingan  $kepentingan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $kepentingan = Kepentingan::findOrFail($id);
            $kepentingan->delete();
        } catch (\Throwable $th) {
            return redirect()->route('kepentingan')->with('alert','Terjadi kesalahan, silahkan coba lagi!');
        }
        return redirect()->route('kepentingan')->with('success','Data Telah Terhapus');
        
    }
}
