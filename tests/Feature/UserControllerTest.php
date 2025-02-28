<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

uses(RefreshDatabase::class);

$fakeUser = [
    'name' => 'John Doe',
    'email' => 'johndoe@example.org',
    'password' => 'password'
];

/**
 * Check if /users is sign up users properly
 */
test('if /users returns 201 when valid data is sent', function () use ($fakeUser) {
    $response = $this->post('/api/users', $fakeUser, ['accept' => 'application/json']);
    $response->assertStatus(Response::HTTP_CREATED);
    $response->assertJsonStructure([
        'message',
        'data' => ['id', 'name', 'email', 'created_at', 'updated_at'],
    ]);
});

/**
 * Check if api is not allowing users to sign up same email
 */
test('if /users returns 422 when saving same email twice', function () use ($fakeUser) {
    $response = $this->post('/api/users', $fakeUser, ['accept' => 'application/json']);
    $response = $this->post('/api/users', $fakeUser, ['accept' => 'application/json']);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

/**
 * Check if name has no more than 30 characters
 */
test('if /users returns 422 when passing more than 30 char to name', function () use ($fakeUser) {
    $fakeUser['name'] = 'thisisanamethatdefinitelyhasmorethan30chars';
    $response = $this->post('/api/users', $fakeUser, ['accept' => 'application/json']);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

/**
 * Check if password has at least 8 characters
 */
test('if /users returns 422 when passing less than 8 char to password', function () use ($fakeUser) {
    $fakeUser['password'] = '1';
    $response = $this->post('/api/users', $fakeUser, ['accept' => 'application/json']);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
