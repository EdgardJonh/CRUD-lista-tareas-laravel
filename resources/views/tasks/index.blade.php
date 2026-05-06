@extends('layouts.app')

@section('title', 'Lista de Tareas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Lista de Tareas</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Nueva Tarea</a>
</div>

@if($tasks->isEmpty())
    <div class="alert alert-info">
        No hay tareas registradas. <a href="{{ route('tasks.create') }}">Crea la primera</a>.
    </div>
@else
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Creado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td><strong>{{ $task->title }}</strong></td>
                    <td>{{ Str::limit($task->description, 60) }}</td>
                    <td>
                        <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="badge border-0 {{ $task->status === 'completed' ? 'bg-success' : 'bg-warning text-dark' }}" style="cursor:pointer">
                                {{ $task->status === 'completed' ? 'Completada' : 'Pendiente' }}
                            </button>
                        </form>
                    </td>
                    <td>{{ $task->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('tasks.show', $task) }}"
                           class="btn btn-sm btn-outline-info">Ver</a>
                        <a href="{{ route('tasks.edit', $task) }}"
                           class="btn btn-sm btn-outline-warning">Editar</a>
                        <form action="{{ route('tasks.destroy', $task) }}"
                              method="POST"
                              style="display:inline"
                              onsubmit="return confirm('¿Eliminar esta tarea?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $tasks->links() }}
</div>
@endif
@endsection
