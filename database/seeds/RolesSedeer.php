<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id'    => 1,
            'name' => 'coordinator',
        ]);

        DB::table('roles')->insert([
            'id'    => 2,
            'name' => 'teacher',
        ]);

        DB::table('roles')->insert([
            'id'    => 3,
            'name' => 'student',
        ]);
    }
}
