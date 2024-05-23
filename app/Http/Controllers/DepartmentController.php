<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $departments = Department::paginate();

        return view('department.index', compact('departments'))
            ->with('i', ($request->input('page', 1) - 1) * $departments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $department = new Department();
        $users = User::all();

        return view('department.create', compact(['department','users']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $department = new Department();
        $department->name = $request->input('name');
        $department->chief_manager=$request->input('chief_manager');
        $department->created_by=Auth()->user()->id;
        $department->modified_by=Auth()->user()->id;

        $department->save();

        return Redirect::route('departments.index')
            ->with('success', 'El departamento ha sido creado con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $department = Department::find($id);
        $users = User::all();

        return view('department.edit', compact(['department','users']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $department->modified_by=Auth::id();
        $department->chief_manager=$request->chief_manager;
        $department->update($request->validated());

        return Redirect::route('departments.index')
            ->with('success', 'El departmento ha sido actualizado con exito');
    }

    public function destroy($id): RedirectResponse
    {
        Department::find($id)->delete();

        return Redirect::route('departments.index')
            ->with('success', 'El departamento ha sido eliminado con exito');
    }
}
