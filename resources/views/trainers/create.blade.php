@extends('admin')

@section('content2')
    <h1 class="form-group col-md-12">Crear Profesor</h1>
    
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ url('admin/profesores') }}">
        {!!csrf_field()!!}
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputEmail4">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" >
            </div>
            
            <div class="form-group col-md-2">
                <label for="inputEmail4">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputZip">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" >
            </div>
    
            <div class="form-group col-md-2">
                <label for="inputCity">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputState">Fecha de nac.</label>
                <input type="date" class="form-control" name="nacimiento" value="{{ old('nacimiento') }}" >
            </div>
    
            <div class="form-group col-md-2">
                <label for="inputCity">Inicio</label>
                <input type="date" class="form-control" name="inicio" value="{{ old('inicio') }}" >
            </div>

            <div class="form-group col-md-6">
                <label>&nbsp;</label>
                <a href="/admin/profesores" class="btn btn-primary form-control">Volver</a>
            </div>
            
            <div class="form-group col-md-6">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Agregar profesor</button>
            </div>
        </div>
    </form>
    
@endsection