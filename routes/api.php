<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BlameController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ClassFeeController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\BusDriverController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassLevelController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\SchoolSettingController;

// Public routes
Route::get('/', [PageController::class, '__invoke']);




// Authentification
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});

// Routes protégées (requièrent authentification)
Route::middleware('auth:sanctum')->group(function () {

    // Afficher les informations de l'utilisateur authentifié
    Route::get('/user', [AuthController::class, 'user']);

    // Routes pour gérer les étudiants (seulement pour les admins)
    Route::middleware('role:admin')->group(function () {
        Route::post('/students', [StudentController::class, 'store']); // Créer un étudiant
        Route::get('/students/{student}', [StudentController::class, 'show']); // Afficher un étudiant
        Route::put('/students/{student}', [StudentController::class, 'update']); // Mettre à jour un étudiant
        Route::delete('/students/{student}', [StudentController::class, 'destroy']); // Supprimer un étudiant
    });

    // Routes pour gérer les enseignants (seulement pour les admins)
    Route::middleware('role:admin')->group(function () {
        Route::post('/teachers', [TeacherController::class, 'store']); // Créer un enseignant
        Route::get('/teachers/{teacher}', [TeacherController::class, 'show']); // Afficher un enseignant
        Route::put('/teachers/{teacher}', [TeacherController::class, 'update']); // Mettre à jour un enseignant
        Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy']); // Supprimer un enseignant
    });

    // Routes pour gérer les tuteurs (seulement pour les admins)
    Route::middleware('role:admin')->group(function () {
        Route::post('/tutors', [TutorController::class, 'store']); // Créer un tuteur
        Route::get('/tutors/{tutor}', [TutorController::class, 'show']); // Afficher un tuteur
        Route::put('/tutors/{tutor}', [TutorController::class, 'update']); // Mettre à jour un tuteur
        Route::delete('/tutors/{tutor}', [TutorController::class, 'destroy']); // Supprimer un tuteur
    });

    // Routes pour les absences
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('attendances', AttendanceController::class);
        Route::patch('attendances/{id}/restore', [AttendanceController::class, 'restore']);
        Route::delete('attendances/{id}/force-delete', [AttendanceController::class, 'forceDelete']);
    });

    // Routes pour les années academiques
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('academic-years', AcademicYearController::class);
        Route::patch('academic-years/{id}/restore', [AcademicYearController::class, 'restore']);
        Route::delete('academic-years/{id}/force-delete', [AcademicYearController::class, 'forceDelete']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('buildings', BuildingController::class);

        // Routes pour Soft Deletes
        Route::get('buildings/trashed', [BuildingController::class, 'trashed']);
        Route::patch('buildings/{id}/restore', [BuildingController::class, 'restore']);
        Route::delete('buildings/{id}/force-delete', [BuildingController::class, 'forceDelete']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('buses', BusController::class);

        // Routes pour Soft Deletes
        Route::get('buses/trashed', [BusController::class, 'trashed']);
        Route::patch('buses/{id}/restore', [BusController::class, 'restore']);
        Route::delete('buses/{id}/force-delete', [BusController::class, 'forceDelete']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('bus-drivers', BusDriverController::class);

        // Routes pour Soft Deletes
        Route::get('bus-drivers/trashed', [BusDriverController::class, 'trashed']);
        Route::patch('bus-drivers/{id}/restore', [BusDriverController::class, 'restore']);
        Route::delete('bus-drivers/{id}/force-delete', [BusDriverController::class, 'forceDelete']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('class-fees', ClassFeeController::class);

        // Routes pour Soft Deletes
        Route::get('class-fees/trashed', [ClassFeeController::class, 'trashed']);
        Route::patch('class-fees/{id}/restore', [ClassFeeController::class, 'restore']);
        Route::delete('class-fees/{id}/force-delete', [ClassFeeController::class, 'forceDelete']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('class-levels', ClassLevelController::class);

        // Routes pour Soft Deletes
        Route::get('class-levels/trashed', [ClassLevelController::class, 'trashed']);
        Route::patch('class-levels/{id}/restore', [ClassLevelController::class, 'restore']);
        Route::delete('class-levels/{id}/force-delete', [ClassLevelController::class, 'forceDelete']);
    });

    Route::apiResource('class-rooms', ClassRoomController::class);
    Route::apiResource('clubs', ClubController::class);
    Route::apiResource('countries', CountryController::class);
    Route::apiResource('exam-types', ExamTypeController::class);
    Route::apiResource('notes', NoteController::class);
    Route::apiResource('payments', PaymentController::class);
    Route::apiResource('periods', PeriodController::class);
    Route::apiResource('school-settings', SchoolSettingController::class);

    // Routes pour les blâmes
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('blames', BlameController::class);

        // Routes pour Soft Deletes
        Route::get('blames/trashed', [BlameController::class, 'trashed']);
        Route::patch('blames/{id}/restore', [BlameController::class, 'restore']);
        Route::delete('blames/{id}/force-delete', [BlameController::class, 'forceDelete']);
    });

    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/assign-role', [RoleController::class, 'assignRole']);
});
