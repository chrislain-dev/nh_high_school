<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Liste des bâtiments avec pagination.
     */
    public function index(): JsonResponse
    {
        $buildings = Building::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des bâtiments récupérée avec succès.',
            'data' => $buildings
        ]);
    }

    /**
     * Création d'un bâtiment.
     */
    public function store(StoreBuildingRequest $request): JsonResponse
    {
        $building = Building::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Bâtiment créé avec succès.',
            'data' => $building
        ], 201);
    }

    /**
     * Affichage d'un bâtiment spécifique.
     */
    public function show(Building $building): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Bâtiment trouvé.',
            'data' => $building
        ]);
    }

    /**
     * Mise à jour d'un bâtiment.
     */
    public function update(UpdateBuildingRequest $request, Building $building): JsonResponse
    {
        $building->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Bâtiment mis à jour avec succès.',
            'data' => $building
        ]);
    }

    /**
     * Suppression d'un bâtiment (Soft Delete).
     */
    public function destroy(Building $building): JsonResponse
    {
        $building->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bâtiment supprimé avec succès.',
        ]);
    }

    /**
     * Récupération des bâtiments supprimés (Soft Deletes).
     */
    public function trashed(): JsonResponse
    {
        $buildings = Building::onlyTrashed()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des bâtiments supprimés récupérée avec succès.',
            'data' => $buildings
        ]);
    }

    /**
     * Restauration d'un bâtiment supprimé.
     */
    public function restore(string $id): JsonResponse
    {
        $building = Building::onlyTrashed()->findOrFail($id);
        $building->restore();

        return response()->json([
            'success' => true,
            'message' => 'Bâtiment restauré avec succès.',
            'data' => $building
        ]);
    }

    /**
     * Suppression définitive d'un bâtiment.
     */
    public function forceDelete(string $id): JsonResponse
    {
        $building = Building::onlyTrashed()->findOrFail($id);
        $building->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Bâtiment supprimé définitivement.',
        ]);
    }
}
