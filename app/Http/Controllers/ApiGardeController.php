<?php

namespace App\Http\Controllers;

use App\Models\Garde;
use Illuminate\Http\Request;

class ApiGardeController extends Controller
{
    public function liste_garde()
    {
        try {
            // Récupération des gardes avec leur pharmacie associée
            $gardes = Garde::with('pharmacies')->get();

            // Vérification si des gardes ont été trouvées
            if ($gardes->isEmpty()) {
                return response()->json(['message' => 'Aucune garde trouvée'], 404);
            }

            // Transformation des données pour inclure uniquement les informations nécessaires
            $data = $gardes->map(function ($garde) {
                return [
                    'garde_id' => $garde->id,
                    'pharmacie' => $garde->pharmacies ? [
                        'pharmacie_id' => $garde->pharmacies->id,
                        'nom' => $garde->pharmacies->nom,
                        'telephone' => $garde->pharmacies->telephone_fixe,
                        'adresse' => $garde->pharmacies->adresse,
                    ] : null,
                    'date_debut' => $garde->date_debut,
                    'date_fin' => $garde->date_fin,
                ];
            });
            return response()->json($data);
            /* return response()->json([
                'message' => 'success',
                'data' => $data
            ], 200); */
        } catch (\Exception $e) {
            // Retour d'une erreur serveur en cas d'exception
            return response()->json(['message' => 'Erreur serveur', 'error' => $e->getMessage()], 500);
        }
    }
}
