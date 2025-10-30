<?php

namespace App\Http\Controllers\Reporter;

use Illuminate\Routing\Controller as BaseController;
use App\Models\CaseReport;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $reports = CaseReport::where('user_id', $request->user()->id)
                           ->latest()
                           ->get();

        return view('reporter.dashboard', compact('reports'));
    }
}
