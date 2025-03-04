<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Building;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * This is necessary for tests purposes as for each test
         * that the DatabaseSeeder is run AND postgresql or mysql
         * is being used instead of sqlite the ids need to be reseted.
         */
        DB::statement('TRUNCATE TABLE buildings RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE tasks RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE teams RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE users RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE comments RESTART IDENTITY CASCADE');

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

        $teamMember2 = User::factory()->create([
            'name' => 'Abby Doe',
            'email' => 'abbydoe@example.org',
            'password' => 'password',
        ]);


        $randomUser = User::factory()->create([
            'name' => 'Random Doe',
            'email' => 'randomdoe@example.org',
            'password' => 'password',
        ]);


        $building = Building::factory()->create([
            'name' => 'Doe Building',
            'owner_id' => User::first()->id
        ]);

        $team = Team::factory()->create(['owner_id' => $owner->id]);
        $team->users()->attach($teamMember);
        $team->users()->attach($teamMember2);

        Task::factory(2)->create([
            'user_id' => $teamMember->id,
            'building_id' => $building->id
        ]);

        Comment::factory()->create(['task_id' => 1, 'user_id' => $owner->id]);
        Comment::factory()->create(['task_id' => 1, 'user_id' => $owner->id]);
    }
}
