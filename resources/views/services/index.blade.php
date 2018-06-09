@extends('admin')

@section('content2')
    
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
            <th scope="col">Socios</th>
            <th scope="col">Monto</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <th scope="row">{{ $service->id }}</th>
                    <td>{{ $service->nombre }}</td>
                    <td>
                        <?php $i=0 ?>
                        @foreach ($users as $user)
                            @if ($user->servicio_id == $service->id)
                            <?php ++$i ?>
                            @endif
                        @endforeach
                        @if($i>0)
                            <b class="btn btn-success">{{$i}} <span class="oi oi-people"></span></b>
                        @else
                            <b class="btn btn-default" disabled>{{$i}} <span class="oi oi-people"></span></b>
                        @endif
                    </td>
                    <td>{{ $service->monto }}</td>
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