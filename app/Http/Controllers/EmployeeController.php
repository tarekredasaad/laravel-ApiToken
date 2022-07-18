<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        return Employee::all();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'salary'=>'required|numeric'
        ]);

        $emp =Employee::create([
            'name'=> $request->name,
            'salary'=> $request->salary
        ]);

        $response = [
            'employee' => $emp,
            'message' => 'Insert Done',
        ];

        return response($response,201);
    }


    public function show(Employee $employee)
    {
        //
    }


    public function edit(Employee $employee)
    {
        //
    }


    public function update(Request $request, Employee $employee)
    {
        //
    }


    public function destroy($id)
    {
       return Employee::destroy($id);
    }
}
