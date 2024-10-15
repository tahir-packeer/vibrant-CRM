<?php

namespace App\Http\Controllers;

use ConsoleTVs\Charts\Facades\Charts;

class ChartsGraph extends Controller
{
    public function index() {
        // Create a bar chart using Highcharts
        $chart = Charts::create('bar', 'highcharts') // Use the Charts facade here
        ->title("Sales Report")
            ->elementLabel("Total Sales")
            ->labels(['Jan', 'Feb', 'Mar', 'Apr'])
            ->values([15, 25, 30, 45])
            ->dimensions(1000, 500)
            ->responsive(true);

        // Pass the chart to the view
        return view('admin.dashboard', compact('chart'));
    }
}
