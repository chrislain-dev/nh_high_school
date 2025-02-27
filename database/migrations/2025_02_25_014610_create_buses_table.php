<?php

use App\Models\BusDriver;
use App\Models\AcademicYear;
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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BusDriver::class)->references('id')->on('bus_drivers')->onDelete('cascade');
            $table->foreignIdFor(AcademicYear::class)->references('id')->on('academic_years')->onDelete('cascade');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('model');
            $table->string('color');
            $table->string('registration_number')->unique();
            $table->string('license_plate')->unique();
            $table->unsignedInteger('capacity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
