<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_tables = [
            'usuario',
            'ayuntamiento',
            'comercio',
            'particular',
            'publica',
            'publicacion',
            'seguido',
            'tipo_publicacion',
            'categoria',
            'token',
            'etiquetas',
            'municipio',
            'comercio_etiqueta',
            'publicacion_etiqueta'
        ];

        $perms = [];

        foreach ($all_tables as $table) {
            $ver_perm = Permission::create(['name' => 'ver_'.$table.'']);
            $crear_perm  = Permission::create(['name' => 'crear_'.$table.'']);
            $consultar_perm = Permission::create(['name' => 'consultar_'.$table.'']);
            $modificar_perm  = Permission::create(['name' => 'modificar_'.$table.'']);
            $borrar_perm  = Permission::create(['name' => 'borrar_'.$table.'']);

            array_push($perms, $ver_perm);
            array_push($perms, $crear_perm);
            array_push($perms, $consultar_perm);
            array_push($perms, $modificar_perm);
            array_push($perms, $borrar_perm);

        }

        $esAdmin = Permission::create(['name' => 'es_admin']);
        $esAyuntamiento = Permission::create(['name' => 'es_ayuntamiento']);
        $esComercio = Permission::create(['name' => 'es_comercio']);
        $esParticular = Permission::create(['name' => 'es_particular']);

        /* return the roles */

        $rol_admin = Role::findByName('admin' , 'web');
        $rol_comercio = Role::findByName('comercio' , 'web');
        $rol_ayuntamiento = Role::findByName('ayuntamiento' , 'web');
        $rol_particular = Role::findByName('particular' , 'web');

        
        //carefull  it deletes all the other permissions 
        /*$rol_admin->syncPermissions([
            $esAdmin
        ]);
        */

        $ver_usuario = Permission::findByName('ver_usuario', 'web');
        $crear_usuario = Permission::findByName('crear_usuario', 'web');
        $consultar_usuario = Permission::findByName('consultar_usuario', 'web');
        $modificar_usuario = Permission::findByName('modificar_usuario', 'web');
        $borrar_usuario = Permission::findByName('borrar_usuario', 'web');

        $ver_ayuntamiento = Permission::findByName('ver_ayuntamiento', 'web');
        $crear_ayuntamiento = Permission::findByName('crear_ayuntamiento', 'web');
        $consultar_ayuntamiento = Permission::findByName('consultar_ayuntamiento', 'web');
        $modificar_ayuntamiento = Permission::findByName('modificar_ayuntamiento', 'web');
        $borrar_ayuntamiento = Permission::findByName('borrar_ayuntamiento', 'web');

        $ver_comercio = Permission::findByName('ver_comercio', 'web');
        $crear_comercio = Permission::findByName('crear_comercio', 'web');
        $consultar_comercio = Permission::findByName('consultar_comercio', 'web');
        $modificar_comercio = Permission::findByName('modificar_comercio', 'web');
        $borrar_comercio = Permission::findByName('borrar_comercio', 'web');

        $ver_particular = Permission::findByName('ver_particular', 'web');
        $crear_particular = Permission::findByName('crear_particular', 'web');
        $consultar_particular = Permission::findByName('consultar_particular', 'web');
        $modificar_particular = Permission::findByName('modificar_particular', 'web');
        $borrar_particular = Permission::findByName('borrar_particular', 'web');

        $ver_publica = Permission::findByName('ver_publica', 'web');
        $crear_publica = Permission::findByName('crear_publica', 'web');
        $consultar_publica = Permission::findByName('consultar_publica', 'web');
        $modificar_publica = Permission::findByName('modificar_publica', 'web');
        $borrar_publica = Permission::findByName('borrar_publica', 'web');

        $ver_publicacion = Permission::findByName('ver_publicacion', 'web');
        $crear_publicacion = Permission::findByName('crear_publicacion', 'web');
        $consultar_publicacion = Permission::findByName('consultar_publicacion', 'web');
        $modificar_publicacion = Permission::findByName('modificar_publicacion', 'web');
        $borrar_publicacion = Permission::findByName('borrar_publicacion', 'web');

        $ver_seguido = Permission::findByName('ver_seguido', 'web');
        $crear_seguido = Permission::findByName('crear_seguido', 'web');
        $consultar_seguido = Permission::findByName('consultar_seguido', 'web');
        $modificar_seguido = Permission::findByName('modificar_seguido', 'web');
        $borrar_seguido = Permission::findByName('borrar_seguido', 'web');

        $ver_tipo_publicacion = Permission::findByName('ver_tipo_publicacion', 'web');
        $crear_tipo_publicacion = Permission::findByName('crear_tipo_publicacion', 'web');
        $consultar_tipo_publicacion = Permission::findByName('consultar_tipo_publicacion', 'web');
        $modificar_tipo_publicacion = Permission::findByName('modificar_tipo_publicacion', 'web');
        $borrar_tipo_publicacion = Permission::findByName('borrar_tipo_publicacion', 'web');

        $ver_categoria = Permission::findByName('ver_categoria', 'web');
        $crear_categoria = Permission::findByName('crear_categoria', 'web');
        $consultar_categoria = Permission::findByName('consultar_categoria', 'web');
        $modificar_categoria = Permission::findByName('modificar_categoria', 'web');
        $borrar_categoria = Permission::findByName('borrar_categoria', 'web');

        $ver_token = Permission::findByName('ver_token', 'web');
        $crear_token = Permission::findByName('crear_token', 'web');
        $consultar_token = Permission::findByName('consultar_token', 'web');
        $modificar_token = Permission::findByName('modificar_token', 'web');
        $borrar_token = Permission::findByName('borrar_token', 'web');

        $ver_etiquetas = Permission::findByName('ver_etiquetas', 'web');
        $crear_etiquetas = Permission::findByName('crear_etiquetas', 'web');
        $consultar_etiquetas = Permission::findByName('consultar_etiquetas', 'web');
        $modificar_etiquetas = Permission::findByName('modificar_etiquetas', 'web');
        $borrar_etiquetas = Permission::findByName('borrar_etiquetas', 'web');

        $ver_municipio = Permission::findByName('ver_municipio', 'web');
        $crear_municipio = Permission::findByName('crear_municipio', 'web');
        $consultar_municipio = Permission::findByName('consultar_municipio', 'web');
        $modificar_municipio = Permission::findByName('modificar_municipio', 'web');
        $borrar_municipio = Permission::findByName('borrar_municipio', 'web');

        $ver_comercio_etiqueta = Permission::findByName('ver_comercio_etiqueta', 'web');
        $crear_comercio_etiqueta = Permission::findByName('crear_comercio_etiqueta', 'web');
        $consultar_comercio_etiqueta = Permission::findByName('consultar_comercio_etiqueta', 'web');
        $modificar_comercio_etiqueta = Permission::findByName('modificar_comercio_etiqueta', 'web');
        $borrar_comercio_etiqueta = Permission::findByName('borrar_comercio_etiqueta', 'web');

        $ver_publicacion_etiqueta = Permission::findByName('ver_publicacion_etiqueta', 'web');
        $crear_publicacion_etiqueta = Permission::findByName('crear_publicacion_etiqueta', 'web');
        $consultar_publicacion_etiqueta = Permission::findByName('consultar_publicacion_etiqueta', 'web');
        $modificar_publicacion_etiqueta = Permission::findByName('modificar_publicacion_etiqueta', 'web');
        $borrar_publicacion_etiqueta = Permission::findByName('borrar_publicacion_etiqueta', 'web');

        foreach ($perms as $perm) {
            echo ("[Permisos creados] ........................................................  " .$perm->name. PHP_EOL);
            $rol_admin->givePermissionTo($perm->name);
        }
        
        $rol_admin->givePermissionTo('es_admin');

        $rol_ayuntamiento->syncPermissions([
            $esAyuntamiento, 
            $ver_particular, $consultar_particular,
            $ver_usuario, $consultar_usuario, 
            $ver_ayuntamiento,  $consultar_ayuntamiento, $modificar_ayuntamiento,
            $ver_comercio,  $consultar_comercio, $modificar_comercio, $borrar_comercio,
            $ver_publicacion, $consultar_publicacion, $modificar_publicacion, $borrar_publicacion, 
            $ver_seguido, $consultar_seguido, $crear_seguido,
            $ver_tipo_publicacion,
            $ver_categoria,
            $ver_etiquetas, $consultar_etiquetas,
            $ver_municipio, $consultar_municipio,
            $ver_publicacion_etiqueta,
            $ver_comercio_etiqueta,
        ]);

        $rol_comercio->syncPermissions([
            $esComercio,
            $ver_usuario, $consultar_usuario,
            $ver_particular, $consultar_particular,
            $ver_ayuntamiento,  $consultar_ayuntamiento, 
            $ver_comercio,  $consultar_comercio, $modificar_comercio, 
            $ver_publicacion, $consultar_publicacion, $modificar_publicacion, $borrar_publicacion, 
            $ver_seguido, $consultar_seguido, $crear_seguido,
            $ver_tipo_publicacion, 
            $ver_categoria,
            $ver_etiquetas, $consultar_etiquetas,
            $ver_municipio, $consultar_municipio,
            $ver_publicacion_etiqueta,
            $ver_comercio_etiqueta
        ]);

        $rol_particular->syncPermissions([
            $esParticular,
            $ver_usuario, $consultar_usuario, 
            $ver_particular, $consultar_particular, $modificar_particular, 
            $ver_ayuntamiento,  $consultar_ayuntamiento, 
            $ver_comercio,  $consultar_comercio, 
            $ver_publicacion, $consultar_publicacion, 
            $ver_seguido, $consultar_seguido, $crear_seguido,
            $ver_tipo_publicacion, $consultar_tipo_publicacion, 
            $ver_categoria, $consultar_categoria, 
            $ver_etiquetas, $consultar_etiquetas,
            $ver_municipio, $consultar_municipio,
            $ver_publicacion_etiqueta,
            $ver_comercio_etiqueta
        ]);

        /* asignación de admin */

        $admin = User::find(1);
        $admin->assignRole('admin');
    }
}
