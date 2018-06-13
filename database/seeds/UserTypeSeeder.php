<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->truncate();
        
        DB::table('user_types')->insert([
            'nombre' => 'encargado',
        ]);

        DB::table('user_types')->insert([
            'nombre' => 'empleado',
        ]);

        DB::table('user_types')->insert([
            'nombre' => 'cliente',
        ]);
    }
}
