<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    /**
     * @param Request $request
     * @param string $type
     * @return Application|Factory|View
     */
    public function index(Request $request, string $type) {
        return view('dashboard', compact('type'));
    }
}
