<?php

namespace App\Http\Controllers;

use App\Mail\RequestAcceptNotification;
use App\Mail\RequestNotification;
use App\Models\RequestedEntry;
use Illuminate\Http\Request;
use App\Models\Entry;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class RequestedEntryController extends VoyagerBaseController
{
    public function solicitar($id)
    {
        if (auth()->check()) {
            if (Auth::user()->hasVerifiedEmail()) {
                $userId = Auth::id();

                $solicitudExistente = RequestedEntry::where('user_id', $userId)
                    ->where('entry_id', $id)
                    ->first();

                if ($solicitudExistente) {
                    $solicitudExistente->delete();
                    return redirect()->back()->with('success', '¡Solicitud eliminada exitosamente!');
                } else {
                    $requestedEntry = RequestedEntry::create([
                        'user_id' => $userId,
                        'entry_id' => $id,
                        'request_date' => now()

                    ]);

                    $entry = Entry::find($id);
                    if ($entry) {
                        $entryOwner = $entry->user;

                        if ($entryOwner) {
                            Mail::to($entryOwner->email)->send(new RequestNotification($requestedEntry));
                        } else {
                            return redirect()->back()->with('error', 'Propietario de la entrada no encontrado.');
                        }
                    } else {
                        return redirect()->back()->with('error', 'Entrada no encontrada.');
                    }
                    return redirect()->back()->with('success', '¡Solicitud enviada exitosamente!');
                }
            } else {

                return redirect()->route('verification.notice')->withErrors([
                    'email' => 'Debe verificar su dirección de correo electrónico antes de iniciar sesión.'
                ]);
            }
        } else {
            return redirect()->route('voyager.login');
        }
    }

    function aceptar_solicitud(RequestedEntry $requestedEntry ) {
        $requestedEntry->state = $requestedEntry->state=="PENDIENTE"?"CONFIRMADO":"PENDIENTE";
        $requestedEntry->save();

        if ($requestedEntry->state == "CONFIRMADO") {
            Mail::to($requestedEntry->user->email)->send(new RequestAcceptNotification($requestedEntry));
        }

        return redirect()->route("voyager.requested_entries.index");

    }
}
