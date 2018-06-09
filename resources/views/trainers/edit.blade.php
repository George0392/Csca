@extends('admin')

@section('title', 'Editar Profesor')
@section('content2')
    <h1 class="mt-5form-group col-md-12">Editar profesor</h1>
    
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
    
    <form method="POST" action="{{ url("admin/profesores/{$trainer->id}") }}">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $trainer->nombre) }}" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $trainer->telefono) }}" >
            </div>
    
            <div class="form-group col-md-2">
                <label for="inputZip">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $trainer->email) }}" >
            </div>
        
            <div class="form-group col-md-2">
                <label for="inputCity">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="{{ old('direccion', $trainer->direccion) }}" >
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputState">Fecha de nac.</label>
                <input type="date" class="form-control" name="nacimiento" value="{{ old('nacimiento', $trainer->nacimiento) }}" >
            </div>
        
            <div class="form-group col-md-2">
                <label for="inputCity">Inicio</label>
                <input type="date" class="form-control" name="inicio" value="{{ old('inicio', $trainer->inicio) }}" >
            </div>
    
            <div class="form-group col-md-6">
                <label>&nbsp;</label>
                <a href="/admin/profesores" class="btn btn-primary form-control">Volver</a>
            </div>
                
            <div class="form-group col-md-6">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Editar profesor</button>
            </div>
        </div>
    </form>        
@endsection