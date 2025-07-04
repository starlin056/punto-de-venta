@extends('layouts.app')

@section('title','Notificaciones')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

<!-- Mensaje de éxito si hay -->
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Todas las Notificaciones</h1>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-bell me-1"></i>
            Historial de Notificaciones
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table-striped fs-6">
                <thead>
                    <tr>
                        <!-- <th>Asunto</th> -->
                        <th>Mensaje</th>
                        <th>Fecha</th>
                        <th>Leído</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notificaciones as $notificacion)
                        <tr>
                            <!-- <td>{{ $notificacion->data['title'] ?? 'Sin título' }}</td> -->
                            <td>{{ $notificacion->data['message'] ?? 'Sin mensaje' }}</td>
                            <td>{{ $notificacion->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if ($notificacion->read_at)
                                    <span class="badge bg-success">Leído</span>
                                @else
                                    <span class="badge bg-warning text-dark">No leído</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush
