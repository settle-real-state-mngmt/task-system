<?php

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

$credentials = [
    'email' => 'alandoe@example.org',
    'password' => 'password'
];

uses(RefreshDatabase::class);

$canSeed = false;

beforeEach(function () use (&$canSeed) {
    if (!$canSeed) {
        $this->seed(DatabaseSeeder::class);
    }
    $canSeed = true;
});

/**
 * Check if /login returns proper keys and token
 */
test('if login returns 200 status and a json with access_token, token_type and expires_in', function () use ($credentials) {
    $response = $this->post('/api/login', $credentials);
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure([
        'access_token',
        'token_type',
        'expires_in',
    ]);
});

/**
 * Check if /logout returns proper keys and token
 */
test('if status is 204 when user logs out', function () use ($credentials) {
    $loginResponse = $this->post('/api/login', $credentials);

    $token = $loginResponse->getOriginalContent()['access_token'];

    $response = $this->post('/api/logout', [], [
        'Accept' => 'application/json',
        'Authorization' => $token
    ]);
    $response->assertStatus(Response::HTTP_NO_CONTENT);
});

/**
 * Check if /logout returns proper keys and token
 */
test('if status is 401 when user logs out without being logged in', function () use ($credentials) {
    $response = $this->post('/api/logout', $credentials, ['Accept' => 'application/json']);
    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
});
