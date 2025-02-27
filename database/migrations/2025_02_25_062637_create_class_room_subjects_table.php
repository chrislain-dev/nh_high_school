<?php

use App\Models\Subject;
use App\Models\ClassRoom;
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
        Schema::create('class_room_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ClassRoom::class)->references('id')->on('class_rooms')->onDelete('cascade');
            $table->foreignIdFor(Subject::class)->references('id')->on('subjects')->onDelete('cascade');
            $table->unsignedSmallInteger('coefficient')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_lass_room_subjects');
    }
};
