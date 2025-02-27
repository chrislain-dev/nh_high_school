<?php

use App\Models\ExamType;
use App\Models\Period;
use App\Models\Student;
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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->references('id')->on('students')->cascadeOnDelete();
            $table->foreignIdFor(Subject::class)->references('id')->on('subjects')->OnDelete('set null');
            $table->foreignIdFor(Period::class)->references('id')->on('periods')->onDelete('cascade');
            $table->foreignIdFor(ExamType::class)->references('id')->on('exam_types')->cascadeOnDelete();
            $table->decimal('score', 5, 2); // Score de l'élève à l'examen (par exemple : 15.50 sur 20)
            $table->decimal('max_score', 5, 2)->default(20);
            $table->string('appreciation')->nullable();
            $table->enum('status', ['passed', 'failed', 'retake'])->default('passed'); // Statut de l'examen (réussi, échoué, à repasser)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
