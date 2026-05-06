@extends('layouts.app')

@section('title', 'Detalle de Tarea')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detalle de Tarea</h4>
                <span class="badge {{ $task->status === 'completed' ? 'bg-success' : 'bg-warning text-dark' }} fs-6">
                    {{ $task->status === 'completed' ? 'Completada' : 'Pendiente' }}
                </span>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9">{{ $task->id }}</dd>

                    <dt class="col-sm-3">Título</dt>
                    <dd class="col-sm-9">{{ $task->title }}</dd>

                    <dt class="col-sm-3">Descripción</dt>
                    <dd class="col-sm-9">{{ $task->description ?? '—' }}</dd>

                    <dt class="col-sm-3">Estado</dt>
                    <dd class="col-sm-9">{{ $task->status === 'completed' ? 'Completada' : 'Pendiente' }}</dd>

                    <dt class="col-sm-3">Creado</dt>
                    <dd class="col-sm-9">{{ $task->created_at->format('d/m/Y H:i') }}</dd>

                    <dt class="col-sm-3">Actualizado</dt>
                    <dd class="col-sm-9">{{ $task->updated_at->format('d/m/Y H:i') }}</dd>
                </dl>
            </div>
            <div class="card-footer d-flex gap-2">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('tasks.destroy', $task) }}"
                      method="POST"
                      onsubmit="return confirm('¿Eliminar esta tarea?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary ms-auto">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
