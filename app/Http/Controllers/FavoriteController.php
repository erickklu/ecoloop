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

        if (auth()->check()) {
            $userId = Auth::id();

            $favoriteExistente = Favorite::where('user_id', $userId)
                ->where('entry_id', $id)
                ->first();

            if ($favoriteExistente) {
                $favoriteExistente->delete();
            } else {
                Favorite::create([
                    'user_id' => $userId,
                    'entry_id' => $id
                ]);
            }
            return back();
        } else {

            return redirect()->route('voyager.login');
        }
    }
    public function misFavoritos()
    {
        $usuario = auth()->user();
        $publicacionesFavoritas = $usuario->favoriteEntries()->paginate(6);

        return view('favorites.index', compact('publicacionesFavoritas'));
    }

}
