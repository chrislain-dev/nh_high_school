<?php

use App\Models\Period;
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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['absent', 'late'])->default('late');
            $table->text('reason')->nullable();
            $table->date('date');
            $table->time('time');
            $table->foreignIdFor(Student::class)->references('id')->on('students')->onDelete('cascade');
            $table->foreignIdFor(Period::class)->references('id')->on('periods')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
