<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Valider les champs reçus
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Chercher l'utilisateur par son email
        $user = User::where('email', $request->email)->first();

        // 3. Vérifier si l'utilisateur existe et si le mot de passe est correct
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants fournis sont incorrects.'],
            ]);
        }

        // 4. Générer et retourner le token Sanctum
        return response()->json([
            'token' => $user->createToken('api-token')->plainTextToken,
            'message' => 'Connexion réussie'
        ]);
    }
}
