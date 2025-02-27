<?php

namespace App\Http\Controllers;

use App\Models\ClassFee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassFeeRequest;
use App\Http\Requests\UpdateClassFeeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassFeeController extends Controller
{
    /**
     * Liste des frais de classe avec pagination.
     */
    public function index(): JsonResponse
    {
        $classFees = ClassFee::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des frais de classe récupérée avec succès.',
            'data' => $classFees
        ]);
    }

    /**
     * Création des frais de classe.
     */
    public function store(StoreClassFeeRequest $request): JsonResponse
    {
        $classFee = ClassFee::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Frais de classe créés avec succès.',
            'data' => $classFee
        ], 201);
    }

    /**
     * Affichage des frais de classe spécifique.
     */
    public function show(ClassFee $classFee): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Frais de classe trouvé.',
            'data' => $classFee
        ]);
    }

    /**
     * Mise à jour des frais de classe.
     */
    public function update(UpdateClassFeeRequest $request, ClassFee $classFee): JsonResponse
    {
        $classFee->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Frais de classe mis à jour avec succès.',
            'data' => $classFee
        ]);
    }

    /**
     * Suppression des frais de classe (Soft Delete).
     */
    public function destroy(ClassFee $classFee): JsonResponse
    {
        $classFee->delete();

        return response()->json([
            'success' => true,
            'message' => 'Frais de classe supprimés avec succès.'
        ]);
    }

    /**
     * Liste des frais de classe supprimés (Soft Deletes).
     */
    public function trashed(): JsonResponse
    {
        $classFees = ClassFee::onlyTrashed()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des frais de classe supprimés récupérée avec succès.',
            'data' => $classFees
        ]);
    }

    /**
     * Restauration des frais de classe supprimés.
     */
    public function restore(string $id): JsonResponse
    {
        $classFee = ClassFee::onlyTrashed()->findOrFail($id);
        $classFee->restore();

        return response()->json([
            'success' => true,
            'message' => 'Frais de classe restaurés avec succès.',
            'data' => $classFee
        ]);
    }

    /**
     * Suppression définitive des frais de classe.
     */
    public function forceDelete(string $id): JsonResponse
    {
        $classFee = ClassFee::onlyTrashed()->findOrFail($id);
        $classFee->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Frais de classe supprimés définitivement.'
        ]);
    }
}
