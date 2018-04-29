<?php

use Illuminate\Database\Seeder;

class AccountBlockAssociationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AccountBlockAssociation::class,30)->create();
    }
}
