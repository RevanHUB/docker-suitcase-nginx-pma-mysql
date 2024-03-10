<?php

namespace Database\Seeders;
/* factories */
use Database\Factories\MunicipioFactory;
use Database\Factories\CategoriaFactory;
use Database\Factories\EtiquetasFactory;
use Database\Factories\TipoPublicacionFactory;
use Database\Factories\RoleFactory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

/* seeders*/
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermissionsSeeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        /* primero las tablas sin relaciones*/
        \App\Models\Token::factory(10)->create();

        \App\Models\Municipio::factory(count(MunicipioFactory::$municipios))->create();
        \App\Models\Categoria::factory(count(CategoriaFactory::$categorias))->create();
        \App\Models\TipoPublicacion::factory(count(TipoPublicacionFactory::$tipos))->create();
        EtiquetasFactory::new()->count(count(EtiquetasFactory::$categorias))->create();

        /*tablas con relaciones*/
        \App\Models\UsuarioAdministrador::factory(1)->create();
        \App\Models\UsuarioAyuntamiento::factory(count(MunicipioFactory::$municipios))->create();
        \App\Models\UsuarioParticular::factory(count(MunicipioFactory::$municipios))->create();
        \App\Models\UsuarioComercio::factory(count(MunicipioFactory::$municipios))->create();

        \App\Models\Ayuntamiento::factory(count(MunicipioFactory::$municipios))->create();  /*  1 al 5*/
        \App\Models\Particular::factory(count(MunicipioFactory::$municipios))->create(); /*  6 al 10*/
        \App\Models\Comercio::factory(count(MunicipioFactory::$municipios))->create(); /*  11 al 15*/

        \Database\Factories\SeguidosFactory::new()->count(5)->create();

        \App\Models\Publicacion::factory(5)->create();
        
        /* tablas N:M */
        \App\Models\Publica::factory(5)->create();
        \App\Models\EtiquetaPublicacion::factory(5)->create();
        
        $this->call([
            RoleSeeder::class,
            PermissionsSeeder::class
        ]);

    }
}
