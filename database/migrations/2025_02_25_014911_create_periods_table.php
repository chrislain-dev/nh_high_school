<?php

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
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nom unique de la période
            $table->string('slug')->unique(); // Slug unique pour l'URL
            $table->string('description')->nullable(); // Description optionnelle
            $table->enum('type', ['semester', 'trimester'])->default('semester'); // Type de la période (semestre/trimestre)

            $table->date('start_date'); // Date de début de la période
            $table->date('end_date'); // Date de fin de la période

            $table->boolean('is_current')->default(false); // Si c'est la période actuelle

            $table->timestamps(); // Colonnes created_at et updated_at
            $table->softDeletes(); // Pour la suppression douce

            // Ajout des index pour amélioration de la performance des requêtes fréquentes
            $table->index(['start_date']);
            $table->index(['end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};
