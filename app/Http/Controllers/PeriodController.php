<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Http\Requests\StorePeriodRequest;
use App\Http\Requests\UpdatePeriodRequest;
use Illuminate\Http\JsonResponse;

class PeriodController extends Controller
{
    /**
     * Afficher la liste des périodes avec pagination.
     */
    public function index(): JsonResponse
    {
        $periods = Period::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des périodes récupérée avec succès.',
            'data' => $periods
        ]);
    }

    /**
     * Créer une nouvelle période.
     */
    public function store(StorePeriodRequest $request): JsonResponse
    {
        $period = Period::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Période créée avec succès.',
            'data' => $period
        ], 201);
    }

    /**
     * Afficher une période spécifique.
     */
    public function show(Period $period): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Période trouvée.',
            'data' => $period
        ]);
    }

    /**
     * Mettre à jour une période existante.
     */
    public function update(UpdatePeriodRequest $request, Period $period): JsonResponse
    {
        $period->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Période mise à jour avec succès.',
            'data' => $period
        ]);
    }

    /**
     * Supprimer une période.
     */
    public function destroy(Period $period): JsonResponse
    {
        $period->delete();

        return response()->json([
            'success' => true,
            'message' => 'Période supprimée avec succès.'
        ]);
    }
}
