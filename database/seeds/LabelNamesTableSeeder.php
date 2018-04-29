<?php

use Illuminate\Database\Seeder;

class LabelNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\LabelName::class,30)->create();
    }
}
