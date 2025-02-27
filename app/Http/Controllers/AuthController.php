<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Connexion et génération du token.
     */
    public function login(Request $request): JsonResponse
    {
        // Validation des données entrantes
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        // Vérifier si l'utilisateur existe
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Identifiants incorrects',
            ], 401);
        }

        // Vérifier le mot de passe
        if (!Hash::check($request->password, $user->password)) {
            // Incrémenter les tentatives de connexion échouées
            $user->increment('failed_logins', 1, [
                'last_failed_login_at' => now(),
                'last_failed_login_ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Email ou mot de passe incorrect',
            ], 401);
        }

        // Réinitialiser les échecs après un succès
        $user->update([
            'failed_logins' => 0,
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        // Créer un token d'authentification
        $token = $user->createToken('NHHighSchool')->plainTextToken;

        // Définir les chemins de redirection en fonction du rôle
        $roleRoutes = [
            'admin' => '/admin/dashboard',
            'super_admin' => '/super_admin/dashboard',
            'teacher' => '/teacher/dashboard',
            'tutor' => '/tutor/dashboard',
            'student' => '/student/dashboard',
        ];

        // Déterminer la route de redirection
        $redirectTo = env('APP_FRONT_URL') . ($roleRoutes[$user->roles()->first()->name] ?? '/student/dashboard');

        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->roles()->first()->name,
                'last_login_at' => $user->last_login_at,
                'last_login_ip' => $user->last_login_ip,
            ],
            'redirect_to' => $redirectTo,
        ], 200);
    }

    /**
     * Déconnexion et suppression des tokens.
     */
    public function logout(Request $request): JsonResponse
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Déconnexion réussie',
        ], 200);
    }

    /**
     * Récupérer les informations de l'utilisateur authentifié.
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'user' => $request->user(),
        ], 200);
    }
}
