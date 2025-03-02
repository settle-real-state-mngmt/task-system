<?php

namespace Tests\Feature;

use Illuminate\Http\Response;

use Database\Seeders\DatabaseSeeder;

use Tests\ApiUrls;
use Tests\Fakes;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

/**
 * Check if a user can POST to /api/teams
 */
test('Test if user can create a team, should return 201', function () {
    $response = $this->loginAsOwner()->post(
        ApiUrls::POST_TEAMS,
        Fakes::getFakeTeam()
    );

    $response->assertStatus(Response::HTTP_CREATED);
});

/**
 * Check a POST request to /api/teams/{id}/users
 * As a team owner
 */
test('Test if user can attach a user to a team that he/she owns, should return 201', function () {
    $response = $this->loginAsOwner()->post(
        strtr(
            ApiUrls::POST_ATTACH_USER_TO_TEAM,
            [':id' => Fakes::TEAM_ID]
        ),
        ['user_id' => Fakes::STAFF_ID],
    );

    $response->assertStatus(Response::HTTP_CREATED);
});

/**
 * Check a POST request to /api/teams/{id}/users
 * As a user
 */
test('Test if user can attach a user to a team that he/she DO NOT own, should return 403', function () {
    $response = $this->loginAsStaff()->post(
        strtr(
            ApiUrls::POST_ATTACH_USER_TO_TEAM,
            [':id' => Fakes::TEAM_ID]
        ),
        ['user_id' => Fakes::STAFF_ID],
    );

    $response->assertStatus(Response::HTTP_FORBIDDEN);
});


/**
 * Check if a POST to /api/teams will throw 422
 * when title has more than 30 characters
 */
test('Test if api validation for title is working, should return 422', function () {
    $response = $this->loginAsOwner()->post(
        '/api/teams',
        [
            ...Fakes::getFakeTeam(),
            'title' => 'thisisatooooooooolongtitleforateam'
        ],
    );

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonStructure(['errors' => ['title']]);
});

/**
 * Check if a POST to /api/teams/{id}/users will throw 422
 * when there is no user_id on the body of the request
 */
test('Test if api validation for user_id is working, should return 422', function () {
    $response = $this->loginAsOwner()->post(
        strtr(
            ApiUrls::POST_ATTACH_USER_TO_TEAM,
            [':id' => Fakes::TEAM_ID]
        ),
        ['errorerror' => Fakes::STAFF_ID],
    );

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonStructure(['errors' => ['user_id']]);
});
