<?php

namespace App\Http\Controllers;

use App\Models\BusDriver;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusDriverRequest;
use App\Http\Requests\UpdateBusDriverRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusDriverController extends Controller
{
    /**
     * Liste des chauffeurs de bus avec pagination.
     */
    public function index(): JsonResponse
    {
        $busDrivers = BusDriver::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des chauffeurs de bus récupérée avec succès.',
            'data' => $busDrivers
        ]);
    }

    /**
     * Création d'un chauffeur de bus.
     */
    public function store(StoreBusDriverRequest $request): JsonResponse
    {
        $busDriver = BusDriver::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Chauffeur de bus créé avec succès.',
            'data' => $busDriver
        ], 201);
    }

    /**
     * Affichage d'un chauffeur de bus spécifique.
     */
    public function show(BusDriver $busDriver): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Chauffeur de bus trouvé.',
            'data' => $busDriver
        ]);
    }

    /**
     * Mise à jour d'un chauffeur de bus.
     */
    public function update(UpdateBusDriverRequest $request, BusDriver $busDriver): JsonResponse
    {
        $busDriver->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Chauffeur de bus mis à jour avec succès.',
            'data' => $busDriver
        ]);
    }

    /**
     * Suppression d'un chauffeur de bus (Soft Delete).
     */
    public function destroy(BusDriver $busDriver): JsonResponse
    {
        $busDriver->delete();

        return response()->json([
            'success' => true,
            'message' => 'Chauffeur de bus supprimé avec succès.',
        ]);
    }

    /**
     * Liste des chauffeurs de bus supprimés (Soft Deletes).
     */
    public function trashed(): JsonResponse
    {
        $busDrivers = BusDriver::onlyTrashed()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des chauffeurs de bus supprimés récupérée avec succès.',
            'data' => $busDrivers
        ]);
    }

    /**
     * Restauration d'un chauffeur de bus supprimé.
     */
    public function restore(string $id): JsonResponse
    {
        $busDriver = BusDriver::onlyTrashed()->findOrFail($id);
        $busDriver->restore();

        return response()->json([
            'success' => true,
            'message' => 'Chauffeur de bus restauré avec succès.',
            'data' => $busDriver
        ]);
    }

    /**
     * Suppression définitive d'un chauffeur de bus.
     */
    public function forceDelete(string $id): JsonResponse
    {
        $busDriver = BusDriver::onlyTrashed()->findOrFail($id);
        $busDriver->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Chauffeur de bus supprimé définitivement.',
        ]);
    }
}
