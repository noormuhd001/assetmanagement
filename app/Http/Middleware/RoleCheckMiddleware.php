<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleCheckMiddleware
{
    public function handle($request, Closure $next)
    {
        $currentRouteName = Route::currentRouteName();
        $user = Auth::user();

        Log::info('Current Route: ' . $currentRouteName);
        Log::info('User Role: ' . ($user ? $user->role : 'Guest'));

        if ($user) {
            $roleRoutes = $this->getRoleRoutes($user->role);

            Log::info('Allowed Routes for Role ' . $user->role . ': ' . implode(', ', $roleRoutes));

            if (!in_array($currentRouteName, $roleRoutes)) {
                Log::warning('Unauthorized access attempt by User ID: ' . $user->id . ' to Route: ' . $currentRouteName);
                abort(403, 'Unauthorized access');
            }
        }

        return $next($request);
    }

    protected function getRoleRoutes($role)
    {
        switch ($role) {
            case 0:
                return Config::get('constants.ADMIN', []);
            case 1:
                return Config::get('constants.EMPLOYEE', []);
            default:
                return [];
        }
    }
}
