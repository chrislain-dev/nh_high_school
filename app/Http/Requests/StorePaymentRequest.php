<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $table->foreignIdFor(Student::class)->constrained('students')->cascadeOnDelete();
        //     $table->enum('payment_for', ['register', 'school', 'canteen', 'other'])->default('school');
        //     $table->decimal('amount', 10, 2); // Utilisation de decimal pour les montants
        //     $table->enum('transaction_type', ['cash', 'bank_transfer', 'mobile_money'])->default('cash');
        //     $table->string('transaction_reference')->nullable()->unique(); // Référence unique pour les transactions
        //     $table->timestamp('payment_date')->default(DB::raw('CURRENT_TIMESTAMP')); // Date du paiement
        return [
            'payment_for' => 'required|in:regiter,school,canteen,other',
            'amount' => 'required|decimal',
            'transaction_type' => 'required|in:cash,bank_transfert,mobile_money',
            'transaction_reference' => 'nullable|string',
            'payment_date' => 'required|date'
        ];
    }
}
