<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;

class AttendanceController extends Controller
{
    /**
     * Afficher toutes les absences/retards (y compris les supprimées si `?trashed=true`).
     */
    public function index(): JsonResponse
    {
        $attendances = request()->has('trashed')
            ? Attendance::onlyTrashed()->latest()->get()
            : Attendance::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Liste des absences/retards récupérée avec succès.',
            'data' => AttendanceResource::collection($attendances)
        ], Response::HTTP_OK);
    }

    /**
     * Créer une nouvelle absence/retard.
     */
    public function store(StoreAttendanceRequest $request): JsonResponse
    {
        try {
            $attendance = Attendance::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Absence/retard créé avec succès.',
                'data' => new AttendanceResource($attendance)
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
     * Afficher une absence/retard spécifique.
     */
    public function show($id): JsonResponse
    {
        $attendance = Attendance::withTrashed()->find($id);

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Absence/retard non trouvé.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'Détails de l\'absence/retard.',
            'data' => new AttendanceResource($attendance)
        ], Response::HTTP_OK);
    }

    /**
     * Mettre à jour une absence/retard.
     */
    public function update(UpdateAttendanceRequest $request, $id): JsonResponse
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Absence/retard non trouvé.'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $attendance->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Absence/retard mis à jour avec succès.',
                'data' => new AttendanceResource($attendance)
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
     * Supprimer une absence/retard (Soft Delete).
     */
    public function destroy($id): JsonResponse
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Absence/retard non trouvé.'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $attendance->delete();

            return response()->json([
                'success' => true,
                'message' => 'Absence/retard supprimé avec succès.'
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
     * Restaurer une absence/retard supprimé (Soft Delete).
     */
    public function restore($id): JsonResponse
    {
        $attendance = Attendance::onlyTrashed()->find($id);

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Absence/retard non trouvé ou déjà restauré.'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $attendance->restore();

            return response()->json([
                'success' => true,
                'message' => 'Absence/retard restauré avec succès.',
                'data' => new AttendanceResource($attendance)
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
     * Suppression définitive d'une absence/retard (Force Delete).
     */
    public function forceDelete($id): JsonResponse
    {
        $attendance = Attendance::onlyTrashed()->find($id);

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Absence/retard non trouvé.'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $attendance->forceDelete();

            return response()->json([
                'success' => true,
                'message' => 'Absence/retard supprimé définitivement.'
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
