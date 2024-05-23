<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">Nombre departamento</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $department?->name) }}" id="name" placeholder="Name">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">Seleccione jefe del departamento</label>
            <select class="form-control" name="chief_manager"
                    id="chief_manager" placeholder="Jefe de dependencia">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            {!! $errors->first('chief_manager', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <a href="{{ route('departments.index')}}" class="btn btn-info">{{ __('Volver') }}</a>
        <button type="submit" class="btn btn-success">{{ __('Guardar') }}</button>
    </div>
</div>
