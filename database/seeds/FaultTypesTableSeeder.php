<?php

use Illuminate\Database\Seeder;

class FaultTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\FaultType::class,30)->create();
    }
}
