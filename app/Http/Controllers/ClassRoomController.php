<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassRoomRequest;
use App\Http\Requests\UpdateClassRoomRequest;
use Illuminate\Http\JsonResponse;

class ClassRoomController extends Controller
{
    /**
     * Afficher la liste des salles de classe avec pagination.
     */
    public function index(): JsonResponse
    {
        $classRooms = ClassRoom::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des salles de classe récupérée avec succès.',
            'data' => $classRooms
        ]);
    }

    /**
     * Créer une nouvelle salle de classe.
     */
    public function store(StoreClassRoomRequest $request): JsonResponse
    {
        $classRoom = ClassRoom::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Salle de classe créée avec succès.',
            'data' => $classRoom
        ], 201);
    }

    /**
     * Afficher une salle de classe spécifique.
     */
    public function show(ClassRoom $classRoom): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Salle de classe trouvée.',
            'data' => $classRoom
        ]);
    }

    /**
     * Mettre à jour une salle de classe existante.
     */
    public function update(UpdateClassRoomRequest $request, ClassRoom $classRoom): JsonResponse
    {
        $classRoom->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Salle de classe mise à jour avec succès.',
            'data' => $classRoom
        ]);
    }

    /**
     * Supprimer une salle de classe.
     */
    public function destroy(ClassRoom $classRoom): JsonResponse
    {
        $classRoom->delete();

        return response()->json([
            'success' => true,
            'message' => 'Salle de classe supprimée avec succès.'
        ]);
    }
}
