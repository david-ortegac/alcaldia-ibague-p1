@extends('layouts.app')

@section('template_title')
    Departments
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Departmentos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('departments.create') }}" class="btn btn-success btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Departamento') }}
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

									<th >Nombre Departamento</th>
									<th >Jefe Departamento</th>
									<th >Creado por</th>
									<th >Actualizado por</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>{{ ++$i }}</td>

										<td >{{ $department->name }}</td>
										<td >{{ $department->chiefManager->name }}</td>
										<td >{{ $department->createdBy->name }}</td>
										<td >{{ $department->updatedBy->name }}</td>

                                            <td>
                                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-info" href="{{ route('departments.edit', $department->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $departments->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
