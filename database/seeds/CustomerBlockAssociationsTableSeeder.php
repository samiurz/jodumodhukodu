<?php

use Illuminate\Database\Seeder;

class CustomerBlockAssociationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CustomerBlockAssociation::class,30)->create();
    }
}
