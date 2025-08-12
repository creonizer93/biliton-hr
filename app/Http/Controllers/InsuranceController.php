<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Insurance;

class InsuranceController extends Controller
{
    public function index()
    {
        $insurances = Insurance::with('employee')->get();
        return Inertia::render('Insurances/Index', [
            'insurances' => $insurances,
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
