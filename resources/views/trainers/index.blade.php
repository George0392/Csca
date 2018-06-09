@extends('admin')

@section('content2')
    
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3">{{ $titulo }}</h1>
        <p>
            <a href="{{route('trainers.create')}}" class="btn btn-primary">Nuevo Profesor</a>
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
            @foreach ($trainers as $trainer)
            <tr>
                <th scope="row">{{ $trainer->id }}</th>
                <td>{{ $trainer->nombre }}</td>
                <td>{{ $trainer->telefono }}</td>
                <td>{{ $trainer->email }}</td>
                <td>
                    <form action="{{ route('trainers.delete', $trainer) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <a href="{{ route('trainers.show', $trainer) }}" class="btn btn-success"><span class="oi oi-eye"></span></a>
                        <a href="{{ route('trainers.edit', $trainer) }}" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                        <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
@endsection