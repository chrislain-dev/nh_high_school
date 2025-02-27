<?php

namespace App\Http\Controllers;

use App\Models\ClassLevel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassLevelRequest;
use App\Http\Requests\UpdateClassLevelRequest;
use Illuminate\Http\JsonResponse;

class ClassLevelController extends Controller
{
    /**
     * Afficher la liste des niveaux de classe avec pagination.
     */
    public function index(): JsonResponse
    {
        $classLevels = ClassLevel::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des niveaux de classe récupérée avec succès.',
            'data' => $classLevels
        ]);
    }

    /**
     * Créer un nouveau niveau de classe.
     */
    public function store(StoreClassLevelRequest $request): JsonResponse
    {
        $classLevel = ClassLevel::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Niveau de classe créé avec succès.',
            'data' => $classLevel
        ], 201);
    }

    /**
     * Afficher un niveau de classe spécifique.
     */
    public function show(ClassLevel $classLevel): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Niveau de classe trouvé.',
            'data' => $classLevel
        ]);
    }

    /**
     * Mettre à jour un niveau de classe existant.
     */
    public function update(UpdateClassLevelRequest $request, ClassLevel $classLevel): JsonResponse
    {
        $classLevel->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Niveau de classe mis à jour avec succès.',
            'data' => $classLevel
        ]);
    }

    /**
     * Supprimer un niveau de classe (Soft Delete).
     */
    public function destroy(ClassLevel $classLevel): JsonResponse
    {
        $classLevel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Niveau de classe supprimé avec succès.'
        ]);
    }

    /**
     * Liste des niveaux de classe supprimés (Soft Deletes).
     */
    public function trashed(): JsonResponse
    {
        $classLevels = ClassLevel::onlyTrashed()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des niveaux de classe supprimés récupérée avec succès.',
            'data' => $classLevels
        ]);
    }

    /**
     * Restaurer un niveau de classe supprimé.
     */
    public function restore(string $id): JsonResponse
    {
        $classLevel = ClassLevel::onlyTrashed()->findOrFail($id);
        $classLevel->restore();

        return response()->json([
            'success' => true,
            'message' => 'Niveau de classe restauré avec succès.',
            'data' => $classLevel
        ]);
    }

    /**
     * Suppression définitive d'un niveau de classe supprimé.
     */
    public function forceDelete(string $id): JsonResponse
    {
        $classLevel = ClassLevel::onlyTrashed()->findOrFail($id);
        $classLevel->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Niveau de classe supprimé définitivement.'
        ]);
    }
}
