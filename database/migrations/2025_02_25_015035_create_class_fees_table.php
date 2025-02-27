<?php

use App\Models\ClassRoom;
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
        Schema::create('class_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ClassRoom::class)->constrained('class_rooms')->cascadeOnDelete(); // Relation avec ClassRoom
            $table->decimal('register_fees', 10, 2); // Utilisation de 'decimal' pour les frais
            $table->decimal('school_fees', 10, 2);
            $table->decimal('canteen_fees', 10, 2);
            $table->decimal('bus_fees', 10, 2);
            $table->decimal('other_fees', 10, 2);
            $table->string('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Index pour améliorer les performances des requêtes
            $table->index('class_room_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_fees');
    }
};
