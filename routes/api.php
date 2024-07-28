<?php

use App\Http\Controllers\Api\GardeController;
use App\Http\Controllers\Api\pharmacieController;
use App\Http\Controllers\ApiPharmacieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//--------------PHARMACIE-------------//
Route::controller(ApiPharmacieController::class)->group(function () {
    Route::get('/pharmacies', 'liste_pharmacie')->name('pharmacies');
});
//--------------PHARMACIE GARDE------------//
Route::controller(GardeController::class)->group(function () {
    Route::get('/gardes', 'liste_garde')->name('gardes');
});
