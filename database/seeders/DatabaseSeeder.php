<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Building;
use App\Models\Team;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $owner = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.org',
            'password' => 'password',
        ]);

        $teamMember = User::factory()->create([
            'name' => 'Alan Doe',
            'email' => 'alandoe@example.org',
            'password' => 'password',
        ]);

        $building = Building::factory()->create([
            'name' => 'Doe Building',
            'owner_id' => User::first()->id
        ]);

        $team = Team::factory()->create(['owner_id' => $owner->id]);
    }
}
