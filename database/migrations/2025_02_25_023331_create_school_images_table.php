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
        Schema::create('school_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');
            $table->enum('type', ['logo', 'banner', 'other'])->default('logo');
            $table->string('alt')->nullable();
            $table->string('title')->nullable();
            $table->string('type_other')->nullable();
            $table->foreignId('school_id')->constrained('school_settings')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_images');
    }
};
