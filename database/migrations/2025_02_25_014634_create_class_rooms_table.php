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
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Ex: 6ème A, 3ème B, Terminale S
            $table->string('code')->unique(); // Ex: 6A, 3B, TS
            $table->string('description')->nullable();
            $table->unsignedBigInteger('capacity')->default(20);
            $table->unsignedBigInteger('main_teacher_id')->nullable();
            $table->unsignedBigInteger('building_id')->nullable();
            $table->foreignId('class_level_id')->constrained('class_levels')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_rooms');
    }
};
