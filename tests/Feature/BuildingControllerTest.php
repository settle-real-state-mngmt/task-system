<?php

use Database\Seeders\DatabaseSeeder;

use Tests\ApiUrls;
use Tests\Fakes;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

/**
 *
 */
test('Test if a building owner can herhehrehreget tasks from an own building', function () {
    $response = $this->loginAsOwner()->get(
        strtr(ApiUrls::GET_BUILDING_TASKS, [':id' => Fakes::FAKE_BUILDING_ID]),
    );

    $response->assertOk();
    $response->assertExactJsonStructure([
        'message',
        'data' => [
            '*' => [
                'id',
                'title',
                'status',
                'description',
                'assignee',
                'created_at',
                'task_comments' => [
                    '*' => [
                        'id',
                        'name',
                        'content'
                    ]
                ]
            ],
        ],
        'current_page',
        'path',
        'first_page_url',
        'from',
        'next_page_url',
        'per_page',
        'prev_page_url',
    ]);
});

test('Test if a staff can get tasks from a building that is working for', function () {
    $response = $this->loginAsStaff()->get(
        strtr(ApiUrls::GET_BUILDING_TASKS, [':id' => Fakes::FAKE_BUILDING_ID]),
    );

    $response->assertOk();
});

test('Test if a user can\'t get tasks from a building that is not working for', function () {
    $response = $this->loginAsNonStaff()->get(
        strtr(ApiUrls::GET_BUILDING_TASKS, [':id' => Fakes::FAKE_BUILDING_ID]),
    );

    $response->assertForbidden();
});

/**
 * Check if a user can POST to /api/buildings
 */
test('Test if a user can create a building', function () {
    $response = $this->loginAsOwner()->post(
        ApiUrls::BUILDINGS,
        Fakes::FAKE_BUILDING
    );

    $response->assertCreated();
    $response->assertExactJsonStructure([
        'message',
        'data' => ['id', 'owner_id', 'name', 'created_at', 'updated_at'],
    ]);
});

/**
 * Checks if passing a name with more than 15 characters
 * returns unprocessable status and errors
 *
 * @Validation rules
 * 'name' => ['required', 'max:15']
 */
test('Test if a passing a invalid building name value returns error', function () {
    $response = $this->loginAsOwner()->post(
        ApiUrls::BUILDINGS,
        Fakes::INVALID_BUILDING_NAME
    );

    $response->assertUnprocessable();
    $response->assertInvalid(['name']);
});

/**
 * Checks if passing a body with no key = name
 * returns unprocessable status and errors
 *
 * @Validation rules
 * 'name' => ['required', 'max:15']
 */
test('Test if a passing a invalid building name key returns error', function () {
    $response = $this->loginAsOwner()->post(
        ApiUrls::BUILDINGS,
        Fakes::INVALID_BUILDING_NAME_NO_KEY
    );

    $response->assertUnprocessable();
    $response->assertInvalid(['name']);
});


/**
 * Check a POST request to /api/buildings/{id}/tasks
 * As a building owner
 */
test('Test if a user(as the owner) can create a task for a building', function () {
    $response = $this->loginAsOwner()->post(
        strtr(ApiUrls::ADD_TASK_TO_TEAM, [':id' => Fakes::FAKE_BUILDING_ID]),
        Fakes::FAKE_TASK
    );

    $response->assertCreated();
    $response->assertExactJsonStructure([
        'message',
        'data' => [
            [
                'id',
                'owner_id',
                'name',
                'created_at',
                'updated_at',
                'tasks' => [
                    '*' => ['id', 'title', 'status', 'description', 'user_id', 'building_id', 'created_at', 'updated_at']
                ],
            ],
        ]
    ]);
});
