<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index(Request $request)
    {
        // Kolom yang bisa di-sort (mapping: nama frontend => kolom database)
        $sortable = [
            'full_name' => 'employees.full_name',
            'nik_ktp' => 'employees.nik_ktp',
            'employee_code' => 'employees.employee_code',
            'division' => 'divisions.name',
            'cluster' => 'clusters.name',
            'bpjs_health_number' => 'insurances.bpjs_health_number',
            'bpjs_health_join_date' => 'insurances.bpjs_health_join_date',
            'bpjs_tk_number' => 'insurances.bpjs_tk_number',
            'bpjs_tk_join_date' => 'insurances.bpjs_tk_join_date',
        ];

        // Ambil parameter sorting dari request
        $sortField = $request->get('sort_field', 'full_name');
        $sortDirection = $request->get('sort_direction', 'asc');

        // Validasi kolom sort agar aman
        if (!array_key_exists($sortField, $sortable)) {
            $sortField = 'full_name';
        }
        if (!in_array(strtolower($sortDirection), ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        // Query utama dengan join
        $query = Insurance::select('insurances.*')
            ->join('employees', 'insurances.employee_id', '=', 'employees.id')
            ->leftJoin('divisions', 'employees.division_id', '=', 'divisions.id')
            ->leftJoin('clusters', 'employees.cluster_id', '=', 'clusters.id')
            ->with(['employee', 'employee.division', 'employee.cluster', 'employee.position']);

        // Filter Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('employees.full_name', 'like', "%{$search}%")
                    ->orWhere('employees.nik_ktp', 'like', "%{$search}%")
                    ->orWhere('employees.employee_code', 'like', "%{$search}%");
            });
        }

        // Filter Division
        if ($request->filled('division_id')) {
            $query->where('employees.division_id', $request->division_id);
        }

        // Filter Cluster
        if ($request->filled('cluster_id')) {
            $query->where('employees.cluster_id', $request->cluster_id);
        }

        // Sorting
        $query->orderBy($sortable[$sortField], $sortDirection);

        return Inertia::render('Insurances/Index', [
            'insurances' => $query->paginate(15)->withQueryString(),
            'employees' => Employee::with(['division', 'cluster', 'position'])->get(),
            'filters' => $request->only(['search', 'division_id', 'cluster_id', 'sort_field', 'sort_direction']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Insurances/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bpjs_health_number' => 'required|string|max:255',
            'bpjs_health_join_date' => 'required|date',
            'bpjs_tk_number' => 'required|string|max:255',
            'bpjs_tk_join_date' => 'required|date',
        ]);

        Insurance::create($request->all());

        return redirect()->route('insurances.index')->with('success', 'Insurance created successfully.');
    }

    public function edit(Insurance $insurance)
    {
        return Inertia::render('Insurances/Edit', [
            'insurance' => $insurance,
        ]);
    }

    public function update(Request $request, Insurance $insurance)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bpjs_health_number' => 'required|string|max:255',
            'bpjs_health_join_date' => 'required|date',
            'bpjs_tk_number' => 'required|string|max:255',
            'bpjs_tk_join_date' => 'required|date',
        ]);

        $insurance->update($request->all());

        return redirect()->route('insurances.index')->with('success', 'Insurance updated successfully.');
    }

    public function destroy(Insurance $insurance)
    {
        $insurance->delete();

        return redirect()->route('insurances.index')->with('success', 'Insurance deleted successfully.');
    }
}
