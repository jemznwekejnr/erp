<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\Project::factory(20)->create();
        //   \App\Models\Procurement::factory(20)->create();
        \App\Models\Logistic::factory(20)->create();
    }
}
