@extends('admin')

@section('content2')
    
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3">{{ $titulo }}</h1>
        <p>
            <a href="{{route('users.create')}}" class="btn btn-primary">Nuevo Socio</a>
        </p>
    </div>
    
    <table class="table">
        <thead class="thead-dark"></thead>
          <tr></tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Profesor</th>
            <th scope="col">Servicio</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->nombre }}</td>
                    <td>
                        @foreach($trainers as $trainer)
                            @if($trainer->id == $user->profesor_id)
                                {{$trainer->nombre}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($services as $service)
                            @if($service->id == $user->servicio_id)
                                {{$service->nombre}}
                            @endif
                        @endforeach
                    <td>
                        <form action="{{ route('users.delete', $user) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a href="{{ route('users.show', $user) }}" class="btn btn-success"><span class="oi oi-eye"></span></a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
@endsection