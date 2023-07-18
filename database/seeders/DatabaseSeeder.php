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

/* 
https://yunior-gp-s3.s3.amazonaws.com/sucursal/1689677911_sucursal1.jpg
https://yunior-gp-s3.s3.amazonaws.com/sucursal/1689677989_sucusal2.jpg
https://yunior-gp-s3.s3.amazonaws.com/sucursal/1689678070_sucursal3.jpg
https://yunior-gp-s3.s3.amazonaws.com/sucursal/1689678151_sucursal4.jpg
*/
        DB::table('sucursales')->insert([
            'nombre' => 'Sucursal Zona Sur',
            'descripcion' => 'Sucursal ubiacaos por la zona sur',
            'telefono' => '75302483',
            'direccion' => 'https://maps.app.goo.gl/SPQuE8kop77airbq6',
            'foto' => 'https://yunior-gp-s3.s3.amazonaws.com/sucursal/1689677911_sucursal1.jpg'

        ]);
        DB::table('sucursales')->insert([
            'nombre' => 'Sucursal Zona Norte',
            'descripcion' => 'Sucursal ubicado por la zona norte',
            'telefono' => '75302483',
            'direccion' => 'https://maps.app.goo.gl/yEXdCdbA7HmJscMN9',
            'foto' => 'https://yunior-gp-s3.s3.amazonaws.com/sucursal/1689678070_sucursal3.jpg'

        ]);

        /* Ambiente */
/* 
https://yunior-gp-s3.s3.amazonaws.com/ambiente/1689683815_CanchaDeTenis.jpg
https://yunior-gp-s3.s3.amazonaws.com/ambiente/1689683944_CanchaDeFutsal.jpg
https://yunior-gp-s3.s3.amazonaws.com/ambiente/1689684031_CanchaDeVoley.jpg
*/
        DB::table('ambientes')->insert([
            'nombre' => 'Cancha de Tenis',
            'descripcion' => 'Cancha de tenias de la zona Sur',
            'capacidad' => '12',
            'sucursal_id' => '1',
            'foto' => 'https://yunior-gp-s3.s3.amazonaws.com/ambiente/1689683815_CanchaDeTenis.jpg'

        ]);
        DB::table('ambientes')->insert([
            'nombre' => 'Cancha de Voley',
            'descripcion' => 'Cancah de Voley de la zona Norte',
            'capacidad' => '10',
            'sucursal_id' => '2',
            'foto' => 'https://yunior-gp-s3.s3.amazonaws.com/ambiente/1689684031_CanchaDeVoley.jpg'

        ]);

        /* Reservas */
        DB::table('reservas')->insert([
            'nombre' => 'reserva 1',
            'descripcion' => 'reserva de espacio',
            'precio' => '10',
            'fecha_ini' => '2021-08-01',
            'fecha_fin' => '2021-08-04',
            'ambiente_id' => '1',
            'user_id' => '1',

        ]);
        DB::table('reservas')->insert([
            'nombre' => 'reserva 2',
            'descripcion' => 'reserva de espacio 2',
            'precio' => '20',
            'fecha_ini' => '2021-09-01',
            'fecha_fin' => '2021-09-04',
            'ambiente_id' => '2',
            'user_id' => '2',

        ]);


        /*piscina*/
        /* 
        https://yunior-gp-s3.s3.amazonaws.com/piscina/1689687389_piscina1.jpg
        https://yunior-gp-s3.s3.amazonaws.com/piscina/1689687576_piscina4.jpg
        https://yunior-gp-s3.s3.amazonaws.com/piscina/1689687779_piscina3.jpg
        
        */

        DB::table('piscinas')->insert([
            'nombre' => 'piscina 1',
            'descripcion' => 'piscina ubicado por viru viru',
            'tipo' => 'rectangular',
            'largo' => '6.00',
            'ancho' => '4.00',
            'profundidad' => '3.00',
            'radio' => '0.00',
            'volumen' => '72.00',
            'sucursal_id' => '1',
            'foto' => 'https://yunior-gp-s3.s3.amazonaws.com/piscina/1689687389_piscina1.jpg'

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
            'sucursal_id' => '2',
            'foto' => 'https://yunior-gp-s3.s3.amazonaws.com/piscina/1689687576_piscina4.jpg'
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
            'sucursal_id' => '2',
            'foto' => 'https://yunior-gp-s3.s3.amazonaws.com/piscina/1689687779_piscina3.jpg'
        ]);
        
    }
}
