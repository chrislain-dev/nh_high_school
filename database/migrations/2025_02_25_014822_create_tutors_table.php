<?php

use App\Models\Country;
use Illuminate\Foundation\Auth\User;
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
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->enum('gender', ['male', 'female']);
            $table->enum('type', ['father', 'mother', 'sister', 'brother', 'other']);
            $table->string('slug')->unique();
            $table->string('other_type')->nullable();
            $table->foreignIdFor(User::class)->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('cni')->unique();
            $table->date('cni_expiry_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('address');
            $table->string('profile_image_url')->nullable();
            $table->date('birth_date');
            $table->string('job');
            $table->foreignIdFor(Country::class, 'nationality_id')->nullable()->constrained('countries')->OnDelete('set null'); // Lieu de naissance('birth_place_id');
            $table->date('joining_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
