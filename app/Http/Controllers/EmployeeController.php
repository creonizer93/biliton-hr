<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Cluster;
use App\Models\Division;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with(['division', 'cluster', 'position']);

        if ($request->division_id) {
            $query->where('division_id', $request->division_id);
        }

        if ($request->cluster_id) {
            $query->where('cluster_id', $request->cluster_id);
        }

        $employees = $query->paginate(10)->appends($request->query());

        return Inertia::render('Employees/Index', [
            'employees' => $employees,
            'divisions' => Division::all(),
            'clusters' => Cluster::all(),
            'filters' => $request->only(['division_id', 'cluster_id'])
        ]);
    }
}
