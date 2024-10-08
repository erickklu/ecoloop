<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Models\User;
use App\Models\Entry;
use App\Models\Rate;

class UserController extends VoyagerBaseController
{
    public function showUser($id)
    {
        $usuario = User::findOrFail($id);

        $rate = auth()->check() ? Rate::where('qualifier', auth()->id())->where('user_id', $id)->first() : null;

        $publicaciones = Entry::where('user_id', $id)->paginate(6);

        $vendidos = Entry::where('user_id', $id)->where('category_id', '3')->where('state', 'NO DISPONIBLE')->count();
        $intercambiados = Entry::where('user_id', $id)->where('category_id', '2')->where('state', 'NO DISPONIBLE')->count();
        $donados = Entry::where('user_id', $id)->where('category_id', '1')->where('state', 'NO DISPONIBLE')->count();

        return view('users.profile', compact('usuario', 'publicaciones', 'rate', 'vendidos', 'intercambiados', 'donados'));
    }

    public function calificar(Request $request, $id)
    {

        if (!Auth::user()->hasVerifiedEmail()) {

            return redirect()->route('verification.notice')->withErrors([
                'email' => 'Debe verificar su dirección de correo electrónico antes de iniciar sesión.'
            ]);
        }

        if (Auth::check()) {
            $request->validate([
                'rating' => 'required|integer|between:1,5',
            ]);

            $usuario = User::findOrFail($id);
            $calificacionExistente = Rate::where('user_id', $usuario->id)
                ->where('qualifier', auth()->id())
                ->first();

            if ($calificacionExistente) {
                $calificacionExistente->update(['stars' => $request->rating]);
                return redirect()->back()->with('success', 'Calificación actualizada!');
            } else {
                Rate::create([
                    'user_id' => $usuario->id,
                    'qualifier' => auth()->id(),
                    'stars' => $request->rating,
                ]);
                return redirect()->back()->with('success', 'Calificación enviada!');
            }

        } else {
            return redirect()->route('voyager.login');
        }
    }
}
