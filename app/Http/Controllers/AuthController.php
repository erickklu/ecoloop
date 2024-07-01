<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function registerForm()
    {
        return view("auth.register");
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                function ($attribute, $value, $fail) {
                    if (!str_ends_with($value, '@pucesd.edu.ec')) {
                        $fail('El correo electrónico debe ser una cuenta institucional de @pucesd.edu.ec.');
                    }
                }
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        $validator->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Str::random(60);

        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        Mail::send('emails.verify', ['token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Verificación de correo electrónico');
        });

        return redirect()->route('verification.notice')->with('message', 'Se ha enviado un correo de verificación.');
    }

    public function verifyEmail($token)
    {
        $record = DB::table('password_reset_tokens')->where('token', $token)->first();

        if ($record) {
            User::where('email', $record->email)->update(['email_verified_at' => now()]);

            DB::table('password_reset_tokens')->where('email', $record->email)->delete();

            return redirect()->route('voyager.login')->with('message', 'Correo electrónico verificado exitosamente.');
        } else {
            return redirect()->route('voyager.login')->with('error', 'El token de verificación es inválido.');
        }
    }

    public function resendVerificationEmail(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('voyager.login')->with('error', 'Debes estar autenticado para realizar esta acción.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home')->with('message', 'Tu correo ya está verificado.');
        }

        $token = Str::random(60);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now()]
        );

        Mail::send('emails.verify', ['token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Verificación de correo electrónico');
        });

        return redirect()->route('verification.notice')->with('message', 'Se ha enviado un nuevo correo de verificación.');
    }
}
