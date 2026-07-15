<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $roleEnum = UserRole::tryFrom($role);

        if (!$roleEnum) {
            abort(403, 'Unauthorized role.');
        }

        $user = Auth::user();

        if($user->role !== $roleEnum) {
            return redirect()->route($user->role->value . '.dashboard');
        }
        
        return $next($request);
    }
}
