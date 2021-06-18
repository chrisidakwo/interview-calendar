<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        $roles = array_slice(func_get_args(), 2) ?? [];

        if (!empty($roles) && in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        session()->flash('error', 'You do not have the right permission!');

        return redirect()->route('dashboard');
    }
}
