<?php

use Illuminate\Database\Seeder;

class DefaultStudents extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'  => 3,
            'name'     => 'Ismael',
            'lastname' => 'Haro',
            'email'    => 'ismael@gmail.com',
            'password' => bcrypt('password'),
            'key'      => '201207205',
            'phone'    => '120309123'
        ]);

        DB::table('users')->insert([
            'role_id'  => 3,
            'name'     => 'Gerardo',
            'lastname' => 'Moxca',
            'email'    => 'gerardo@gmail.com',
            'password' => bcrypt('password'),
            'key'      => '201203692',
            'phone'    => '120309123'
        ]);

        DB::table('users')->insert([
            'role_id'  => 3,
            'name'     => 'Luis',
            'lastname' => 'Hernández',
            'email'    => 'luis@gmail.com',
            'password' => bcrypt('password'),
            'key'      => '201215565',
            'phone'    => '120309123'
        ]);
    }
}
