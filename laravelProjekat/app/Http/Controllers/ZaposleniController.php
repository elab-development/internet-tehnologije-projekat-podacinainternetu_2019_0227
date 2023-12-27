<?php

namespace App\Http\Controllers;

use App\Http\Resources\ZaposleniResource;
use App\Models\User;
use App\Models\Zaposleni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ZaposleniController extends Controller
{
    public function index()  
    {
        $sviZaposleni = User::paginate(5);
        return  ZaposleniResource::collection($sviZaposleni);
    }

    public function store(Request $request)  
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6', 
            'pozicija' => 'required|string|max:255',
            'odeljenje' => 'required|string|max:255',
            'datum_pocetka_rada' => 'required|date',
            'datum_kraja_ugovora' => 'nullable|date',
            'plata' => 'required|numeric',
            'firma_id' => 'required|exists:firmas,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $zaposleni = new User;
        $zaposleni->name = $request->name;
        $zaposleni->email = $request->email;
        $zaposleni->password = Hash::make($request->password); 
        $zaposleni->pozicija = $request->pozicija;
        $zaposleni->odeljenje = $request->odeljenje;
        $zaposleni->datum_pocetka_rada = $request->datum_pocetka_rada;
        $zaposleni->datum_kraja_ugovora = $request->datum_kraja_ugovora;
        $zaposleni->plata = $request->plata;
        $zaposleni->firma_id = $request->firma_id;
        $zaposleni->save();

        return response()->json(['message' => 'Zaposleni uspešno kreiran', 'zaposleni' => $zaposleni], 201);
    }

    public function show($id)  
    {
        $zaposleni = User::find($id);
        if ($zaposleni) {
            return new ZaposleniResource($zaposleni);
        }
        return response()->json(['error' => 'Zaposleni nije pronađen'], 404);
    }

    public function update(Request $request, $id) //PUT
    {
        $zaposleni = User::find($id);
        if ($zaposleni) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'string|min:6',
                'pozicija' => 'required|string|max:255',
                'odeljenje' => 'required|string|max:255',
                'datum_pocetka_rada' => 'required|date',
                'datum_kraja_ugovora' => 'nullable|date',
                'plata' => 'required|numeric',
                'firma_id' => 'required|exists:firmas,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $zaposleni->update($request->all());
            return response()->json(['message' => 'Zaposleni uspešno ažuriran', 'zaposleni' => new ZaposleniResource($zaposleni)], 200);
        } else {
            return response()->json(['error' => 'Zaposleni nije pronađen'], 404);
        }
    }

    public function destroy($id)  
    {
        $zaposleni = User::find($id);
        if ($zaposleni) {
            $zaposleni->delete();
            return response()->json(['message' => 'Zaposleni obrisan'], 200);
        } else {
            return response()->json(['error' => 'Zaposleni nije pronađen'], 404);
        }
    }
}
