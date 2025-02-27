<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\Student;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Afficher la liste des étudiants.
     */
    public function index(): JsonResponse
    {
        $students = Student::all();

        return response()->json([
            'success' => true,
            'message' => 'Liste des étudiants récupérée avec succès.',
            'data' => $students
        ]);
    }

    /**
     * Afficher le formulaire pour créer un nouvel étudiant.
     */
    public function create(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Formulaire de création d\'étudiant récupéré.'
        ]);
    }

    /**
     * Enregistrer un nouvel étudiant.
    */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        // Validation des données
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            // Création de l'élève
            $student = Student::create($validated);

            // Création de l'utilisateur pour l'élève + envoi de mail & notification
            $userCreated = StoreUserController::store($request->first_name, $request->last_name, $request->email, 'Student');

            if (!$userCreated) {
                throw new Exception('Échec de la création de l’utilisateur.');
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Étudiant créé avec succès.',
                'data' => $student
            ], Response::HTTP_CREATED);

        } catch (Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Afficher un étudiant spécifique.
     */
    public function show(Student $student): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Étudiant trouvé.',
            'data' => $student
        ]);
    }

    /**
     * Afficher le formulaire pour éditer un étudiant spécifique.
     */
    public function edit(Student $student): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Formulaire d\'édition récupéré.',
            'data' => $student
        ]);
    }

    /**
     * Mettre à jour un étudiant existant.
     */
    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        // Validation des données et mise à jour de l'étudiant
        $validated = $request->validated();

        $student->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Étudiant mis à jour avec succès.',
            'data' => $student
        ]);
    }

    /**
     * Supprimer un étudiant spécifique.
     */
    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Étudiant supprimé avec succès.'
        ]);
    }
}
