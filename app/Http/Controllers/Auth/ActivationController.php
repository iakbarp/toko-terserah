<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    public function activate(Request $request)
    {
        $user = User::byActivationColumns($request->email, $request->verifyToken)->firstOrFail();

        $user->update([
            'status' => true,
            'verifyToken' => null
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->route('beranda')->with('profil', 'Anda telah masuk! Untuk dapat menggunakan fitur ' .
            env('APP_NAME') . ' sepenuhnya, silahkan lengkapi profil Anda terlebih dahulu.');
    }
}
