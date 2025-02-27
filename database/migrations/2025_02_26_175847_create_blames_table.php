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
        Schema::create('blames', function (Blueprint $table) {
            $table->id(); // Identifiant unique du blâme
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // Clé étrangère vers la table `students`
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null'); // Clé étrangère vers la table `teachers`, peut être nulle
            $table->text('reason'); // Raison du blâme (ex: comportement inapproprié, non-respect des règles, etc.)
            $table->date('date_given'); // Date à laquelle le blâme a été attribué
            $table->enum('severity', ['minor', 'major', 'serious'])->default('minor'); // Gravité du blâme (mineur, majeur, sérieux)
            $table->boolean('resolved')->default(false); // Si le blâme a été résolu ou non
            $table->text('notes')->nullable(); // Notes supplémentaires ou commentaires
            $table->timestamps(); // Date de création et de mise à jour du blâme
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blames');
    }
};
