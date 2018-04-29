<?php

use Illuminate\Database\Seeder;

class ModelTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ModelType::class,30)->create();
    }
}
