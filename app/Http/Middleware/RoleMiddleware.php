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
	 * @param string $role
	 * @return mixed
	 */
    public function handle(Request $request, Closure $next, string $role) {
    	if ($role && in_array($request->user()->role, explode(',', $role))) {
		    return $next($request);
	    }

    	session()->flash('error', 'You do not have the right permission!');

    	return redirect()->route('dashboard');
    }
}
