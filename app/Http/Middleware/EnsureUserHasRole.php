<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     * Usage: ->middleware('role:designer')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        // Accept both string roles (designer/supplier/manufacturer) and numeric (1/2/3)
        $map = [
            'designer' => '1',
            'supplier' => '2',
            'manufacturer' => '3',
            'admin' => '0',
        ];
        $userRoleString = (string) ($user->role ?? '');
        $expectedNumeric = $map[$role] ?? $role;
        $matches = $user && ($userRoleString === (string)$role || $userRoleString === (string)$expectedNumeric);
        if (!$matches) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}


