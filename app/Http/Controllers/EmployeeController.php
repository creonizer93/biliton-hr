<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Cluster;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with(['division', 'cluster', 'position']);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                    ->orWhere('ktp_number', 'like', '%' . $request->search . '%')
                    ->orWhere('employee_code', 'like', '%' . $request->search . '%')
                    ->orWhere('bpjs_health_number', 'like', '%' . $request->search . '%')
                    ->orWhere('bpjs_tk_number', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->division_id) {
            $query->where('division_id', $request->division_id);
        }

        if ($request->cluster_id) {
            $query->where('cluster_id', $request->cluster_id);
        }

        return inertia('Employees/Index', [
            'employees' => $query->paginate(10)->withQueryString(),
            'divisions' => Division::all(),
            'clusters'  => Cluster::all(),
            'positions'  => Cluster::all(),
            'filters'   => $request->only(['search', 'division_id', 'cluster_id']),
        ]);
    }
}
