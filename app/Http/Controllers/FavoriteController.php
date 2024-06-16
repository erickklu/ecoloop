<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entry;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function add($id)
{
    $userId = Auth::id(); // Obtenemos el ID del usuario autenticado

    // Verificamos si ya existe un registro de favorito para esta publicación y usuario
    $favoriteExistente = Favorite::where('user_id', $userId)
        ->where('entry_id', $id)
        ->first();

    if ($favoriteExistente) {
        // Si el favorito ya existe, lo eliminamos
        $favoriteExistente->delete();
    } else {
        // Si el favorito no existe, lo creamos
        Favorite::create([
            'user_id' => $userId,
            'entry_id' => $id
        ]);
    }

    return back();
}
}
