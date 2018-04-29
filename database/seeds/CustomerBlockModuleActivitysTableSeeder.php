<?php

use Illuminate\Database\Seeder;

class CustomerBlockModuleActivitysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CustomerBlockModuleActivity::class,30)->create();
    }
}
