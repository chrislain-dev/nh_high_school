<?php

use App\Models\Tutor;
use App\Models\Student;
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
        Schema::create('student_tutors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->references('id')->on('students')->onDelete('cascade');
            $table->foreignIdFor(Tutor::class)->references('id')->on('tutors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_tutors');
    }
};
