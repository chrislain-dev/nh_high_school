<?php

use App\Models\ClassRoom;
use App\Models\Club;
use App\Models\Country;
use Illuminate\Foundation\Auth\User;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers `users` pour associer un utilisateur (probablement pour une relation 1:1 avec l'utilisateur)
            $table->foreignIdFor(User::class)->references('id')->on('users')->onDelete('cascade');

            // Clé étrangère vers `class_rooms` pour associer une salle de classe
            $table->foreignIdFor(ClassRoom::class)->references('id')->on('class_rooms')->onDelete('cascade');

            // Informations de l'étudiant
            $table->enum('gender', ['male', 'female']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique(); // Email unique
            $table->string('phone_number')->nullable()->unique(); // Numéro de téléphone (facultatif et unique)
            $table->string('address')->nullable(); // Adresse (facultatif)
            $table->string('cni')->unique(); // CNI (Carte Nationale d'Identité), unique
            $table->string('matricule')->unique(); // Matricule unique
            $table->date('birth_date'); // Date de naissance

            // Informations supplémentaires
            $table->string('medical_condition')->nullable(); // Condition médicale spécifique, allergies, etc.
            $table->string('social_security_number')->nullable(); // Numéro de sécurité sociale
            $table->date('cni_expiry_date')->nullable(); // Date d'expiration du CNI
            $table->date('graduation_date')->nullable(); // Date de fin des études ou de diplôme
            $table->string('previous_school')->nullable(); // Dernier établissement scolaire fréquenté
            $table->boolean('canteen_status')->default(false); //

            // Autres
            $table->date('date_of_admission')->nullable(); // Date d'admission
            $table->string('religion')->nullable(); // Religion de l'élève
            $table->enum('scholarship_status', ['yes', 'no'])->default('no'); // Bourse d'études
            $table->string('performance_grade')->nullable(); // Performance académique
            $table->foreignIdFor(Club::class, 'club_id')->nullable()->constrained('clubs')->onDelete('set null'); // Club de l'élève (facultatif)'extra_curricular_activities')->nullable(); // Activités extra-scolaires
            $table->boolean('is_boarder')->default(false); // Si l'élève est interne
            $table->boolean('has_medical_insurance')->default(false); // Assurance médicale
            $table->string('special_needs')->nullable(); // Besoins spéciaux

            // Colonnes pour la cantine et le transport
            $table->boolean('is_enabled_for_canteen')->default(false); // Autorisation d'utiliser la cantine (false par défaut)
            $table->boolean('is_enabled_for_transport')->default(false); // Autorisation d'utiliser le transport scolaire (false par défaut)

            // Clé étrangère pour relier à la table `buses` si l'élève utilise le transport scolaire
            $table->foreignId('bus_id')->nullable()->constrained('buses')->onDelete('set null'); // Relie à la table `buses`, nullable si le transport n'est pas activé

            // Lien avec la nationalité (référence à la table `countries`)
            $table->foreignIdFor(Country::class, 'nationality_id')->nullable()->constrained('countries')->onDelete('set null');

            // Lien avec le pays de naissance (référence à la table `countries`)
            $table->foreignIdFor(Country::class, 'place_of_birth_id')->nullable()->constrained('countries')->onDelete('set null'); // Lieu de naissance()->cascadeOnDelete();

            // Image de profil (facultatif)
            $table->string('profile_image_url')->nullable();

            // Date d'entrée de l'élève dans l'établissement
            $table->date('joining_date');

            // Statut de l'étudiant (actif, inactif ou diplômé)
            $table->enum('status', ['active', 'inactive', 'graduated'])->default('active');

            // Clé étrangère vers la classe d'entrée (référence à la table `class_rooms`)
            $table->foreignIdFor(ClassRoom::class, 'joining_class_id')->references('id')->on('class_rooms')->onDelete('cascade'); // Classe d'entrée()->onDelete('cascade');

            // Timestamps de création et mise à jour
            $table->timestamps();

            // Soft deletes pour gérer la suppression en douceur
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
