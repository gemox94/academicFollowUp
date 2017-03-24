<?php

use Illuminate\Database\Seeder;

class DefaultProfesor extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'  => 2,
            'name'     => 'John',
            'lastname' => 'Doe',
            'email'    => 'john@gmail.com',
            'password' => bcrypt('password'),
            'key'      => 'oaksod',
            'cubicle'  => '104C 202',
            'phone'    => '120309123'
        ]);
    }
}
