<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tasks;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Tasks::factory()->create(['name' => 'Test task 1', 'done' => true]);
        Tasks::factory()->create(['name' => 'Test task 2', 'done' => false]);
        Tasks::factory()->create(['name' => 'Test task 3', 'done' => true]);
        Tasks::factory()->create(['name' => 'Test task 4', 'done' => false]);
    }
}
