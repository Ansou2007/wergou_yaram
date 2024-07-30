<?php

use App\Http\Controllers\Api\GardeController;
use App\Http\Controllers\Api\pharmacieController;
use App\Http\Controllers\ApiGardeController;
use App\Http\Controllers\ApiPharmacieController;
use App\Http\Controllers\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ApiUserController::class)->group(function () {
    Route::get('/liste_utilisateur', 'liste_utilisateur');
});


Route::controller(ApiUserController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/inscription', 'inscription');
    Route::post('/deconnexion', 'deconnexion');
    Route::get('/logout', 'logout');
});

//--------------PHARMACIE-------------//
Route::controller(ApiPharmacieController::class)->group(function () {
    Route::get('/pharmacies', 'liste_pharmacie')->name('pharmacies');
});
//--------------PHARMACIE GARDE------------//
Route::controller(ApiGardeController::class)->group(function () {
    Route::get('/gardes', 'liste_garde')->name('gardes');
});
