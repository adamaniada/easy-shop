<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdatePasswordController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Récupérer l'utilisateur
        $user = User::find(Auth::user()->id);

        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        // Vérifier si le mot de passe actuel est correct
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['error' => 'Le mot de passe actuel est incorrect'], 401);
        }

        // Mettre à jour le mot de passe
        $user->password = bcrypt($request->input('password'));
        $user->update();

        return response()->json(['message' => 'Mot de passe mis à jour avec succès']);
    }
}
