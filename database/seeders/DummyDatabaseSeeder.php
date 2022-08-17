<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DummyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DummyAdminSeeder::class,
            DummyUserSeeder::class,
        ]);
    }
}
