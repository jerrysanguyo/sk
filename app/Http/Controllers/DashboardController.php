<?php

namespace App\Http\Controllers;

use App\Charts\ProjectsEventsChart;
use App\Charts\SpentPerMonthChart;

class DashboardController extends Controller
{
    public function index(ProjectsEventsChart $projectsEventsChart, SpentPerMonthChart $spentPerMonthChart)
    {
        return view('dashboard', compact('projectsEventsChart','spentPerMonthChart'));
    }
}
    