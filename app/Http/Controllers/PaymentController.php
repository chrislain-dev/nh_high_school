<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    /**
     * Afficher la liste des paiements avec pagination.
     */
    public function index(): JsonResponse
    {
        $payments = Payment::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des paiements récupérée avec succès.',
            'data' => $payments
        ]);
    }

    /**
     * Créer un nouveau paiement.
     */
    public function store(StorePaymentRequest $request): JsonResponse
    {
        $payment = Payment::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Paiement créé avec succès.',
            'data' => $payment
        ], 201);
    }

    /**
     * Afficher un paiement spécifique.
     */
    public function show(Payment $payment): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Paiement trouvé.',
            'data' => $payment
        ]);
    }

    /**
     * Mettre à jour un paiement existant.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment): JsonResponse
    {
        $payment->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Paiement mis à jour avec succès.',
            'data' => $payment
        ]);
    }

    /**
     * Supprimer un paiement.
     */
    public function destroy(Payment $payment): JsonResponse
    {
        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Paiement supprimé avec succès.'
        ]);
    }
}
