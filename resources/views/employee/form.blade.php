<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="user_id" class="form-label">{{ __('Usuario') }}</label>
            <select class="form-control" name="user_id"
                    id="user_id" placeholder="Jefe de dependencia">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="department_id" class="form-label">{{ __('Departamento') }}</label>
            <select class="form-control" name="department_id"
                    class="form-control @error('department_id') is-invalid @enderror"
                    value="{{ old('department_id', $employee?->department_id) }}" id="department_id"
                    placeholder="Department Id">
                @foreach($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                @endforeach
            </select>
            {!! $errors->first('department_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="role" class="form-label">{{ __('Rol') }}</label>
            <select class="form-select" name="role" class="form-control @error('role') is-invalid @enderror"
                    value="{{ old('role', $employee?->role) }}" id="role" placeholder="Role">
                <option value="Jefe departamento">Jefe departamento</option>
                <option value="Empleado">Empleado</option>
            </select>
            {!! $errors->first('role', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="status" class="form-label">{{ __('Estado') }}</label>
            <select class="form-select" name="status" class="form-control @error('status') is-invalid @enderror"
                    value="{{ old('status', $employee?->status) }}" id="status" placeholder="Status">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            {!! $errors->first('status', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
