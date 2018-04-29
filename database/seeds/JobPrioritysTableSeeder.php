<?php

use Illuminate\Database\Seeder;

class JobPrioritysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\JobPriority::class,30)->create();
    }
}
