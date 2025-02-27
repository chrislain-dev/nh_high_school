<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;
use Illuminate\Http\JsonResponse;

class ClubController extends Controller
{
    /**
     * Afficher la liste des clubs avec pagination.
     */
    public function index(): JsonResponse
    {
        $clubs = Club::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des clubs récupérée avec succès.',
            'data' => $clubs
        ]);
    }

    /**
     * Créer un nouveau club.
     */
    public function store(StoreClubRequest $request): JsonResponse
    {
        $club = Club::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Club créé avec succès.',
            'data' => $club
        ], 201);
    }

    /**
     * Afficher un club spécifique.
     */
    public function show(Club $club): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Club trouvé.',
            'data' => $club
        ]);
    }

    /**
     * Mettre à jour un club existant.
     */
    public function update(UpdateClubRequest $request, Club $club): JsonResponse
    {
        $club->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Club mis à jour avec succès.',
            'data' => $club
        ]);
    }

    /**
     * Supprimer un club.
     */
    public function destroy(Club $club): JsonResponse
    {
        $club->delete();

        return response()->json([
            'success' => true,
            'message' => 'Club supprimé avec succès.'
        ]);
    }
}
