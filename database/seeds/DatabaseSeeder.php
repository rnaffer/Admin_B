<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeed::class);
    }
}

class UserTableSeed extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('nombre' => 'Administrador', 'apellido' => 'Principal', 'nick' => 'admin',
                            'direccion' => 'direccion #1', 'ciudad_id' => '1', 'telefono' => '123456789',
                            'email' => 'miemail@gmail.com', 'password' => bcrypt('1234567'), 'observacion' => 'Observacion',
                             'created_at' => new DateTime, 'updated_at' => new DateTime));
    }

}
