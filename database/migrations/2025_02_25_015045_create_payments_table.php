<?php

use App\Models\Student;
use Illuminate\Support\Facades\DB;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->constrained('students')->cascadeOnDelete();
            $table->enum('payment_for', ['register', 'school', 'canteen', 'other'])->default('school');
            $table->decimal('amount', 10, 2); // Utilisation de decimal pour les montants
            $table->enum('transaction_type', ['cash', 'bank_transfer', 'mobile_money'])->default('cash');
            $table->string('transaction_reference')->nullable()->unique(); // Référence unique pour les transactions
            $table->timestamp('payment_date')->default(DB::raw('CURRENT_TIMESTAMP')); // Date du paiement
            $table->timestamps();
            $table->softDeletes();

            // Ajout des index pour amélioration des performances des requêtes
            $table->index(['payment_for']);
            $table->index(['transaction_type']);
            $table->index(['payment_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
