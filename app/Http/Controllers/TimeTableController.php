<?php

namespace App\Http\Controllers;

use App\Models\TimeTable;
use App\Http\Requests\StoreTimeTableRequest;
use App\Http\Requests\UpdateTimeTableRequest;
use Illuminate\Http\JsonResponse;

class TimeTableController extends Controller
{
    /**
     * Afficher la liste des emplois du temps.
     */
    public function index(): JsonResponse
    {
        $timeTables = TimeTable::all();

        return response()->json([
            'success' => true,
            'message' => 'Liste des emplois du temps récupérée avec succès.',
            'data' => $timeTables
        ]);
    }

    /**
     * Afficher le formulaire pour créer un nouvel emploi du temps.
     */
    public function create(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Formulaire de création d\'emploi du temps récupéré.'
        ]);
    }

    /**
     * Enregistrer un nouvel emploi du temps.
     */
    public function store(StoreTimeTableRequest $request): JsonResponse
    {
        // Validation des données et création de l'emploi du temps
        $validated = $request->validated();

        $timeTable = TimeTable::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Emploi du temps créé avec succès.',
            'data' => $timeTable
        ], 201);
    }

    /**
     * Afficher un emploi du temps spécifique.
     */
    public function show(TimeTable $timeTable): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Emploi du temps trouvé.',
            'data' => $timeTable
        ]);
    }

    /**
     * Afficher le formulaire pour éditer un emploi du temps spécifique.
     */
    public function edit(TimeTable $timeTable): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Formulaire d\'édition d\'emploi du temps récupéré.',
            'data' => $timeTable
        ]);
    }

    /**
     * Mettre à jour un emploi du temps existant.
     */
    public function update(UpdateTimeTableRequest $request, TimeTable $timeTable): JsonResponse
    {
        // Validation des données et mise à jour de l'emploi du temps
        $validated = $request->validated();

        $timeTable->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Emploi du temps mis à jour avec succès.',
            'data' => $timeTable
        ]);
    }

    /**
     * Supprimer un emploi du temps.
     */
    public function destroy(TimeTable $timeTable): JsonResponse
    {
        $timeTable->delete();

        return response()->json([
            'success' => true,
            'message' => 'Emploi du temps supprimé avec succès.'
        ]);
    }
}
