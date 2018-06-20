<?php

use Illuminate\Database\Seeder;

class OrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders_type')->truncate();
        
        DB::table('orders_type')->insert([
            'nombre' => 'productos',
        ]);

        DB::table('orders_type')->insert([
            'nombre' => 'servicios',
        ]);
    }
}
