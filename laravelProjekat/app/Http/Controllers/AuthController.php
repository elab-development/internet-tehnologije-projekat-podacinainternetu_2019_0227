<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ], [
            'name.required' => 'Polje za ime je obavezno.',
            'name.max' => 'Ime ne sme biti duže od 255 karaktera.',
            'email.required' => 'Polje za email je obavezno.',
            'email.email' => 'Unesite ispravnu email adresu.',
            'email.max' => 'Email adresa ne sme biti duža od 255 karaktera.',
            'email.unique' => 'Ova email adresa već postoji.',
            'password.required' => 'Polje za lozinku je obavezno.',
            'password.min' => 'Lozinka mora imati najmanje 6 karaktera.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $validatedData = $validator->validated();
    
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json(['access_token' => $token, 'token_type' => 'Bearer', 'user' => $user]);
    }
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Polje za email je obavezno.',
            'email.email' => 'Unesite ispravnu email adresu.',
            'password.required' => 'Polje za lozinku je obavezno.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Neuspešna prijava. Proverite email i lozinku.'], 401);
        }
    
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json(['access_token' => $token, 'token_type' => 'Bearer', 'user' => $user]);
    }
    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
    


}
