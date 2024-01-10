<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FirmaController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ZaposleniController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FajlController;
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

Route::resource('/firme',FirmaController::class);

Route::get('/firme',[FirmaController::class,'index']);
Route::get('/firme/{id}',[FirmaController::class,'show']);


Route::post('/register', [AuthController::class, 'register']); 
Route::post('/login', [AuthController::class, 'login']); 

Route::resource('/task',TaskController::class);


 //Route::resource('/firme',FirmaController::class);
 
 Route::resource('/zaposleni',ZaposleniController::class)->only(['index','show']);


 Route::middleware('auth:sanctum')->resource('/zaposleni',ZaposleniController::class)->except(['index','show']);



//  Route::middleware('auth:sanctum')->delete('/firme/{id}',[FirmaController::class,'destroy']);
//  Route::middleware('auth:sanctum')->post('/firme',[FirmaController::class,'store']);
//  Route::middleware('auth:sanctum')->put('/firme/{id}',[FirmaController::class,'update']);

 Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

 Route::middleware('auth:sanctum')->get('/fajlovi', [FajlController::class, 'index']); 
 Route::middleware('auth:sanctum')-> post('/fajlovi/upload', [FajlController::class, 'upload']); 
 Route::middleware('auth:sanctum')->delete('/fajlovi/delete/{fileId}', [FajlController::class, 'destroy']);
 
 
 //Route::get('/fajlovi/download', [FajlController::class, 'download']);
 ///Route::put('/fajlovi/update/{fileId}', [FajlController::class, 'update']);