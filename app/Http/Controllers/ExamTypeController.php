<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use App\Http\Requests\StoreExamTypeRequest;
use App\Http\Requests\UpdateExamTypeRequest;
use Illuminate\Http\JsonResponse;

class ExamTypeController extends Controller
{
    /**
     * Afficher la liste des types d'examen avec pagination.
     */
    public function index(): JsonResponse
    {
        $examTypes = ExamType::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des types d\'examen récupérée avec succès.',
            'data' => $examTypes
        ]);
    }

    /**
     * Créer un nouveau type d'examen.
     */
    public function store(StoreExamTypeRequest $request): JsonResponse
    {
        $examType = ExamType::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Type d\'examen créé avec succès.',
            'data' => $examType
        ], 201);
    }

    /**
     * Afficher un type d'examen spécifique.
     */
    public function show(ExamType $examType): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Type d\'examen trouvé.',
            'data' => $examType
        ]);
    }

    /**
     * Mettre à jour un type d'examen existant.
     */
    public function update(UpdateExamTypeRequest $request, ExamType $examType): JsonResponse
    {
        $examType->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Type d\'examen mis à jour avec succès.',
            'data' => $examType
        ]);
    }

    /**
     * Supprimer un type d'examen.
     */
    public function destroy(ExamType $examType): JsonResponse
    {
        $examType->delete();

        return response()->json([
            'success' => true,
            'message' => 'Type d\'examen supprimé avec succès.'
        ]);
    }
}
