<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email',
        'phone_number' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'password' => 'required|string|min:6',
    ]);

    Employee::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'address' => $request->address,
        'password' => Hash::make($request->password), // ✅ Correct way to hash password
    ]);

    return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
}





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id); // ✅ Fetch employee from DB
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id); // ✅ Fetch employee from DB
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);
    
        $employee = Employee::findOrFail($id); // ✅ Fetch employee from DB
        $employee->update($request->only(['first_name', 'last_name', 'email', 'phone', 'address']));
    
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }
    
    



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Fetch the employee from the database
        $employee = Employee::findOrFail($id); // Find the employee by ID
    
        // Delete the employee
        $employee->delete(); 
    
        // Redirect to employee index page with a success message
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}
