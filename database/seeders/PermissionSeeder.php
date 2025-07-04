<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [

            //ver registro de actividad
            'ver-registro-actividad',

            //Caja
            'ver-caja',
            'aperturar-caja',
            'cerrar-caja',

            //kardex
            'ver-kardex',
    
            //categorías
            'ver-categoria',
            'crear-categoria',
            'editar-categoria',
            'eliminar-categoria',

            //Cliente
            'ver-cliente',
            'crear-cliente',
            'editar-cliente',
            'eliminar-cliente',

            //Compra
            'ver-compra',
            'crear-compra',
            'mostrar-compra',
            
            //Empleado
            'ver-empleado',
            'crear-empleado',
            'editar-empleado',
            'eliminar-empleado',

            //empresa
            'ver-empresa',
            'update-empresa',

            //inventario
            'ver-inventario',
            'crear-inventario',

            //Marca
            'ver-marca',
            'crear-marca',
            'editar-marca',
            'eliminar-marca',

            //movimientos de caja
            'ver-movimiento',
            'crear-movimiento',

            //Presentacione
            'ver-presentacione',
            'crear-presentacione',
            'editar-presentacione',
            'eliminar-presentacione',

            //Producto
            'ver-producto',
            'crear-producto',
            'editar-producto',

            //perfil
            'ver-perfil',
            'editar-perfil',

            //Proveedore
            'ver-proveedore',
            'crear-proveedore',
            'editar-proveedore',
            'eliminar-proveedore',

            //Venta
            'ver-venta',
            'crear-venta',
            'mostrar-venta',


            //Roles
            'ver-role',
            'crear-role',
            'editar-role',
            'eliminar-role',

            //User
            'ver-user',
            'crear-user',
            'editar-user',
            'eliminar-user',


        ];

        foreach($permisos as $permiso){
            Permission::create(['name' => $permiso]);
        }
    }
}
