@extends('control.index')

@section('content3')
    
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3">{{ $titulo }}</h1>
        <p>
            <form class="form-inline" method="POST" action="{{ url('admin/control/') }}">
                {!!csrf_field()!!}
                <div class="form-group mx-sm-3 mb-2">
                    <input type="hidden" class="form-control" name="admin" value="{{ Auth::user()->nombre }}">
                    <input type="number" required class="form-control" name="monto" placeholder="Cargar caja inicial">
                    <input type="hidden" class="form-control" name="id_desc" value="1">
                    <input type="hidden" class="form-control" name="detalle" value="Caja Inicial">
                    <input type="hidden" class="form-control" name="caja_abierta" value="1">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Cargar</button>
                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                    Cerrar
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmar operación</h5>
                            </div>
                            <div class="modal-body">
                                ¿Deseas cerrar la caja?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <a href="{{route('control.caja.cierre')}}" class="btn btn-danger">Sí, cerrar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </p>
    </div>
    
    <table class="table">
        <thead class="thead-dark"></thead>
          <tr></tr>
            <th scope="col">#</th>
            <th scope="col">Usuario</th>
            <th scope="col">Monto</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($controls as $control)
            <tr>
                <th scope="row">{{ $control->id }}</th>
                <td>{{ $control->admin }}</td>
                <td><b>$</b> {{ $control->monto }}</td>
                <td>{{ $control->created_at->format('d/m/Y') }}</td>
                <td>{{ $control->created_at->format('H:i') }} <b>hs</b></td>
            </tr>
            @endforeach
        </tbody>
      </table>
@endsection