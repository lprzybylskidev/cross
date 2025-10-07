<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetPasswordController extends Controller
{
    public function create(Request $request)
    {
        $userId = $request->session()->get('set_password_user_id');
        $user = $userId ? User::find($userId) : null;

        if (!$user || !empty($user->password)) {
            abort(403);
        }

        return view('auth.set-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $userId = $request->session()->get('set_password_user_id');
        $user = $userId ? User::find($userId) : null;

        if (!$user || !empty($user->password)) {
            abort(403);
        }

        $user->password = $request->string('password');
        $user->save();

        $request->session()->forget('set_password_user_id');
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
