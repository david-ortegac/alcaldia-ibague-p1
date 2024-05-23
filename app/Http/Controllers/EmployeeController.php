<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $employees = Employee::paginate();

        return view('employee.index', compact('employees'))
            ->with('i', ($request->input('page', 1) - 1) * $employees->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $employee = new Employee();
        $departments = Department::all();
        $users = User::all();

        return view('employee.create', compact(['employee', 'departments', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->user_id = $request->input('user_id');
        $employee->department_id = $request->input('department_id');
        $employee->role = $request->input('role');
        $employee->created_by = Auth::user()->id;
        $employee->modified_by = Auth::user()->id;

        $employee->save();


        return Redirect::route('employees.index')
            ->with('success', 'Empleado creado satisfactoriamente.');
    }

    /**
     * Return an employee by name
     */
    public function findByName($name): View
    {

        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $employee = Employee::find($id);
        $departments = Department::all();
        $users = User::all();

        return view('employee.edit', compact(['employee', 'departments', 'users']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $employee->update($request->validated());

        return Redirect::route('employees.index')
            ->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Employee::find($id)->delete();

        return Redirect::route('employees.index')
            ->with('success', 'Empleado eliminado correctamente');
    }
}
