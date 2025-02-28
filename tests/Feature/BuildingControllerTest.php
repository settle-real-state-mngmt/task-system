<?php

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->credentials = [
        'email' => 'alandoe@example.org',
        'password' => 'password'
    ];

    $this->fakeBuilding = ['name' => 'Plus Ultra building'];
});

$canSeed = false;
beforeEach(function () use (&$canSeed) {
    if (!$canSeed) {
        $this->seed(DatabaseSeeder::class);
    }
    $canSeed = true;
});

/**
 * Check if /register is sign up users properly
 */
test('test if POST to /api/buildings returns 201', function () {
    $loginResponse = $this->post('/api/login', $this->credentials);
    $token = $loginResponse->getOriginalContent()['access_token'];

    $response = $this->post(
        '/api/buildings',
        $this->fakeBuilding,
        [
            'accept' => 'application/json',
            'Authorization' => $token
        ]
    );

    $response->assertStatus(Response::HTTP_CREATED);
});
