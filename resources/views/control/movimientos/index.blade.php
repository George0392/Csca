@extends('control.index')
    <style>
        .verde{
            background-color: #00cf01;
            color: white;
        }
        .roja{
            background-color: #ce0000;
            color: white;
        }
        .verdeOscuro{
            background-color: #007701;
            color:gray;
        }
        .rojaOscuro{
            background-color: #770000;
            color:gray;
        }
        .azul{
            background-color: #005cce;
            color: white;
        }
        .azulOscuro{
            background-color: #003575;
            color: gray;
        }
        .fila{
            font-size: large;
        }
        .table > tbody > tr.fila > td{
            padding: 7px;
            padding-left: 15px;
        }
    </style>
@section('content3')
    
    <div class="d-flex justify-content-between align-items-end">
        @if($titulo == "Movimientos del turno")
            <h1 class="mt-2 mb-3">{{ $titulo }}</h1>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        @else
            <h2 class="mt-2 mb-3">{{ $titulo }}</h2>
            <a href="{{ url('/admin/control/sueldos/') }}" class="btn btn-primary">Volver</a>
        @endif 
    </div>
    <p></p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <form class="form-inline" method="POST" action="{{ url('/admin/control/sueldos/historial') }}">
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

    <table class="table table-bordered" style="border: 5px;border-style: inset;">
        <tbody>
            <tr
                @if($caja_inicial == 0) 
                    class="fila verdeOscuro"
                @else
                    class="fila verde"
                @endif>
                <td>Inicio Caja</td>
                <td>$ {{ $caja_inicial }}</td>
            </tr>
            <tr
                @if($ingXprod == 0) 
                    class="fila verdeOscuro"
                @else
                    class="fila verde"
                @endif >
                <td>Ingresos x Productos</td>
                <td>$ {{ $ingXprod }}</td>
            </tr>
            <tr
                @if($ingXserv == 0) 
                    class="fila verdeOscuro"
                @else
                    class="fila verde"
                @endif>
                <td>Ingresos x Servicios</td>
                <td>$ {{ $ingXserv }}</td>
            </tr>
            <tr
                @if($gastXlimp == 0) 
                    class="fila rojaOscuro"
                @else
                    class="fila roja"
                @endif>
                <td>Gastos x Limpieza</td>
                <td>$ {{ $gastXlimp }}</td>
            </tr>
            <tr
                @if($gastXserv == 0) 
                    class="fila rojaOscuro"
                @else
                    class="fila roja"
                @endif>
                <td>Gastos x Servicios</td>
                <td>$ {{ $gastXserv }}</td>
            </tr>
            <tr
                @if($gastXmerc == 0) 
                    class="fila rojaOscuro"
                @else
                    class="fila roja"
                @endif>
                <td>Gastos x Mercaderías</td>
                <td>$ {{ $gastXmerc }}</td>
            </tr>
            <tr
                @if($retiros == 0) 
                    class="fila rojaOscuro"
                @else
                    class="fila roja"
                @endif>
                <td>Retiros</td>
                <td>$ {{ $retiros }}</td>
            </tr>
            <tr
                @if($sueldos == 0) 
                    class="fila rojaOscuro"
                @else
                    class="fila roja"
                @endif>
                <td>Sueldos</td>
                <td>$ {{ $sueldos }}</td>
            </tr>
            <tr
                @if($comisiones == 0) 
                    class="fila rojaOscuro"
                @else
                    class="fila roja"
                @endif>
                <td>Comisiones</td>
                <td>$ {{ $comisiones }}</td>
            </tr>
            <tr
                @if($total == 0) 
                    class="fila azulOscuro"
                @else
                    class="fila azul"
                @endif>
                <td>Total</td>
                <td>$ {{ $total }}</td>
            </tr>
        </tbody>
    </table>
@endsection