@extends('admin')

@section('content2')
    <h1 class="form-group col-md-12">Agregar {{ $userType->nombre }}</h1>
    
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="/admin/{{ $type }}s">
        {!!csrf_field()!!}
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Nombre</label>
                <input require type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" >
            </div>
            
            <div class="form-group col-md-2">
                <label>Teléfono</label>
                <input require type="number" class="form-control" name="telefono" placeholder="Sin 0 ni 15" value="{{ old('telefono') }}" >
            </div>
            
            <div class="form-group col-md-3">
                <label>Email</label>
                <input require type="email" class="form-control" name="email" value="{{ old('email') }}" >
            </div>
            
            <div class="form-group col-md-2">
                <label>Dirección</label>
                <input require type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Fecha de nac.</label>
                <input require type="date" class="form-control" name="nacimiento" value="{{ old('nacimiento') }}" >
            </div>
            
            @if($userType->nombre == "encargado")
            <div class="form-group col-md-3">
                <label>Password</label>
                <input require type="password" class="form-control" name="password" value="{{ old('password') }}" >
            </div>
            @endif
        </div>

        <div class="form-row">
            <input type="hidden" name="id_uType" value="{{ $userType->id }}" >
            
            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Agregar {{$type}}</button>
            </div>

            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <a href="/admin/{{ $type }}s" class="btn btn-primary form-control">Volver</a>
            </div>
        </div>
    </form>
    
@endsection