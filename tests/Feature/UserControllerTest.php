<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

$fakeUser = [
    'name' => 'John Doe',
    'email' => 'johndoe@example.org',
    'password' => 'password'
];

test('if /register returns 201 when valid data is sent', function () use ($fakeUser) {
    $response = $this->post('/api/register', $fakeUser, ['accept' => 'application/json']);
    $response->assertJsonStructure([
        'message',
        'data' => ['id', 'name', 'email', 'created_at', 'updated_at'],
    ]);
});

test('if /register returns 422 when saving same email twice', function () use ($fakeUser) {
    $response = $this->post('/api/register', $fakeUser, ['accept' => 'application/json']);
    $response = $this->post('/api/register', $fakeUser, ['accept' => 'application/json']);
    $response->assertStatus(422);
});

test('if /register returns 422 when passing more than 30 char to name', function () use ($fakeUser) {
    $fakeUser['name'] = 'thisisanamethatdefinitelyhasmorethan30chars';
    $response = $this->post('/api/register', $fakeUser, ['accept' => 'application/json']);
    $response->assertStatus(422);
});

test('if /register returns 422 when passing less than 8 char to password', function () use ($fakeUser) {
    $fakeUser['password'] = '1';
    $response = $this->post('/api/register', $fakeUser, ['accept' => 'application/json']);
    $response->assertStatus(422);
});
