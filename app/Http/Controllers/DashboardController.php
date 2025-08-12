<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        $employeesByDivision = Employee::query()
            ->selectRaw('division_id, COUNT(*) AS total')
            ->groupBy('division_id')
            ->with('division')
            ->get();

        $employeesByCluster = Employee::query()
            ->selectRaw('cluster_id, COUNT(*) AS total')
            ->groupBy('cluster_id')
            ->with('cluster')
            ->get();

        return Inertia::render('Dashboard', [
            'employeesByDivision' => $employeesByDivision,
            'employeesByCluster'  => $employeesByCluster,
        ]);
    }
}
