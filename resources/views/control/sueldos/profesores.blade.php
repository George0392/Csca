@extends('control.index')

@section('content3')
    
    <script language="javascript">
        function fAgrega()
        {
            [].forEach.call(document.querySelectorAll(".porc"), function(element, index)
            {
                element.addEventListener("input", function()
                {
                    document.querySelectorAll(".sueldo")[index].value = this.value*document.querySelectorAll(".total")[index].value/100;
                }, false);
            });
        }
    </script>

    <div class="d-flex justify-content-between align-items-end">
        @if($titulo == "Sueldos de " . $tipo)
            <h1 class="mt-2 mb-3">{{ $titulo }}</h1>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        @elseif(strpos($titulo, "istorial"))
            <h2 class="mt-2 mb-3">{{ $titulo }}</h2>
            <a href="{{ url('/admin/control/sueldos/' . $tipo) }}" class="btn btn-primary">Volver</a>
        @else
            <h2 class="mt-2 mb-3">{{ $titulo }}</h2>
            <a href="{{ url('/admin/control/sueldos/' . $tipo) }}" class="btn btn-primary">Volver</a>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        @endif 
        
        <p></p>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <form class="form-inline" method="POST" action="{{ url('/admin/control/sueldos/' . $tipo) }}">
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
                @if($titulo == "Sueldos de " . $tipo)
                    <th scope="col">Nombre</th>
                    <th scope="col">Alumnos</th>
                    <th scope="col">Total $</th>
                    <th scope="col">Porc. %</th>
                    <th scope="col">Sueldo</th>
                    <th scope="col">Pagos</th>
                @else
                    <th scope="col">Detalle</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if($titulo == "Sueldos de " . $tipo)
                @foreach ($trainers as $trainer)
                    <tr>
                        <th scope="row">{{ $trainer->id }}</th>
                        <td>
                            {{ $trainer->nombre }}
                        </td>
                        <td>
                            <?php $i=0; $total=0 ?>
                            @foreach ($users as $user)
                                @if ($user->profesor_id == $trainer->id)
                                    <?php ++$i ?>
                                    @foreach ($services as $service)
                                        @if ($service->id == $user->servicio_id)
                                            <?php $total=$total+$service->monto ?>
                                        @endif
                                    @endforeach 
                                @endif
                            @endforeach
                            @if($i>0)
                                <b class="btn btn-success">{{$i}} <span class="oi oi-people"></span></b>
                            @else
                                <b class="btn btn-default" disabled>{{$i}} <span class="oi oi-people"></span></b>
                            @endif
                        </td>
                        <td>
                            <label style="width: 75px;" class="form-control">{{$total}}</label>
                            <input type="hidden" id="Total" class="form-control total" value="{{ $total }}" >
                        </td>
                        <td>
                            <?php $porc=30 ?>
                            <input type="number" id="Porc" class="form-control porc" style="width: 60px;" placeholder="Porcentaje" value="{{ $porc }}" onchange="fAgrega();">
                        </td>
                        <td>
                            <form class="form-inline" name="myForm" method="POST" action="{{ url('admin/control/') }}">
                                {!!csrf_field()!!}
                                
                                <input id="Sueldo" style="width: 65px;" required class="form-control sueldo" name="monto" placeholder="Sueldo" value="{{ $porc*$total/100 }}">
                                <input type="hidden" name="admin" value="{{ Auth::user()->nombre }}">
                                <input type="hidden" name="id_desc" value="5">
                                <input type="hidden" name="detalle" value="Pago de sueldo a {{ $trainer->nombre }} ({{$i}} socios / ${{$total}})">
                                <input type="hidden" name="caja_abierta" value="1">
                                <button type="submit" class="btn btn-primary mb-2">Pagar</button>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample{{ $trainer->id }}" aria-expanded="false" aria-controls="collapseExample">
                                <span class="oi oi-clock"></span>
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="collapseExample{{ $trainer->id }}">
                        <td class="col-xs-10" colspan="7" >
                            <form class="form-inline" method="POST" action="{{ url('/admin/control/sueldos/' . $tipo . '/'. $trainer->nombre) }}">
                                {!!csrf_field()!!}
                                <div class="form-group">
                                    <label>Historial de sueldos para {{ $trainer->nombre }} desde</label>
                                    <input type="hidden" name="profesor" value="{{ $trainer->nombre }}">
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