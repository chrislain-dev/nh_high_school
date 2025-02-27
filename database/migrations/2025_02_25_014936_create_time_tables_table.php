<?php

use App\Models\Building;
use App\Models\ClassRoom;
use App\Models\Period;
use App\Models\Subject;
use App\Models\Teacher;
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
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ClassRoom::class)->references('id')->on('class_rooms')->onDelete('cascade'); // Classe concernée
            $table->foreignIdFor(Period::class)->references('id')->on('periods')->onDelete('cascade'); // Periode concernée
            $table->foreignIdFor(Subject::class)->references('id')->on('subjects')->onDelete('cascade'); // Matière enseignée
            $table->foreignIdFor(Teacher::class)->references('id')->on('teachers')->onDelete('cascade'); // Professeur qui enseigne
            $table->foreignIdFor(Building::class)->references('id')->on('buildings')->onDelete('cascade'); // Professeur qui enseigne
            $table->enum('day', ['monday', 'tuesday', 'wesnesday', 'thursday', 'friday', 'saturday', 'sunday']); // Jour de la semaine (ex: Lundi, Mardi)
            $table->time('started_time'); // Heure de début du cours
            $table->time('ended_time'); // Heure de fin du cours
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_tables');
    }
};
