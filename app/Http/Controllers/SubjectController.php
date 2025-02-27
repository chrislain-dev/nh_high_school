<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller
{
    /**
     * Afficher la liste des matières.
     */
    public function index(): JsonResponse
    {
        $subjects = Subject::all();

        return response()->json([
            'success' => true,
            'message' => 'Liste des matières récupérée avec succès.',
            'data' => $subjects
        ]);
    }

    /**
     * Afficher le formulaire pour créer une nouvelle matière.
     */
    public function create(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Formulaire de création de matière récupéré.'
        ]);
    }

    /**
     * Enregistrer une nouvelle matière.
     */
    public function store(StoreSubjectRequest $request): JsonResponse
    {
        // Validation des données et création de la matière
        $validated = $request->validated();

        $subject = Subject::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Matière créée avec succès.',
            'data' => $subject
        ], 201);
    }

    /**
     * Afficher une matière spécifique.
     */
    public function show(Subject $subject): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Matière trouvée.',
            'data' => $subject
        ]);
    }

    /**
     * Afficher le formulaire pour éditer une matière spécifique.
     */
    public function edit(Subject $subject): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Formulaire d\'édition de matière récupéré.',
            'data' => $subject
        ]);
    }

    /**
     * Mettre à jour une matière existante.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject): JsonResponse
    {
        // Validation des données et mise à jour de la matière
        $validated = $request->validated();

        $subject->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Matière mise à jour avec succès.',
            'data' => $subject
        ]);
    }

    /**
     * Supprimer une matière.
     */
    public function destroy(Subject $subject): JsonResponse
    {
        $subject->delete();

        return response()->json([
            'success' => true,
            'message' => 'Matière supprimée avec succès.'
        ]);
    }
}
