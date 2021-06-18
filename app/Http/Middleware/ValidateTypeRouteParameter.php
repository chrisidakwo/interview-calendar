<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateTypeRouteParameter {
    private const TYPES = ['interviewer', 'candidate'];


    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        $type = $request->route()->parameter('type');

        if ($type && !in_array($type, self::TYPES)) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
