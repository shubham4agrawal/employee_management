<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EmployeeRequest $request, Employee $employee)
    {
        try {
            $employee = $employee->newQuery();
            if ($request->has('firstname')) {
                $employee->where('firstname', 'LIKE', "%{$request->input('firstname')}%");
            }
            if ($request->has('lastname')) {
                $employee->where('lastname', 'LIKE', "%{$request->input('lastname')}%");
            }
            if ($request->has('department_id')) {
                $employee->where('department_id', $request->input('department_id'));
            }
            if ($request->has('email')) {
                $employee->where('email', $request->input('email'));
            }
            $employees = $employee->with(['contactNumbers', 'addresses'])->get();

            return response()->json($employees);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $department = Department::find($request->input('department_id'));
        if (!$department) {
            return response()->json(['error_message' => 'Department not found'], 404);
        }

        $employee = Employee::create($request->all());

        if ($request->has('addresses')) {
            foreach ($request->input('addresses') as $address) {
                $address['employee_id'] = $employee->id;
                $employee->addresses()->create($address);
            }
        }

        if ($request->has('contact_numbers')) {
            foreach ($request->input('contact_numbers') as $contactNumber) {
                $contactNumber['employee_id'] = $employee->id;
                $employee->contactNumbers()->create($contactNumber);
            }
        }

        $response['message'] = 'Employee added successfully';
        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $employee = Employee::with(['contactNumbers', 'addresses'])->find($id);
            return response()->json($employee);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id)
    {
        try {
            $employee = Employee::with(['contactNumbers', 'addresses'])->find($id);
            $employee->update($request->all());

            if ($request->has('addresses')) {
                $employee->addresses()->delete();
                foreach ($request->input('addresses') as $address) {
                    $address['employee_id'] = $id;
                    $employee->addresses()->create($address);
                }
            }

            if ($request->has('contact_numbers')) {
                $employee->contactNumbers()->delete();
                foreach ($request->input('contact_numbers') as $contactNumber) {
                    $contactNumber['employee_id'] = $id;
                    $employee->contactNumbers()->create($contactNumber);
                }
            }

            $response['message'] = 'Employee updated successfully';
            return response()->json($response);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $employee = Employee::find($id);
            if (!$employee) {
                return response()->json(['error' => 'Employee not found'], 404);
            }
            else {
                $employee->delete();
                return response()->json(['message' => 'Employee deleted successfully'], 200);
            }
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
