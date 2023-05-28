<?php

namespace App\Http\Controllers;

use App\Models\ListKetuaRw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $listProfiles = DB::table('profiles')
        ->select('profiles.id', 'profiles.nama', 'users.id as id_user')
        ->leftJoin('list_keluargas', 'list_keluargas.id_profile', '=', 'profiles.id')
        ->leftJoin('users', 'users.id', '=', 'list_keluargas.id_user')
        ->where('users.role', 'warga')
        ->get();

        return view('dashboard.data-rt-rw.listRw', compact('page', 'listKetuaRW', 'listProfiles'));
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
