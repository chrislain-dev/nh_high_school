<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Http\JsonResponse;

class TeacherController extends Controller
{
    /**
     * Afficher la liste des enseignants.
     */
    public function index(): JsonResponse
    {
        $teachers = Teacher::all();

        return response()->json([
            'success' => true,
            'message' => 'Liste des enseignants récupérée avec succès.',
            'data' => $teachers
        ]);
    }

    /**
     * Afficher le formulaire pour créer un nouvel enseignant.
     */
    public function create(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Formulaire de création d\'enseignant récupéré.'
        ]);
    }

    /**
     * Enregistrer un nouvel enseignant.
     */
    public function store(StoreTeacherRequest $request): JsonResponse
    {
        // Validation des données et création de l'enseignant
        $validated = $request->validated();

        $teacher = Teacher::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Enseignant créé avec succès.',
            'data' => $teacher
        ], 201);
    }

    /**
     * Afficher un enseignant spécifique.
     */
    public function show(Teacher $teacher): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Enseignant trouvé.',
            'data' => $teacher
        ]);
    }

    /**
     * Afficher le formulaire pour éditer un enseignant spécifique.
     */
    public function edit(Teacher $teacher): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Formulaire d\'édition d\'enseignant récupéré.',
            'data' => $teacher
        ]);
    }

    /**
     * Mettre à jour un enseignant existant.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher): JsonResponse
    {
        // Validation des données et mise à jour de l'enseignant
        $validated = $request->validated();

        $teacher->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Enseignant mis à jour avec succès.',
            'data' => $teacher
        ]);
    }

    /**
     * Supprimer un enseignant.
     */
    public function destroy(Teacher $teacher): JsonResponse
    {
        $teacher->delete();

        return response()->json([
            'success' => true,
            'message' => 'Enseignant supprimé avec succès.'
        ]);
    }
}
