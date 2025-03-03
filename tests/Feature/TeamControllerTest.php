<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;

use Tests\ApiUrls;
use Tests\Fakes;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

/**
 * Check if a user can POST to /api/teams
 */
test('Test if user can create a team', function () {
    $response = $this->loginAsOwner()->post(
        ApiUrls::POST_TEAMS,
        Fakes::getFakeTeam()
    );

    $response->assertCreated();
});

/**
 * Check a POST request to /api/teams/{id}/users
 * As a team owner
 */
test('Test if user can attach a user to a team that he/she owns', function () {
    $response = $this->loginAsOwner()->post(
        strtr(
            ApiUrls::ATTACH_USER_TO_TEAM,
            [':id' => Fakes::TEAM_ID]
        ),
        Fakes::STAFF_USER_ID
    );

    $response->assertCreated();
});

/**
 * Check a POST request to /api/teams/{id}/users
 * As a user
 */
test('Test if user can attach a user to a team that he/she DO NOT own', function () {
    $response = $this->loginAsStaff()->post(
        strtr(
            ApiUrls::ATTACH_USER_TO_TEAM,
            [':id' => Fakes::TEAM_ID]
        ),
        Fakes::STAFF_USER_ID
    );

    $response->assertForbidden();
});


/**
 * Check if a POST to /api/teams will throw 422
 * when title has more than 30 characters
 */
test('Test if api validation for title when title is too big', function () {
    $response = $this->loginAsOwner()->post(
        '/api/teams',
        Fakes::INVALID_TEAM
    );

    $response->assertUnprocessable();
    $response->assertInvalid(['title']);
});

/**
 * Check if a POST to /api/teams/{id}/users will throw 422
 * when there is no user_id on the body of the request
 */
test('Test if api validation for user_id when user_id is not a number', function () {
    $response = $this->loginAsOwner()->post(
        strtr(
            ApiUrls::ATTACH_USER_TO_TEAM,
            [':id' => Fakes::TEAM_ID]
        ),
        Fakes::NULL_USER_ID
    );

    $response->assertUnprocessable();
    $response->assertInvalid(['user_id']);
});

/**
 * Check if a POST to /api/teams/{id}/users will throw 404
 * when user_id does not exists on db
 */
test('Test if api is return not found when user_id is not in db', function () {
    $response = $this->loginAsOwner()->post(
        strtr(
            ApiUrls::ATTACH_USER_TO_TEAM,
            [':id' => Fakes::TEAM_ID]
        ),
        Fakes::NOT_IN_DB_USER_ID
    );

    $response->assertNotFound();
    $response->assertJson([
        'message' => 'Hum? if you are seeing this is because something was not found. Check the body of the request and any params within the URL.',
        'data' => []
    ]);
});
