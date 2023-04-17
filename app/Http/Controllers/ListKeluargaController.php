<?php

namespace App\Http\Controllers;

use App\Models\ListKeluarga;
use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('dashboard.dataKeluarga', compact('page'));
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
        $folderPath = public_path('upload/');
        $imageParts = explode(";base64,", $request->ttd);
        $imageTypeAux = explode("image/", $imageParts[0]);           
        $imageType = $imageTypeAux[1];
        $imageBase64 = base64_decode($imageParts[1]);
        $file = $folderPath . uniqid() . '.'.$imageType;

        // file_put_contents($file, $imageBase64);

        $listKeluarga = new ListKeluarga();
        dd($request->all());
        // try {
        //     $listKeluarga->id_user = Auth::user()->id;
        //     $listKeluarga->id_user = Auth::user()->id;
        //     $listKeluarga->id_user = Auth::user()->id;
        //     $listKeluarga->id_user = Auth::user()->id;
        //     $listKeluarga->id_user = Auth::user()->id;
        //     $listKeluarga->id_user = Auth::user()->id;
        //     $listKeluarga->id_user = Auth::user()->id;
        //     $listKeluarga->id_user = Auth::user()->id;
        //     $listKeluarga->id_user = Auth::user()->id;
        //     $listKeluarga->id_user = Auth::user()->id;
        //     $listKeluarga->id_user = Auth::user()->id;
        //     $listKeluarga->id_user = Auth::user()->id;
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
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
    public function destroy(ListKeluarga $listKeluarga)
    {
        //
    }
}
