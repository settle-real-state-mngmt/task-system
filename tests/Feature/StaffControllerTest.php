<?php

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

uses(RefreshDatabase::class);

$canSeed = false;
beforeEach(function () use (&$canSeed) {
    if (!$canSeed) {
        $this->seed(DatabaseSeeder::class);
    }
    $canSeed = true;
});

beforeEach(function () {
    $this->credentials = [
        'email' => 'alandoe@example.org',
        'password' => 'password'
    ];

    $this->fakeStaff = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.org',
        'password' => 'password'
    ];

    $this->fakeBuilding = ['name' => 'Plus Ultra building'];

    $loginResponse = $this->post('/api/login', $this->credentials);
    $this->token = $loginResponse->getOriginalContent()['access_token'];
});


/**
 * Check if /register is sign up users properly
 */
test('test if POST to /api/staff returns 201', function () {
    $response = $this->post(
        '/api/users/staff',
        $this->fakeStaff,
        [
            'accept' => 'application/json',
            'Authorization' => $this->token
        ]
    );

    $response->assertStatus(Response::HTTP_CREATED);
});

/**
 * Check if name has no more than 30 characters
 */
test('if /register returns 422 when passing more than 30 char to name', function () {
    $this->fakeStaff['name'] = 'thisisanamethatdefinitelyhasmorethan30chars';

    $response = $this->post('/api/users/staff', $this->fakeStaff, ['accept' => 'application/json']);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

/**
 * Check if password has at least 8 characters
 */
test('if /register returns 422 when passing less than 8 char to password', function () {
    $this->fakeStaff['password'] = '1';

    $response = $this->post('/api/users/staff', $this->fakeStaff, ['accept' => 'application/json']);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
