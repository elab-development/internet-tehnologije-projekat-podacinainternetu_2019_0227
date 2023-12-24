<?php

namespace App\Http\Controllers;

use App\Http\Resources\ZaposleniResource;
use App\Models\User;
use App\Models\Zaposleni;
use Illuminate\Http\Request;

class ZaposleniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ZaposleniResource::collection(User::all());
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
     * @param  \App\Models\Zaposleni  $zaposleni
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        return new ZaposleniResource(User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zaposleni  $zaposleni
     * @return \Illuminate\Http\Response
     */
    public function edit(Zaposleni $zaposleni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zaposleni  $zaposleni
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zaposleni $zaposleni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zaposleni  $zaposleni
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zaposleni $zaposleni)
    {
        //
    }
}
