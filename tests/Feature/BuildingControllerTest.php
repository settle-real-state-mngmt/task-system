<?php

use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\Response;
use Tests\ApiUrls;
use Tests\Fakes;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

/**
 * Check if a user can POST to /api/buildings
 */
test('Test if a user can create a building', function () {
    $response = $this->loginAsOwner()->post(
        ApiUrls::POST_BUILDINGS,
        Fakes::FAKE_BUILDING
    );

    $response->assertStatus(Response::HTTP_CREATED);
});

/**
 * Check a POST request to /api/buildings/{id}/tasks
 * As a building owner
 */
test('Test if a user(as the owner) can create a task for a building', function () {
    $response = $this->loginAsOwner()->post(
        strtr(ApiUrls::POST_ADD_TASK_TO_TEAM, [':id' => Fakes::FAKE_BUILDING_ID]),
        Fakes::FAKE_TASK
    );

    $response->assertStatus(Response::HTTP_CREATED);
});
