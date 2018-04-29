<?php

use Illuminate\Database\Seeder;

class RoleTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RoleType::class,30)->create();
    }
}
