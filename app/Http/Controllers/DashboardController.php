<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();
        
        $employeesPerDepartment = Department::withCount('employees')->get();
        
        $recentEmployees = Employee::with('department')->latest()->take(5)->get();
        
        return view('dashboard', compact(
            'totalEmployees', 
            'totalDepartments', 
            'employeesPerDepartment', 
            'recentEmployees'
        ));
    }
}
