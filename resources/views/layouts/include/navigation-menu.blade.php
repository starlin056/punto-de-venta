<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <!-- INICIO -->
                <x-nav.heading>Inicio</x-nav.heading>
                <x-nav.nav-link
                    content="Panel"
                    icon="fas fa-tachometer-alt"
                    :href="route('panel')" />

                <!-- INVENTARIO -->
                <x-nav.heading>Inventario</x-nav.heading>
                <x-nav.link-collapsed id="collapseInventario" icon="fa-solid fa-boxes-stacked" content="Gestión de Inventario">

                    @can('ver-categoria')
                    <x-nav.link-collapsed-iten :href="route('categorias.index')" content="Categorías" />
                    @endcan

                    @can('ver-presentacione')
                    <x-nav.link-collapsed-iten :href="route('presentaciones.index')" content="Presentaciones" />
                    @endcan

                    @can('ver-marca')
                    <x-nav.link-collapsed-iten :href="route('marcas.index')" content="Marcas" />
                    @endcan

                    @can('ver-producto')
                    <x-nav.link-collapsed-iten :href="route('productos.index')" content="Productos" />
                    @endcan

                    @can('ver-inventario')
                    <x-nav.link-collapsed-iten :href="route('inventario.index')" content="Inventario General" />
                    @endcan

                </x-nav.link-collapsed>

                @can('ver-kardex')
                <x-nav.nav-link content="Kardex" icon="fa-solid fa-file-lines" :href="route('kardex.index')" />
                @endcan

                
                <!-- COMPRAS -->
                @can('ver-compra')
                <x-nav.heading>Compras</x-nav.heading>
                <x-nav.link-collapsed id="collapseCompras" icon="fa-solid fa-cart-flatbed" content="Módulo Compras">
                    @can('ver-compra')
                    <x-nav.link-collapsed-iten :href="route('compras.index')" content="Ver Compras" />
                    @endcan
                    @can('crear-compra')
                    <x-nav.link-collapsed-iten :href="route('compras.create')" content="Nueva Compra" />
                    @endcan
                </x-nav.link-collapsed>
                @endcan

                <!-- VENTAS -->
                @can('ver-venta')
                <x-nav.heading>Ventas</x-nav.heading>
                <x-nav.link-collapsed id="collapseVentas" icon="fa-solid fa-cart-shopping" content="Módulo Ventas">
                    @can('ver-venta')
                    <x-nav.link-collapsed-iten :href="route('ventas.index')" content="Ver Ventas" />
                    @endcan
                    @can('crear-compra')
                    <x-nav.link-collapsed-iten :href="route('ventas.create')" content="Nueva Venta" />
                    @endcan
                </x-nav.link-collapsed>
                @endcan

                <!-- CAJA -->
                @can('ver-caja')
                <x-nav.heading>Cajas</x-nav.heading>
                <x-nav.nav-link
                    content="Gestión de Cajas"
                    icon="fa-solid fa-money-bill-wave"
                    :href="route('cajas.index')" />
                @endcan

                <!-- PERSONAS -->
                <x-nav.heading>Gestión de Personas</x-nav.heading>
                @can('ver-cliente')
                <x-nav.nav-link content="Clientes" icon="fa-solid fa-users" :href="route('clientes.index')" />
                @endcan
                @can('ver-proveedore')
                <x-nav.nav-link content="Proveedores" icon="fa-solid fa-handshake" :href="route('proveedores.index')" />
                @endcan


                <!-- ADMINISTRACIÓN -->
                @hasrole('administrador')
                <x-nav.heading>Administración</x-nav.heading>

                @can('ver-empresa')
                <x-nav.nav-link content="Empresa" icon="fa-solid fa-city" :href="route('empresa.index')" />
                @endcan

                @can('ver-empleado')
                <x-nav.nav-link content="Empleados" icon="fa-solid fa-user-tie" :href="route('empleados.index')" />
                @endcan

                @can('ver-user')
                <x-nav.nav-link content="Usuarios" icon="fa-solid fa-user" :href="route('users.index')" />
                @endcan

                @can('ver-role')
                <x-nav.nav-link content="Roles" icon="fa-solid fa-key" :href="route('roles.index')" />
                @endcan
                @endhasrole

            </div>
        </div>

        <!-- FOOTER -->
        <div class="sb-sidenav-footer" style="background-color: #343a40; color: #fff; padding: 11px; text-align: center; border-top: 2px solid rgb(235, 0, 0);">
            <div class="small">Bienvenido:</div>
            {{ auth()->user()->name }}
        </div>
    </nav>
</div>