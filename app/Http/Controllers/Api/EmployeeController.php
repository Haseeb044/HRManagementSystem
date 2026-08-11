<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::with('department');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('department', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        return EmployeeResource::collection($query->latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('employees', 'public');
        }

        if ($request->hasFile('cv_document')) {
            $data['cv_document'] = $request->file('cv_document')->store('employees', 'public');
        }

        $employee = Employee::create($data);
        return new EmployeeResource($employee->load('department'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee->load('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            if ($employee->profile_image) {
                Storage::disk('public')->delete($employee->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('employees', 'public');
        }

        if ($request->hasFile('cv_document')) {
            if ($employee->cv_document) {
                Storage::disk('public')->delete($employee->cv_document);
            }
            $data['cv_document'] = $request->file('cv_document')->store('employees', 'public');
        }

        $employee->update($data);
        return new EmployeeResource($employee->load('department'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->profile_image) {
            Storage::disk('public')->delete($employee->profile_image);
        }
        
        if ($employee->cv_document) {
            Storage::disk('public')->delete($employee->cv_document);
        }

        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully.']);
    }
}
