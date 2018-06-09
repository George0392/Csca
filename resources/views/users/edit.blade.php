@extends('admin')

@section('title', 'Editar Usuario')
@section('content2')
    <h1 class="mt-5form-group col-md-12">Editar socio</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <p>Por favor, corrige los errores debajo</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url("admin/socios/{$user->id}") }}">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputEmail4">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $user->nombre) }}" >
            </div>
                
            <div class="form-group col-md-2">
                <label for="inputEmail4">Usuario</label>
                <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" >
            </div>
    
            <div class="form-group col-md-2">
                <label for="inputZip">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" >
            </div>
        
            <div class="form-group col-md-2">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" name="password" value="{{ old('password', $user->password) }}" >
            </div>
        
            <div class="form-group col-md-2">
                <label for="inputAddress">DNI</label>
                <input type="number" class="form-control" name="dni" value="{{ old('dni', $user->dni) }}" >
            </div>
    
            <div class="form-group col-md-2">
                <label for="inputCity">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="{{ old('direccion', $user->direccion) }}" >
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputState">Fecha de nac.</label>
                <input type="date" class="form-control" name="nacimiento" value="{{ old('nacimiento', $user->nacimiento) }}" >
            </div>
        
            <div class="form-group col-md-1">
                <label for="inputZip">Edad</label>
                <input type="number" class="form-control" name="edad" value="{{ old('edad', $user->edad) }}" >
            </div>
            
            <div class="form-group col-md-1">
                <label for="inputAddress">Peso</label>
                <input type="text" class="form-control" name="peso" value="{{ old('peso', $user->peso) }}" >
            </div>
    
            <div class="form-group col-md-1">
                <label for="inputCity">Altura</label>
                <input type="number" class="form-control" name="altura" value="{{ old('altura', $user->altura) }}" >
            </div>
    
            <div class="form-group col-md-2">
                <label for="inputCity">Inicio</label>
                <input type="date" class="form-control" name="inicio" value="{{ old('inicio', $user->inicio) }}" >
            </div>
    
            <div class="form-group col-md-3">
                <label for="inputCity">Profesores</label>
                <select class="form-control" name="profesor_id" value="{{ old('profesor_id', $user->profesor_id) }}">
                    @foreach($trainers as $trainer)
                        @if($trainer->id == $user->profesor_id)
                            <option selected value="{{$trainer->id}}">{{$trainer->nombre}}</option>
                        @else
                            <option value="{{$trainer->id}}">{{$trainer->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="inputCity">Servicios</label>
                <select class="form-control" name="servicio_id" value="{{ old('servicio_id', $user->servicio_id) }}">
                    @foreach($services as $service)
                        @if($service->id == $user->servicio_id)
                            <option selected value="{{$service->id}}">{{$service->nombre}}</option>
                        @else
                            <option value="{{$service->id}}">{{$service->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
                
            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <a href="/admin/socios" class="btn btn-primary form-control">Volver al listado</a>
            </div>
                
            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Editar socio</button>
            </div>
        </div>
    </form>        
@endsection