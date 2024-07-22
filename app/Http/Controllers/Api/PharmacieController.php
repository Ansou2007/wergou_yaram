<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pharmacie;
use Illuminate\Http\Request;

class PharmacieController extends Controller
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
