<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSedeer::class);
        $this->call(CreateSubjectNames::class);
        $this->call(DefaultProfesor::class);
        $this->call(DefaultStudents::class);
    }
}
