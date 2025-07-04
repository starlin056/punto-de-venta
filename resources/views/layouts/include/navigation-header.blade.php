<?php

use App\Models\Empresa;

$empresa = Empresa::first();
?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Marca de la empresa -->
    <a class="navbar-brand ps-2" href="{{ route('panel') }}">
        {{ $empresa->nombre ?? 'Mi Empresa' }}
    </a>

    <!-- Botón de menú lateral -->
    <button class="btn btn-link btn-sm order-2 order-lg-3 me-5 me-lg-5" id="sidebarToggle">
        <i class="fas fa-list"></i>
    </button>

    <!-- Buscador -->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" name="search" type="text" placeholder="Buscar..." aria-label="Buscar" />
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <!-- Notificaciones -->
    @php
    $user = Auth::user();

    // Traer las últimas 3 notificaciones (leídas y no leídas)
    $notifications = $user->notifications()->latest()->take(3)->get();

    // Verificar si hay notificaciones recientes sin leer
    $unreadCount = $user->unreadNotifications()->count();

    // Determinar si hay notificaciones recientes para mostrar
    $showNotifications = false;

    if ($notifications->isNotEmpty()) {
    // Última notificación
    $lastNotification = $notifications->first();

    // Si la última notificación fue creada hace menos de 1 día, mostrar
    if ($lastNotification->created_at->diffInDays(now()) < 1) {
        $showNotifications=true;
        }
        }
        @endphp

        <div class="nav-item dropdown me-3">
        <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown"
            role="button" data-bs-toggle="dropdown" aria-expanded="false"
            title="Ver notificaciones" aria-label="Notificaciones">
            <i class="fas fa-bell"></i>
            @if($unreadCount > 0)
            <span class="badge bg-danger rounded-pill">{{ $unreadCount }}</span>
            @endif
        </a>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown" style="min-width: 300px;">
            @if ($showNotifications)
            @foreach ($notifications as $notification)
            <li>
                <a href="#" class="dropdown-item {{ $notification->read_at ? '' : 'fw-bold' }}">
                    {{ $notification->data['message'] ?? 'Nueva notificación' }}
                    <br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </a>
            </li>
            @endforeach
            @else
            <li class="text-center p-2">
                <i class="fas fa-inbox fa-2x text-muted mb-2"></i><br>
                <span class="text-muted">No hay notificaciones recientes</span>
            </li>
            @endif

            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-center" href="{{ route('notificaciones.index') }}">Ver todas las notificaciones</a></li>

        </ul>
        </div>


        <!-- Menú de usuario -->
        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @can('ver-perfil')
                    <li><a class="dropdown-item" href="{{ route('profile.index') }}">Configuraciones</a></li>
                    @endcan
                    @can('ver-registro-actividad')
                    <li><a class="dropdown-item" href="{{ route('Activitylog.index') }}">Registro de actividad</a></li>
                    @endcan
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
</nav>