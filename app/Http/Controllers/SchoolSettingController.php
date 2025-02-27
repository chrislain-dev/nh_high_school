<?php

namespace App\Http\Controllers;

use App\Models\SchoolSetting;  // Assurez-vous que ce modèle existe
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SchoolSettingController extends Controller
{
    /**
     * Afficher la liste des paramètres de l'école.
     */
    public function index(): JsonResponse
    {
        $settings = SchoolSetting::all();

        return response()->json([
            'success' => true,
            'message' => 'Paramètres de l\'école récupérés avec succès.',
            'data' => $settings
        ]);
    }

    /**
     * Créer un nouveau paramètre pour l'école.
     */
    public function store(Request $request): JsonResponse
    {
        // Validation des données
        $validated = $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string',
        ]);

        $setting = SchoolSetting::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Paramètre créé avec succès.',
            'data' => $setting
        ], 201);
    }

    /**
     * Afficher un paramètre spécifique de l'école.
     */
    public function show(string $id): JsonResponse
    {
        $setting = SchoolSetting::find($id);

        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Paramètre non trouvé.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Paramètre trouvé.',
            'data' => $setting
        ]);
    }

    /**
     * Afficher le formulaire d'édition pour un paramètre spécifique.
     */
    public function edit(string $id): JsonResponse
    {
        $setting = SchoolSetting::find($id);

        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Paramètre non trouvé.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Formulaire d\'édition récupéré.',
            'data' => $setting
        ]);
    }

    /**
     * Mettre à jour un paramètre spécifique dans le stockage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $setting = SchoolSetting::find($id);

        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Paramètre non trouvé.'
            ], 404);
        }

        // Validation des données
        $validated = $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string',
        ]);

        $setting->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Paramètre mis à jour avec succès.',
            'data' => $setting
        ]);
    }
}
