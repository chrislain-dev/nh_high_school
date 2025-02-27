<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Http\Requests\StoreTutorRequest;
use App\Http\Requests\UpdateTutorRequest;
use Illuminate\Http\JsonResponse;

class TutorController extends Controller
{
    /**
     * Afficher la liste des tuteurs.
     */
    public function index(): JsonResponse
    {
        $tutors = Tutor::all();

        return response()->json([
            'success' => true,
            'message' => 'Liste des tuteurs récupérée avec succès.',
            'data' => $tutors
        ]);
    }

    /**
     * Afficher le formulaire pour créer un nouveau tuteur.
     */
    public function create(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Formulaire de création de tuteur récupéré.'
        ]);
    }

    /**
     * Enregistrer un nouveau tuteur.
     */
    public function store(StoreTutorRequest $request): JsonResponse
    {
        // Validation des données et création du tuteur
        $validated = $request->validated();

        $tutor = Tutor::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tuteur créé avec succès.',
            'data' => $tutor
        ], 201);
    }

    /**
     * Afficher un tuteur spécifique.
     */
    public function show(Tutor $tutor): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Tuteur trouvé.',
            'data' => $tutor
        ]);
    }

    /**
     * Afficher le formulaire pour éditer un tuteur spécifique.
     */
    public function edit(Tutor $tutor): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Formulaire d\'édition de tuteur récupéré.',
            'data' => $tutor
        ]);
    }

    /**
     * Mettre à jour un tuteur existant.
     */
    public function update(UpdateTutorRequest $request, Tutor $tutor): JsonResponse
    {
        // Validation des données et mise à jour du tuteur
        $validated = $request->validated();

        $tutor->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tuteur mis à jour avec succès.',
            'data' => $tutor
        ]);
    }

    /**
     * Supprimer un tuteur.
     */
    public function destroy(Tutor $tutor): JsonResponse
    {
        $tutor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tuteur supprimé avec succès.'
        ]);
    }
}
