<?php

use Illuminate\Database\Seeder;

class ActivitysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Activity::class,30)->create();
    }
}
