<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class EnsureUserHasEmptyPassword
{
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->session()->get('set_password_user_id');
        if (!$userId) {
            abort(403);
        }

        $user = User::find($userId);
        if (!$user || !empty($user->password)) {
            abort(403);
        }

        return $next($request);
    }
}
