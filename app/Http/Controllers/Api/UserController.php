<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // Afficher tous les utilisateurs
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Afficher les détails d'un utilisateur par ID
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        return response()->json($user);
    }

    // Créer un nouvel utilisateur
    public function store(Request $request)
    {
        // Valider les données du formulaire ici

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json($user, 201); // Réponse de succès avec le code 201 (Created)
    }

    // Mettre à jour les informations d'un utilisateur par ID
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire ici

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return response()->json($user);
    }

    // Supprimer un utilisateur par ID
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès']);
    }

    public function updatePassword(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Récupérer l'utilisateur
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        // Vérifier si le mot de passe actuel est correct
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['error' => 'Le mot de passe actuel est incorrect'], 401);
        }

        // Mettre à jour le mot de passe
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json(['message' => 'Mot de passe mis à jour avec succès']);
    }
}
