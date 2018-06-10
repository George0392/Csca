@extends('admin')

@section('content2')
    <h1 class="form-group col-md-12">Crear Socio</h1>
    
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ url('admin/socios') }}">
        {!!csrf_field()!!}
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputEmail4">Nombre</label>
                <input require type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" >
            </div>
            
            <div class="form-group col-md-2">
                <label for="inputEmail4">Teléfono</label>
                <input require type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" >
            </div>
            
            <div class="form-group col-md-2">
                <label for="inputZip">Email</label>
                <input require type="email" class="form-control" name="email" value="{{ old('email') }}" >
            </div>
            
            <div class="form-group col-md-2">
                <label for="inputPassword4">Password</label>
                <input require type="password" class="form-control" name="password" value="{{ old('password') }}" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputCity">Dirección</label>
                <input require type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" >
            </div>
    
            
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputState">Fecha de nac.</label>
                <input require type="date" class="form-control" name="nacimiento" value="{{ old('nacimiento') }}" >
            </div>
    
            <div class="form-group col-md-3">
                <label for="inputCity">Profesores</label>
                <select class="form-control" name="profesor_id" value="{{ old('profesor_id') }}">
                    @foreach($trainers as $trainer)
                        <option value="{{$trainer->id}}">{{$trainer->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="inputCity">Servicios</label>
                <select class="form-control" name="servicio_id" value="{{ old('servicio_id') }}">
                    @foreach($user_types as $type)
                        <option value="{{$type->id}}">{{$type->nombre}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <a href="/admin/socios" class="btn btn-primary form-control">Volver</a>
            </div>
            
            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Agregar socio</button>
            </div>
        </div>
    </form>
    
@endsection