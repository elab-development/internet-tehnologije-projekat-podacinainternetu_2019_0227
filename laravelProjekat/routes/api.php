<?php

use App\Http\Controllers\FirmaController;
use App\Http\Controllers\ZaposleniController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//  Route::get('/firme',[FirmaController::class,'index']);
//  Route::get('/firme/{id}',[FirmaController::class,'show']);

//  Route::delete('/firme/{id}',[FirmaController::class,'destroy']);

//  Route::post('/firme',[FirmaController::class,'store']);
//  Route::put('/firme/{id}',[FirmaController::class,'update']);


 Route::resource('/firme',FirmaController::class);
 
 Route::resource('/zaposleni',ZaposleniController::class);

 

