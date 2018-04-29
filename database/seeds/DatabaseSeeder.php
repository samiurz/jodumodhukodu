<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccountsTableSeeder::class);
        $this->call(CompanysTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(AccountBlockAssociationsTableSeeder::class);
        $this->call(ActivitysTableSeeder::class);
        $this->call(AssetImageRecordsTableSeeder::class);
        $this->call(AssetModelsTableSeeder::class);
        $this->call(AssetsTableSeeder::class);
        $this->call(BlocksTableSeeder::class);
        $this->call(BlockStatsTableSeeder::class);
        $this->call(CustomerBlockAssociationsTableSeeder::class);
        $this->call(CustomerBlockModuleActivitysTableSeeder::class);
        $this->call(DocumentationTypesTableSeeder::class);
        $this->call(FaultTypesTableSeeder::class);
        $this->call(JobPrioritysTableSeeder::class);
        $this->call(JobTypesTableSeeder::class);
        $this->call(LabelNamesTableSeeder::class);
        $this->call(ModelTypesTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(RoleTypesTableSeeder::class);
        $this->call(SparesTableSeeder::class);
    }
}
