<?php

namespace App\Http\Controllers;

use App\Services\AntiCensorshipEngineService;
use Illuminate\Contracts\View\View;

class DemoDashboardController extends Controller
{
    protected AntiCensorshipEngineService $antiCensorshipService;

    public function __construct(AntiCensorshipEngineService $antiCensorshipService)
    {
        $this->antiCensorshipService = $antiCensorshipService;
    }

    public function index(): View
    {
        $antiCensorshipStatus = $this->antiCensorshipService->getStatus();
        
        return view('demo', compact('antiCensorshipStatus'));
    }
}
