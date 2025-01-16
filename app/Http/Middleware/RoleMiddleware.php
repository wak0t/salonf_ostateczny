<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Musisz być zalogowany.');
        }

        $user = Auth::user();

        if (($role === 'admin' && $user->role_id != 1) ||
            ($role === 'employee' && $user->role_id != 2) ||
            ($role === 'client' && $user->role_id != 3)) {
            abort(403, 'Nie masz dostępu do tej sekcji.');
        }

        return $next($request);
    }
}
