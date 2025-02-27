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
        Schema::create('school_emails', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->enum('type', ['contact', 'infos', 'other'])->default('contact');
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
        Schema::dropIfExists('school_emails');
    }
};
