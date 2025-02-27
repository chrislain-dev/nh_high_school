<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcademicYearRequest;
use App\Http\Resources\AcademicYearResource;
use App\Models\AcademicYear;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;

class AcademicYearController extends Controller
{
    /**
     * Afficher toutes les années académiques (y compris les supprimées si `?trashed=true`).
     */
    public function index(): JsonResponse
    {
        $academicYears = request()->has('trashed')
            ? AcademicYear::onlyTrashed()->latest()->get()
            : AcademicYear::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Liste des années académiques récupérée avec succès.',
            'data' => AcademicYearResource::collection($academicYears)
        ], Response::HTTP_OK);
    }

    /**
     * Créer une nouvelle année académique.
     */
    public function store(StoreAcademicYearRequest $request): JsonResponse
    {
        try {
            $academicYear = AcademicYear::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Année académique créée avec succès.',
                'data' => new AcademicYearResource($academicYear)
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Afficher une année académique spécifique.
     */
    public function show($id): JsonResponse
    {
        $academicYear = AcademicYear::withTrashed()->find($id);

        if (!$academicYear) {
            return response()->json([
                'success' => false,
                'message' => 'Année académique non trouvée.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'Détails de l\'année académique.',
            'data' => new AcademicYearResource($academicYear)
        ], Response::HTTP_OK);
    }

    /**
     * Mettre à jour une année académique.
     */
    public function update(StoreAcademicYearRequest $request, $id): JsonResponse
    {
        $academicYear = AcademicYear::find($id);

        if (!$academicYear) {
            return response()->json([
                'success' => false,
                'message' => 'Année académique non trouvée.'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $academicYear->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Année académique mise à jour avec succès.',
                'data' => new AcademicYearResource($academicYear)
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Supprimer une année académique (Soft Delete).
     */
    public function destroy($id): JsonResponse
    {
        $academicYear = AcademicYear::find($id);

        if (!$academicYear) {
            return response()->json([
                'success' => false,
                'message' => 'Année académique non trouvée.'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $academicYear->delete();

            return response()->json([
                'success' => true,
                'message' => 'Année académique supprimée avec succès.'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Restaurer une année académique supprimée (Soft Delete).
     */
    public function restore($id): JsonResponse
    {
        $academicYear = AcademicYear::onlyTrashed()->find($id);

        if (!$academicYear) {
            return response()->json([
                'success' => false,
                'message' => 'Année académique non trouvée ou déjà restaurée.'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $academicYear->restore();

            return response()->json([
                'success' => true,
                'message' => 'Année académique restaurée avec succès.',
                'data' => new AcademicYearResource($academicYear)
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la restauration.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Suppression définitive d'une année académique (Force Delete).
     */
    public function forceDelete($id): JsonResponse
    {
        $academicYear = AcademicYear::onlyTrashed()->find($id);

        if (!$academicYear) {
            return response()->json([
                'success' => false,
                'message' => 'Année académique non trouvée.'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $academicYear->forceDelete();

            return response()->json([
                'success' => true,
                'message' => 'Année académique supprimée définitivement.'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression définitive.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
