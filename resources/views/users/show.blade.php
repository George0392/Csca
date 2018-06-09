@extends('admin')

@section('title', 'Ver Usuario')
@section('content2')
    <h1 class="mt-5form-group col-md-12">Ver Socio</h1>
    
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Nombre</label>
                <input readonly class="form-control" name="nombre" value="{{ $user->nombre }}" >
            </div>
                
            <div class="form-group col-md-2">
                <label>Usuario</label>
                <input readonly class="form-control" name="username" value="{{ $user->username }}" >
            </div>
    
            <div class="form-group col-md-2">
                <label>Email</label>
                <input readonly class="form-control" name="email" value="{{ $user->email }}" >
            </div>
        
            <div class="form-group col-md-2">
                <label>Password</label>
                <input type="password" readonly class="form-control" name="password" value="{{ $user->password }}" >
            </div>
        
            <div class="form-group col-md-2">
                <label>DNI</label>
                <input readonly class="form-control" name="dni" value="{{ $user->dni }}" >
            </div>
    
            <div class="form-group col-md-2">
                <label>Dirección</label>
                <input readonly class="form-control" name="direccion" value="{{ $user->direccion }}" >
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Fecha de nac.</label>
                <input readonly class="form-control" name="nacimiento" value="{{ date('d/m/Y', strtotime($user->nacimiento)) }}" >
            </div>
        
            <div class="form-group col-md-1">
                <label>Edad</label>
                <input readonly class="form-control" name="edad" value="{{ $user->edad }}" >
            </div>
            
            <div class="form-group col-md-1">
                <label>Peso</label>
                <input readonly class="form-control" name="peso" value="{{ $user->peso }}" >
            </div>
    
            <div class="form-group col-md-1">
                <label>Altura</label>
                <input readonly class="form-control" name="altura" value="{{ $user->altura }}" >
            </div>
    
            <div class="form-group col-md-2">
                <label>Inicio</label>
                <input readonly class="form-control" name="inicio" value="{{ date('d/m/Y', strtotime($user->inicio)) }}" >
            </div>
    
            <div class="form-group col-md-2">
                <label>Profesor</label>
                @foreach($trainers as $trainer)
                    @if($trainer->id == $user->profesor_id)
                        <input readonly class="form-control" name="profesor_id" value="{{$trainer->nombre}}">
                    @endif
                @endforeach
            </div>

            <div class="form-group col-md-2">
                <label>Servicio</label>
                @foreach($services as $service)
                    @if($service->id == $user->servicio_id)
                        <input readonly class="form-control" name="servicio_id" value="{{$service->nombre}}">
                    @endif
                @endforeach
            </div>
                
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <a href="/admin/socios" class="btn btn-primary form-control">Volver</a>
            </div>
                
        </div>
    </form>        
@endsection