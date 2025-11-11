<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // Jika belum login, arahkan ke login
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Jika user tidak punya role yang sesuai
        if (!in_array($user->role, $roles)) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
