<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "bahi",
            'surname' => "boris",
            'pseudo' => "bboris",
            'role_id' => 1,
            'email' => "bboris@primumci.com",
            'sexe' => "m",
            'isactif' => "1",
            'isconnected' => "0",
            'password' => bcrypt('B@HIB@HI2104')
        ]);
    }
}