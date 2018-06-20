@extends('control.index')

@section('content3')
    
    <div style="display: flex;">
        <div>
            <h1 style="margin-top: auto;">{{ $titulo }}</h1>
        </div>
        @if($subtitulo != "La orden todavía no existe")
            <div style="margin-left: auto; margin-top: 3px;">
                <label class="btn btn-success">TOTAL ${{ $order->monto }}</label>
            </div>
            <div style="margin-top: 3px; margin-left: 5px;">    
                @if($order->desc == 0)
                    @if($order->completada == 0)
                    <form method="POST" action="/admin/control/{{$tipo}}/descuento/{{ $id_order }}">
                        {!!csrf_field()!!}
                        <input class="btn btn-default" type="number" name="desc" placeholder="DESC ${{ $order->desc }}" style="width: 105px;">
                    </form>
                    @else
                        <label class="btn btn-default">DESC ${{ $order->desc }}</label>
                    @endif
                @else
                    <label class="btn btn-danger">DESC ${{ $order->desc }}</label>
                @endif
            </div>
            <div style="margin-top: 3px; margin-left: 5px;">    
                @if($order->completada == 1)
                <a href="/admin/control/ingresos/{{$tipo}}" class="btn btn-primary"><span class="oi oi-arrow-left"></span> <b>VOLVER</b></a>
                @endif
            </div>
        @endif
    </div>
    <h4 class="mt-2 mb-3">{{ $subtitulo }}</h4>
        
    @if($subtitulo != "La orden todavía no existe")
        <div class="card card-body">
            <p>
                @if($order->completada != "1")
                <form method="POST" action="/admin/control/ingresos/{{$tipo}}/{{ $id_order }}">
                    {!!csrf_field()!!}
                        
                    <div class="form-group col-md-2" style="padding-left: 0px;">
                        <label>Servicio</label>
                        <select class="form-control" name="id_servicio" value="{{ old('id_servicio') }}">
                            @foreach($servicios as $servicio)
                                <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                                
                    <div class="form-group col-md-6" style="padding-left: 0px;">
                        <label>Detalle</label>
                        <input required type="text" class="form-control" name="detalle" value="{{ old('detalle') }}">
                    </div>
                    <input type="hidden" class="form-control" name="id_type" value="{{ $id_type }}">
                    <input type="hidden" class="form-control" name="id_order" value="{{ $id_order }}">
                        
                    <div class="form-group col-md-2" style="padding-left: 0px;">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-success form-control">Agregar</button>
                    </div>
                </form>
                <form method="POST" action="/admin/control/{{$tipo}}/cerrar/{{ $id_order }}">
                    {!!csrf_field()!!}
                    <input type="hidden" class="form-control" name="completada" value="1">
                    <div class="form-group col-md-2" style="padding-left: 0px;">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-danger form-control">Cerrar</button>
                    </div>
                </form>
                @endif
            </p>
        </div>
    @endif

    <p></p>
    
    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                <th scope="col">Servicio</th>
                <th scope="col">Detalle</th>
                <th scope="col">Monto</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders_indiv as $order)
                <tr>
                    <td scope="row">
                        @foreach($servicios as $servicio)
                            @if($servicio->id == $order->id_servicio)
                                {{$servicio->nombre}}
                                @break
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $order->detalle }}</td>
                    <td><b>$</b> {{ $order->monto }}</td>
                    <td>{{ date('d/m/y', strtotime($order->created_at)) }}</td>
                    <td>{{ date('H:i', strtotime($order->created_at)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection