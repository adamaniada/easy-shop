<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UpdateProfileController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Valider les données du formulaire
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Récupérer l'utilisateur
        $user = User::find(Auth::user()->id);

        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        // Mettre à jour
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return response()->json(['message' => 'Profile mis à jour avec succès']);
    }
}
