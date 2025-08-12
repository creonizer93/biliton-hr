<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['division', 'cluster', 'position'])
            ->paginate(25)
            ->withQueryString();

        return Inertia::render('Employees/Index', [
            'employees' => $employees
        ]);
    }
}
