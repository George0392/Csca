@extends('admin')

@section('content2')
    include('barcode.php');
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3">{{ $titulo }}</h1>
        <p>
            <a href="{{route('services.create')}}" class="btn btn-primary">Nuevo Servicio</a>
        </p>
    </div>
    
    <table class="table">
        <thead class="thead-dark"></thead>
          <tr></tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Categoría</th>
            <th scope="col">Código</th>
            <th scope="col">Cant.</th>
            <th scope="col">Quedan</th>
            <th scope="col">Costo</th>
            <th scope="col">Monto</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <th scope="row">{{ $service->id }}</th>
                    <td>{{ $service->nombre }}</td>
                    <td>Varios</td>
                    <td><img src="barcode.php?text=0123456789&size=40&codetype=Code39&print=true"></td>
                    <td>50</td>
                    <td>50</td>
                    <td><b>$</b> {{ $service->monto }}</td>
                    <td>25</td>
                    <td>
                        <form action="{{ route('services.delete', $service) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            {{--  <a href="{{ route('services.show', $service) }}" class="btn btn-success"><span class="oi oi-eye"></span></a>  --}}
                            <a href="{{ route('services.edit', $service) }}" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
@endsection