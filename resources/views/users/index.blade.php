@extends('admin')

@section('content2')
    
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3">Listado de {{ $type }}s</h1>
        <p>
            <a href="/admin/{{$type}}s/nuevo" class="btn btn-primary">Nuevo {{ $type }}</a>
        </p>
    </div>
    
    <table class="table">
        
        <thead class="thead-dark"></thead>
          <tr></tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Teléfono</th>
            <th scope="col">E-Mail</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->nombre }}</td>
                    <td>{{ $user->telefono }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('users.delete', [$type, $user]) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a href="{{ route('users.show', [$type, $nombre = $user->nombre]) }}" class="btn btn-success"><span class="oi oi-eye"></span></a>
                            <a href="{{ route('users.edit', [$type, $nombre = $user->nombre]) }}" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
@endsection