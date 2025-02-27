<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\JsonResponse;

class NoteController extends Controller
{
    /**
     * Afficher la liste des notes avec pagination.
     */
    public function index(): JsonResponse
    {
        $notes = Note::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des notes récupérée avec succès.',
            'data' => $notes
        ]);
    }

    /**
     * Créer une nouvelle note.
     */
    public function store(StoreNoteRequest $request): JsonResponse
    {
        $note = Note::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Note créée avec succès.',
            'data' => $note
        ], 201);
    }

    /**
     * Afficher une note spécifique.
     */
    public function show(Note $note): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Note trouvée.',
            'data' => $note
        ]);
    }

    /**
     * Mettre à jour une note existante.
     */
    public function update(UpdateNoteRequest $request, Note $note): JsonResponse
    {
        $note->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Note mise à jour avec succès.',
            'data' => $note
        ]);
    }

    /**
     * Supprimer une note.
     */
    public function destroy(Note $note): JsonResponse
    {
        $note->delete();

        return response()->json([
            'success' => true,
            'message' => 'Note supprimée avec succès.'
        ]);
    }
}
