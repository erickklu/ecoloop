<?php

namespace App\Http\Controllers;

use App\Models\RequestedEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class RequestedEntryController extends VoyagerBaseController
{
    public function solicitar($id)
    {

        if (auth()->check()) {
            $userId = Auth::id();

            $solicitudExistente = RequestedEntry::where('user_id', $userId)
                ->where('entry_id', $id)
                ->first();

            if ($solicitudExistente) {
                $solicitudExistente->delete();
            } else {
                RequestedEntry::create([
                    'user_id' => $userId,
                    'entry_id' => $id,
                    'request_date' => now()

                ]);
            }
            return back();
        } else {

            return redirect()->route('voyager.login');
        }
    }
    
}
