@extends('admin')

@section('title', 'Editar Servicio')
@section('content2')
    <h1 class="mt-5form-group col-md-12">Editar servicio</h1>
    
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
    
    <form method="POST" action="{{ url("admin/servicios/{$service->id}") }}">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $service->nombre) }}" >
            </div>

            <div class="form-group col-md-3">
                <label>Monto</label>
                <input type="number" class="form-control" name="monto" value="{{ old('monto', $service->monto) }}" >
            </div>
        
            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <a href="/admin/servicios" class="btn btn-primary form-control">Volver</a>
            </div>
                
            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Editar servicio</button>
            </div>
        </div>
    </form>        
@endsection