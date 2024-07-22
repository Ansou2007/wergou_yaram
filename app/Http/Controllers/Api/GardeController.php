<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Garde;
use Illuminate\Http\Request;

class GardeController extends Controller
{
    public function liste_garde()
    {
        $data = Garde::all();
        return response()->json(
            [
                'message' => 'success',
                'data' => $data
            ],
            200
        );
    }
}
