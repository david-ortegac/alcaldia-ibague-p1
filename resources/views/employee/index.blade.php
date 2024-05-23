@extends('layouts.app')

@section('template_title')
    Employees
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Employees') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('employees.create') }}" class="btn btn-success btn-sm float-right"
                                   data-placement="left">
                                    {{ __('Crear Empleado') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Usuario</th>
                                    <th>Departamento asignado</th>
                                    <th>Jefe directo</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Creado por</th>
                                    <th>Modificado por</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ ++$i }}</td>

                                        <td>{{ $employee->user->name }}</td>
                                        <td>{{ $employee->department->name }}</td>
                                        <td>{{ $employee->department->chiefManager->name }}</td>
                                        <td>{{ $employee->role }}</td>
                                        <td>{{ $employee->role }}</td>
                                        @if($employee->status==1)
                                            <td>Activo</td>
                                        @else
                                            <td>Inactivo</td>
                                        @endif
                                        <td>{{ $employee->createdBy->name }}</td>
                                        <td>{{ $employee->updatedBy->name }}</td>

                                        <td>
                                            <form action="{{ route('employees.destroy', $employee->id) }}"
                                                  method="POST">
                                                <a class="btn btn-sm btn-info"
                                                   href="{{ route('employees.edit', $employee->id) }}"><i
                                                        class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">
                                                    <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $employees->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
