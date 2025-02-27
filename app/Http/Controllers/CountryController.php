<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    /**
     * Afficher la liste des pays avec pagination.
     */
    public function index(): JsonResponse
    {
        $countries = Country::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Liste des pays récupérée avec succès.',
            'data' => $countries
        ]);
    }

    /**
     * Créer un nouveau pays.
     */
    public function store(StoreCountryRequest $request): JsonResponse
    {
        $country = Country::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Pays créé avec succès.',
            'data' => $country
        ], 201);
    }

    /**
     * Afficher un pays spécifique.
     */
    public function show(Country $country): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Pays trouvé.',
            'data' => $country
        ]);
    }

    /**
     * Mettre à jour un pays existant.
     */
    public function update(UpdateCountryRequest $request, Country $country): JsonResponse
    {
        $country->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Pays mis à jour avec succès.',
            'data' => $country
        ]);
    }

    /**
     * Supprimer un pays.
     */
    public function destroy(Country $country): JsonResponse
    {
        $country->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pays supprimé avec succès.'
        ]);
    }
}
