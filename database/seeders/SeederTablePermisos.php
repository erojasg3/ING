<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class SeederTablePermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos=[
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            'ver-producto',
            'crear-producto',
            'editar-producto',
            'borrar-producto'
        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);

        }
    }
}
