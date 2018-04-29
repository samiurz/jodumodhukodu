<?php

use Illuminate\Database\Seeder;

class DocumentationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\DocumentationType::class,30)->create();
    }
}
