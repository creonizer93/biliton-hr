<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Cluster;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Testing\Constraints\SoftDeletedInDatabase;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with(['division', 'cluster', 'position', 'insurance']);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                    ->orWhere('ktp_number', 'like', '%' . $request->search . '%')
                    ->orWhere('employee_code', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->division_id) {
            $query->where('division_id', $request->division_id);
        }

        if ($request->cluster_id) {
            $query->where('cluster_id', $request->cluster_id);
        }

        return inertia('Employees/Index', [
            'employees' => $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString(),
            'divisions' => Division::all(),
            'clusters'  => Cluster::all(),
            'positions' => Position::all(), // ini tadi salah, harus Position bukan Cluster
            'insurances' => Insurance::all(),
            'filters'   => $request->only(['search', 'division_id', 'cluster_id']),
        ]);
    }

    public function create()
    {
        return inertia('Employees/Create', [
            'divisions' => Division::all(),
            'clusters'  => Cluster::all(),
            'positions'  => Position::all(),
            'insurances' => Insurance::all(),
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'ktp_number' => 'required|string|max:20|unique:employees,ktp_number',
            'employee_code' => 'required|string|max:20|unique:employees,employee_code',
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'address_ktp' => 'required|string|max:255',
            'address_domicile' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'division_id' => 'required|exists:divisions,id',
            'cluster_id' => 'required|exists:clusters,id',
            'position_id' => 'required|exists:positions,id',
            'status_employee' => 'required|in:active,inactive,freelance,resigned',
            'join_date' => 'required|date',
            'resign_date' => 'nullable|date|after_or_equal:join_date',
            'bank_account_number' => 'required|string|max:50',
            'bank_name' => 'required|string|max:100',
            'insurance_id' => 'nullable|exists:insurances,id',
        ]);

        $employee = Employee::create($data);

        return redirect()
            ->route('employees.show', $employee)
            ->with('success', 'Employee created successfully.');
    }
    public function edit(Employee $employee)
    {
        $employee->load(['division', 'cluster', 'position', 'insurance']);

        return inertia('Employees/Edit', [
            'employee' => $employee,
            'divisions' => Division::all(),
            'clusters'  => Cluster::all(),
            'positions'  => Position::all(),
            'insurances' => Insurance::all(),
        ]);
    }
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'ktp_number' => 'required|string|max:20|unique:employees,ktp_number,' . $employee->id,
            'employee_code' => 'required|string|max:20|unique:employees,employee_code,' . $employee->id,
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'address_ktp' => 'required|string|max:255',
            'address_domicile' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'division_id' => 'required|exists:divisions,id',
            'cluster_id' => 'required|exists:clusters,id',
            'position_id' => 'required|exists:positions,id',
            'status_employee' => 'required|in:active,inactive,freelance,resigned',
            'join_date' => 'required|date',
            'resign_date' => 'nullable|date|after_or_equal:join_date',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_name' => 'nullable|string|max:100',
            'insurance_id' => 'nullable|exists:insurances,id',
        ]);

        $employee->update($data);

        return redirect()
            ->route('employees.show', $employee)
            ->with('success', 'Employee updated successfully.');
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
    public function show(Employee $employee)
    {
        $employee->load(['division', 'cluster', 'position', 'insurance']);

        return Inertia::render('Employees/Show', [
            'employee' => $employee,
        ]);
    }
}
