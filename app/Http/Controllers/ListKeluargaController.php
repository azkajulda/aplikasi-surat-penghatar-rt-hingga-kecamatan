<?php

namespace App\Http\Controllers;

use App\Models\ListKeluarga;
use Illuminate\Http\Request;

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
        //
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
