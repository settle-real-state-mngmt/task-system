<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Building;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Alan Doe',
            'email' => 'alandoe@example.org',
            'password' => 'password',
        ]);

        Building::factory()->create([
            'name' => 'Doe Building',
            'owner_id' => User::first()->id
        ]);
    }
}
