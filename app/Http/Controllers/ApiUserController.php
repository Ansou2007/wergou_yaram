<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiUserController extends Controller
{

    public function inscription(Request $request)
    {
        try {
            $user = new User();
            $user->prenom = $request->prenom;
            $user->nom = $request->nom;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return $this->login($request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "" . $e
            ]);
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
        return response()->json([
            'success' => false,
            'token' => $token,
            Auth::user()
        ]);
    }

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
}
