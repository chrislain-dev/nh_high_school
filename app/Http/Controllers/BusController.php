<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusRequest;
use App\Http\Requests\UpdateBusRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Liste des bus avec pagination.
     */
    public function index(): JsonResponse
    {
        $buses = Bus::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des bus récupérée avec succès.',
            'data' => $buses
        ]);
    }

    /**
     * Création d'un bus.
     */
    public function store(StoreBusRequest $request): JsonResponse
    {
        $bus = Bus::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Bus créé avec succès.',
            'data' => $bus
        ], 201);
    }

    /**
     * Affichage d'un bus spécifique.
     */
    public function show(Bus $bus): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Bus trouvé.',
            'data' => $bus
        ]);
    }

    /**
     * Mise à jour d'un bus.
     */
    public function update(UpdateBusRequest $request, Bus $bus): JsonResponse
    {
        $bus->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Bus mis à jour avec succès.',
            'data' => $bus
        ]);
    }

    /**
     * Suppression d'un bus (Soft Delete).
     */
    public function destroy(Bus $bus): JsonResponse
    {
        $bus->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bus supprimé avec succès.',
        ]);
    }

    /**
     * Liste des bus supprimés (Soft Deletes).
     */
    public function trashed(): JsonResponse
    {
        $buses = Bus::onlyTrashed()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des bus supprimés récupérée avec succès.',
            'data' => $buses
        ]);
    }

    /**
     * Restauration d'un bus supprimé.
     */
    public function restore(string $id): JsonResponse
    {
        $bus = Bus::onlyTrashed()->findOrFail($id);
        $bus->restore();

        return response()->json([
            'success' => true,
            'message' => 'Bus restauré avec succès.',
            'data' => $bus
        ]);
    }

    /**
     * Suppression définitive d'un bus.
     */
    public function forceDelete(string $id): JsonResponse
    {
        $bus = Bus::onlyTrashed()->findOrFail($id);
        $bus->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Bus supprimé définitivement.',
        ]);
    }
}
