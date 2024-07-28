<?php

namespace App\Http\Controllers;

use App\Models\Pharmacie;
use Illuminate\Http\Request;

class ApiPharmacieController extends Controller
{
    public function liste_pharmacie()
    {
        $data = Pharmacie::all();
        return response()->json(
            [
                'message' => 'success',
                'data' => $data
            ],
            200
        );
    }
}
