<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* admin */
        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@argon.com',
            'password' => bcrypt('secret'),
            'rol' => 'admin',
        ]);
        /* administrativo */


        DB::table('users')->insert([
            'username' => 'ricardo',
            'email' => 'ricardo@example.com',
            'password' => bcrypt('secret'),
            'rol' => 'administrativo',
        ]);
        DB::table('users')->insert([
            'username' => 'ivan',
            'email' => 'ivan@example.com',
            'password' => bcrypt('secret'),
            'rol' => 'administrativo',
        ]);

        /* personal */
        DB::table('users')->insert([
            'username' => 'leo',
            'email' => 'leo@example.com',
            'password' => bcrypt('secret'),
            'rol' => 'personal',
        ]);
        DB::table('users')->insert([
            'username' => 'teo',
            'email' => 'teo@example.com',
            'password' => bcrypt('secret'),
            'rol' => 'personal',
        ]);

        /* usuario */
        DB::table('users')->insert([
            'username' => 'mia',
            'email' => 'mia@example.com',
            'password' => bcrypt('secret'),
            'rol' => 'usuario',
        ]);
        DB::table('users')->insert([
            'username' => 'ana',
            'email' => 'ana@example.com',
            'password' => bcrypt('secret'),
            'rol' => 'usuario',
        ]);

        /* Sucursal  */


        DB::table('sucursales')->insert([
            'nombre' => 'Sucursal 1',
            'descripcion' => 'Sucursal ubicado por vivru viru',
            'telefono' => '1234567',
            'direccion' => 'https://maps.app.goo.gl/SPQuE8kop77airbq6',
            'imagen' => 'https://www.eldiario.net/noticias/2019/2019_08/nt190822/principal.php?n=50&-sucursal-de-la-empresa-estatal-de-transporte-aereo-militar',

        ]);
        DB::table('sucursales')->insert([
            'nombre' => 'Sucursal 2',
            'descripcion' => 'Sucursal ubicado por cambodromo',
            'telefono' => '1234567',
            'direccion' => 'https://maps.app.goo.gl/yEXdCdbA7HmJscMN9',
            'imagen' => 'https://www.eldiario.net/noticias/2019/2019_08/nt190822/principal.php?n=50&-sucursal-de-la-empresa-estatal-de-transporte-aereo-militar',

        ]);

        /* Ambiente */

        DB::table('ambientes')->insert([
            'nombre' => 'Ambiente 1',
            'descripcion' => 'Ambiente ubicado por vivru viru',
            'capacidad' => '10',
            'imagen' => 'https://www.eldiario.net/noticias/2019/2019_08/nt190822/principal.php?n=50&-sucursal-de-la-empresa-estatal-de-transporte-aereo-militar',
            'sucursal_id' => '1',

        ]);
        DB::table('ambientes')->insert([
            'nombre' => 'Ambiente 2',
            'descripcion' => 'Ambiente ubicado por cambodromo',
            'capacidad' => '10',
            'imagen' => 'https://www.eldiario.net/noticias/2019/2019_08/nt190822/principal.php?n=50&-sucursal-de-la-empresa-estatal-de-transporte-aereo-militar',
            'sucursal_id' => '2',

        ]);

        /* Reservas */
        DB::table('reservas')->insert([
            'nombre' => 'reserva 1',
            'descripcion' => 'reserva de espacio',
            'precio' => '10',
            'fecha_ini' => '2021-08-01',
            'fecha_fin' => '2021-08-04',
            'imagen' => 'https://www.eldiario.net/noticias/2019/2019_08/nt190822/principal.php?n=50&-sucursal-de-la-empresa-estatal-de-transporte-aereo-militar',
            'ambiente_id' => '1',
            'user_id' => '1',

        ]);
        DB::table('reservas')->insert([
            'nombre' => 'reserva 2',
            'descripcion' => 'reserva de espacio 2',
            'precio' => '20',
            'fecha_ini' => '2021-09-01',
            'fecha_fin' => '2021-09-04',
            'imagen' => 'https://www.eldiario.net/noticias/2019/2019_08/nt190822/principal.php?n=50&-sucursal-de-la-empresa-estatal-de-transporte-aereo-militar',
            'ambiente_id' => '2',
            'user_id' => '2',

        ]);


        /*piscina*/

        DB::table('piscinas')->insert([
            'nombre' => 'piscina 1',
            'descripcion' => 'piscina ubicado por viru viru',
            'tipo' => 'rectangular',
            'largo' => '6.00',
            'ancho' => '4.00',
            'profundidad' => '3.00',
            'radio' => '0.00',
            'volumen' => '72.00',
            'imagen' => 'https://www.eldiario.net/noticias/2019/2019_08/nt190822/principal.php?n=50&-sucursal-de-la-empresa-estatal-de-transporte-aereo-militar',
            'sucursal_id' => '1',

        ]);

        DB::table('piscinas')->insert([
            'nombre' => 'piscina 2',
            'descripcion' => 'piscina ubicado por cambodromo',
            'tipo' => 'rectangular',
            'largo' => '6.00',
            'ancho' => '5.00',
            'profundidad' => '3.00',
            'radio' => '0.00',
            'volumen' => '90.00',
            'imagen' => 'https://www.eldiario.net/noticias/2019/2019_08/nt190822/principal.php?n=50&-sucursal-de-la-empresa-estatal-de-transporte-aereo-militar',
            'sucursal_id' => '2',

        ]);
    }
}
