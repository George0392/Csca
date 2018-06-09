@extends('control.index')

@section('content3')
    
    <div class="d-flex justify-content-between align-items-end">
        {{-- SI ES EL INDEX --}}
        @if($titulo == "Cuotas de " . $tipo)
            <h1 class="mt-2 mb-3">{{ $titulo }}</h1>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        @elseif(strpos($titulo, "para"))
            <h2 class="mt-2 mb-3">{{ $titulo }}</h2>
            <a href="{{ url('/admin/control/caja/' . $tipo) }}" class="btn btn-primary">Volver</a>
        @else
            <h2 class="mt-2 mb-3">{{ $titulo }}</h2>
            <a href="{{ url('/admin/control/caja/' . $tipo) }}" class="btn btn-primary">Volver</a>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        @endif 
        
        <p></p>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <form class="form-inline" method="POST" action="{{ url('/admin/control/caja/ingresos') }}">
                    {!!csrf_field()!!}
                    <div class="form-group">
                        <label> Desde </label>
                        <input required type="date" class="form-control" name="desde">
                    </div>
                    <div class="form-group">
                        <label> Hasta </label>
                        <input required type="date" class="form-control" name="hasta" value="{{ date("Y-m-d") }}">
                    </div>
                            
                    <button type="submit" class="btn btn-success">Buscar</button>
                </form>
            </p>
        </div>
    </div>
    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                <th scope="col">#</th>
                {{-- SI ES EL INDEX --}}
                @if($titulo == "Cuotas de " . $tipo)
                    <th scope="col">Nombre</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Último</th>
                {{-- SI ES HISTORIAL GENERAL O PARTICULAR --}}
                @else 
                    <th scope="col">Detalle</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                @endif
            </tr>
        </thead>
        <tbody>
            {{-- SI ES EL INDEX --}}
            @if($titulo == "Cuotas de " . $tipo)
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>
                            {{ $user->nombre }}
                        </td>
                        <td>
                            @foreach ($services as $service)
                                @if ($service->id == $user->servicio_id)
                                    <?php $monto=$service->monto ?>
                                    {{ $service->nombre }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <form class="form-inline" name="myForm" method="POST" action="{{ url('admin/control/') }}">
                                {!!csrf_field()!!}
                                
                                <input style="width: 65px;" required class="form-control" name="monto" placeholder="Cuota" value="{{ $monto }}">
                                <input type="hidden" name="admin" value="{{ Auth::user()->nombre }}">
                                <input type="hidden" name="id_desc" value="2">
                                <input type="hidden" name="detalle" value="Cobro de cuota a {{ $user->nombre }}">
                                <input type="hidden" name="caja_abierta" value="1">
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <input type="hidden" name="paid_at" value="{{ date('Y-m-d') }}">
                                <button type="submit" class="btn btn-success mb-2">Cobrar</button>
                            </form>
                        </td>
                        <td>{{ date('d/m/y', strtotime($user->created_at)) }}</td>
                        <td>{{ date('d/m/y', strtotime($user->paid_at)) }}</td>
                        <td>
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample{{ $user->id }}" aria-expanded="false" aria-controls="collapseExample">
                                <span class="oi oi-clock"></span>
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="collapseExample{{ $user->id }}">
                        <td class="col-xs-10" colspan="7" >
                            <form class="form-inline" method="POST" action="{{ url('/admin/control/caja/ingresos/'. $user->nombre) }}">
                                {!!csrf_field()!!}
                                <div class="form-group">
                                    <label>Historial de cuotas para {{ $user->nombre }} desde</label>
                                    <input required type="date" class="form-control" name="desde">
                                </div>
                                <div class="form-group">
                                    <label>hasta</label>
                                    <input required type="date" class="form-control" name="hasta" value="{{ date("Y-m-d") }}">
                                </div>
                                                
                                <button type="submit" class="btn btn-success">Buscar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            {{-- SI ES HISTORIAL GENERAL O PARTICULAR --}}

            @else
                @foreach ($controls as $control)
                    <tr>
                        <th scope="row">{{ $control->id }}</th>
                        <td>{{ $control->detalle }}</td>
                        <td><b>$ </b>{{ $control->monto }}</td>
                        <td>{{ date('d/m/y', strtotime($control->created_at)) }}</td>
                        <td>{{ date('H:i', strtotime($control->created_at)) }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection