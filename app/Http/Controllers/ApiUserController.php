<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiUserController extends Controller
{

    public function liste_utilisateur()
    {
        $data = User::all();
        return response()->json($data);
    }

    // Inscription
    public function inscription(Request $request)
    {
        try {
            $user = new User();
            $user->prenom = $request->prenom;
            $user->nom = $request->nom;
            $user->email = $request->email;
            $user->telephone = $request->telephone;
            $user->password = Hash::make($request->password);
            $user->save();
            return $this->login($request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' =>  $e
            ]);
        }
    }

    // Connexion
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            $credentials = $request->only(['email', 'password']);

            //$token = JWTAuth::attempt($credentials);
            if ($token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'user' => Auth::user()
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => "Compte inéxistant"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }


    // profil

    public function profil($id)
    {
    }

    // Refresh Token

    public function refresh()
    {
        return response()->json([
            'success' => true,
            'user' => Auth::user(),
            'token' => Auth::refresh()

        ]);
    }

    // Deconnexion
    public function deconnexion(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success' => true,
                'message' => 'Déconnexion avec succéss'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => true,
            'message' => "Déconnexion avec succéss"
        ]);
    }
}
