<?php

namespace App\Http\Controllers;

use App\Models\ListKetuaRw;
use Illuminate\Http\Request;

class ListKetuaRwController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'RT/RW';
        $listKetuaRW = ListKetuaRw::orderBy('id_rw', 'asc')->get();

        return view('dashboard.data-rt-rw.listRw', compact('page', 'listKetuaRW'));
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
     * @param  \App\Models\ListKetuaRw  $listKetuaRw
     * @return \Illuminate\Http\Response
     */
    public function show(ListKetuaRw $listKetuaRw)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListKetuaRw  $listKetuaRw
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'RT/RW';

        return view('dashboard.data-rt-rw.editRtRw', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListKetuaRw  $listKetuaRw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListKetuaRw $listKetuaRw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListKetuaRw  $listKetuaRw
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListKetuaRw $listKetuaRw)
    {
        //
    }
}
