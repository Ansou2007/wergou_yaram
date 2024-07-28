<?php

namespace App\Http\Controllers;

use App\Models\Garde;
use Illuminate\Http\Request;

class ApiGardeController extends Controller
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
