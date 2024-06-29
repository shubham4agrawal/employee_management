<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $departments = Department::all();
            return response()->json($departments);
        }
        catch (\Exception $e) {
            return response(['error_message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $department = Department::create($request->all());
            return response()->json($department, 201);
        }
        catch (\Exception $e) {
            return response(['error_message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json(['data' => Department::find($id)]);
        }
        catch (\Exception $e) {
            return response(['error_message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $department = Department::find($id);
            if (!$department) {
                return response()->json(['error_message' => 'Department not found'], 404);
            }
            else {
                $department->update($request->all());
            }
            return response()->json($department);
        }
        catch (\Exception $e) {
            return response(['error_message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $department = Department::find($id);
            if (!$department) {
                return response()->json(['error_message' => 'Department not found'], 404);
            }
            else {
                $department->delete($id);
            }
        }
        catch (\Exception $e) {
            return response()->json(['error_message' => $e->getMessage()], 500);
        }
    }
}
