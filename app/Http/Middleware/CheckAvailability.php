<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAvailability {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (empty($request->user()->availability)) {
            session()->flash('error', 'Please update your availability');

            return redirect()->route('availability.create');
        }

        return $next($request);
    }
}
