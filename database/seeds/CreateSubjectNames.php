<?php

use Illuminate\Database\Seeder;

class CreateSubjectNames extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subject_names')->insert([
            'name' => 'Metodología de la Programación',
        ]);

        DB::table('subject_names')->insert([
            'name' => 'Programación 1',
        ]);

        DB::table('subject_names')->insert([
            'name' => 'Programación 2',
        ]);

        DB::table('subject_names')->insert([
            'name' => 'Estructuras de Datos',
        ]);

        DB::table('subject_names')->insert([
            'name' => 'Programación Concurrente y Paralela',
        ]);

        DB::table('subject_names')->insert([
            'name' => 'Programación Distribuida',
        ]);
    }
}
