<?php

namespace App\Http\Controllers;

use App\Models\Firma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FirmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //GET
    {
        $sveFirme = Firma::all();
        return $sveFirme;
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
    public function store(Request $request) //POST
    {
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:255',
            'PIB' => 'required|string|max:12|unique:firmas,PIB',
            'maticniBroj' => 'required|string|max:12|unique:firmas,maticniBroj',
            'adresa' => 'required|string',
            'kontaktTelefon' => 'required|string',
            'email' => 'required|email|unique:firmas,email',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $firma = new Firma;
        $firma->naziv = $request->naziv;
        $firma->PIB = $request->PIB;
        $firma->maticniBroj = $request->maticniBroj;
        $firma->adresa = $request->adresa;
        $firma->kontaktTelefon = $request->kontaktTelefon;
        $firma->email = $request->email;
        $firma->save();
        return response()->json(['message' => 'Firma uspešno kreirana', 'firma' => $firma], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Firma  $firma
     * @return \Illuminate\Http\Response
     */
    public function show($id) //GET
    {
        $f=Firma::find($id);
        if($f){
            return $f;
        }
        return response()->json(['error' => 'Ne postoji ta firma'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Firma  $firma
     * @return \Illuminate\Http\Response
     */
    public function edit(Firma $firma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Firma  $firma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//PUT
    {
        $firma = Firma::find($id);
        if($firma){
            $validator = Validator::make($request->all(), [
                'naziv' => 'required|string|max:255',
                'PIB' => 'required|string|max:12',
                'maticniBroj' => 'required|string|max:12',
                'adresa' => 'required|string',
                'kontaktTelefon' => 'required|string',
                'email' => 'required|email',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            
            $firma->naziv = $request->naziv;
            $firma->PIB = $request->PIB;
            $firma->maticniBroj = $request->maticniBroj;
            $firma->adresa = $request->adresa;
            $firma->kontaktTelefon = $request->kontaktTelefon;
            $firma->email = $request->email;
            $firma->save();
            return response()->json(['message' => 'Firma uspešno azurirana', 'firma' => $firma], 200);
        }else{
            return response()->json(['error' => 'Ne postoji ta firma'], 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Firma  $firma
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //DELETE
    {
        $f = Firma::with('zaposleni','fajlovi')->find($id);
        if($f){
            $f->delete();
            return response()->json(['message' => 'Firma obrisana'], 200);
        }else{
            return response()->json(['error' => 'Ne postoji ta firma'], 404);
        }
      
    }
}
