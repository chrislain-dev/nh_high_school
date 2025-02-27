<?php

namespace App\Http\Controllers;

use App\Models\Blame;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlameRequest;
use App\Http\Requests\UpdateBlameRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlameController extends Controller
{
    /**
     * Liste des blâmes avec pagination.
     */
    public function index(): JsonResponse
    {
        $blames = Blame::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des blâmes récupérée avec succès.',
            'data' => $blames
        ]);
    }

    /**
     * Création d'un nouveau blâme.
     */
    public function store(StoreBlameRequest $request): JsonResponse
    {
        $blame = Blame::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Blâme créé avec succès.',
            'data' => $blame
        ], 201);
    }

    /**
     * Affichage d'un blâme spécifique.
     */
    public function show(Blame $blame): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Blâme trouvé.',
            'data' => $blame
        ]);
    }

    /**
     * Mise à jour d'un blâme.
     */
    public function update(UpdateBlameRequest $request, Blame $blame): JsonResponse
    {
        $blame->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Blâme mis à jour avec succès.',
            'data' => $blame
        ]);
    }

    /**
     * Suppression d'un blâme (Soft Delete).
     */
    public function destroy(Blame $blame): JsonResponse
    {
        $blame->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blâme supprimé avec succès.',
        ]);
    }

    /**
     * Récupération des blâmes supprimés (Soft Deletes).
     */
    public function trashed(): JsonResponse
    {
        $blames = Blame::onlyTrashed()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des blâmes supprimés récupérée avec succès.',
            'data' => $blames
        ]);
    }

    /**
     * Restauration d'un blâme supprimé.
     */
    public function restore(string $id): JsonResponse
    {
        $blame = Blame::onlyTrashed()->findOrFail($id);
        $blame->restore();

        return response()->json([
            'success' => true,
            'message' => 'Blâme restauré avec succès.',
            'data' => $blame
        ]);
    }

    /**
     * Suppression définitive d'un blâme.
     */
    public function forceDelete(string $id): JsonResponse
    {
        $blame = Blame::onlyTrashed()->findOrFail($id);
        $blame->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Blâme supprimé définitivement.',
        ]);
    }
}
