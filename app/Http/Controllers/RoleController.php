<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // Lister tous les rôles
    public function index()
    {
        return response()->json(Role::all());
    }

    // Assigner un rôle à un utilisateur
    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->assignRole($request->role);

        return response()->json(['message' => 'Rôle assigné avec succès']);
    }
}
