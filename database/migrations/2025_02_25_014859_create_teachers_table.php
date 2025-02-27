<?php

use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // Identifiant unique pour chaque enseignant
            $table->string('first_name'); // Nom de l'enseignant
            $table->string('last_name'); // Prénom de l'enseignant
            $table->string('email')->unique(); // Email de l'enseignant
            $table->string('phone_number')->nullable(); // Numéro de téléphone de l'enseignant
            $table->string('cni');
            $table->date('birth_date')->nullable(); // Date de naissance
            $table->enum('gender', ['male', 'female']); // Sexe ("M" ou "F")
            $table->string('address')->nullable(); // Adresse de l'enseignant
            $table->string('speciality')->nullable(); // Spécialité de l'enseignant (ex: Mathématiques, Physique, etc.)
            $table->date('hire_date')->nullable(); // Date d’embauche de l'enseignant
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // Si le professeur a un compte utilisateur lié
            $table->string('profile_image_url')->nullable(); // URL de l'image de profil (facultatif)
            $table->string('religion')->nullable();

            // Statut de l'enseignant (actif, en congé, etc.)
            $table->enum('status', ['active', 'inactive'])->default('active'); // Statut de l'enseignant
            $table->enum('marrital_status', ['single', 'fianced', 'married', 'divorced', 'other'])->default('single'); // Statut marital de l'enseignant (facultatif

            // Qualités et formations supplémentaires
            $table->string('qualification')->nullable(); // Qualification académique
            $table->text('biography')->nullable(); // Biographie de l'enseignant (facultatif)

            // Gestion des congés
            $table->boolean('is_on_leave')->default(false); // Si l'enseignant est en congé
            $table->date('leave_start_date')->nullable(); // Date de début du congé
            $table->date('leave_end_date')->nullable(); // Date de fin du congé

            $table->timestamps(); // Colonnes created_at et updated_at
            $table->softDeletes(); // Suppression douce (pour ne pas supprimer définitivement les données)
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
