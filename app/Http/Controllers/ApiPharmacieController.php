<?php

namespace App\Http\Controllers;

use App\Models\Pharmacie;
use Exception;
use Illuminate\Http\Request;

class ApiPharmacieController extends Controller
{
    public function liste_pharmacie()
    {
        $data = Pharmacie::all();
        return response()->json($data);
        /*  return response()->json(
            [
                'message' => 'success',
                'data' => $data
            ],
            200
        ); */
    }

    public function store(Request $request)
    {
        try {
            $pharmacie = new Pharmacie();
            $pharmacie->user_id = $request->user_id;
            $pharmacie->longitude = $request->longitude;
            $pharmacie->latitude = $request->latitude;
            $pharmacie->nom = $request->nom;
            $pharmacie->telephone_portable = $request->telephone_portable;
            $pharmacie->adresse = $request->adresse;
            $pharmacie->save();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Enregistrement avec succéss',
                    'pharmacie' => $pharmacie
                ]
            );
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' =>  $e
            ]);
        }
    }
    public function show($id)
    {
        try {
            $pharmacie = Pharmacie::where('user_id', $id)->first();
            if (!$pharmacie) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pharmacy not found'
                ], 404);
            }
            /* return response()->json([
                'success' => true,
                'pharmacie' => $pharmacie
            ], 200); */
            return response()->json($pharmacie);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur' . $e->getMessage()
            ]);
        }
    }
}
