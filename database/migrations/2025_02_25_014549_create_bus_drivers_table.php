<?php

use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bus_drivers', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['driver', 'helper']);
            $table->enum('status', ['active', 'inactive']);
            $table->enum('gender', ['male', 'female']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->unique(); // Assurez-vous que le slug est unique
            $table->string('email')->unique(); // Unique pour l'email
            $table->string('phone')->nullable(); // Permettre un numéro de téléphone nul
            $table->string('address')->nullable(); // Permettre l'adresse à null si nécessaire
            $table->date('birth_date');
            $table->foreignIdFor(Country::class, 'nationality_id')->constrained('countries')->cascadeOnDelete(); // Nationalité avec contrainte
            $table->foreignIdFor(Country::class, 'birth_place_id')->constrained('countries')->cascadeOnDelete(); // Lieu de naissance avec contrainte
            $table->string('profile_image_url')->nullable(); // Image de profil nullable
            $table->string('cni')->unique(); // Assurez-vous que le CNI est unique
            $table->unsignedBigInteger('salary')->nullable(); // Salaire peut être nul
            $table->timestamps();
            $table->softDeletes(); // Soft deletes pour supprimer logiquement

            // Index pour améliorer la recherche
            $table->index(['email', 'slug', 'phone']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_drivers');
    }
};
