<?php

use Illuminate\Database\Seeder;

class AssetImageRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AssetImageRecord::class,30)->create();
    }
}
