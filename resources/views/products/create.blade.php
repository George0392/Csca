@extends('admin')

@section('content2')
    <h1 class="form-group col-md-12">Crear Servicio</h1>
    
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ url('admin/servicios') }}">
        {!!csrf_field()!!}
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputEmail4">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputEmail4">Monto</label>
                <input type="number" class="form-control" name="monto" value="{{ old('monto') }}" >
            </div>
        </div>    

        <div class="form-row">
            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <a href="/admin/servicios" class="btn btn-primary form-control">Volver</a>
            </div>
            
            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Agregar servicio</button>
            </div>
        </div>
    </form>
    
@endsection