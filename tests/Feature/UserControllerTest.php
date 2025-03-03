<?php

use Tests\ApiUrls;
use Tests\Fakes;

beforeEach(function () {
    $this->withHeaders(['Accept' => 'application/json']);
});

/**
 * Check if /users is sign up users properly
 */
test('Test if user can create sign up', function () {
    $response = $this->post(ApiUrls::USERS, Fakes::FAKE_USER);

    $response->assertCreated();
    $response->assertExactJsonStructure([
        'message',
        'data' => ['id', 'name', 'email', 'created_at', 'updated_at'],
    ]);
});

/**
 * Check if all errors are being sent when all fields are invalid
 *
 * Validation rules:
 *
 * 'name' => 'required|string|max:30',
 * 'email' => 'required|unique:users|email',
 * 'password' => 'required|string|min:8'
 */
test('Test if user gets all errors when sending all fields with errors', function () {
    $response = $this->post(ApiUrls::USERS, Fakes::FAKE_USER_INVALID_FIELDS);

    $response->assertUnprocessable();
    $response->assertInvalid(['name', 'email', 'password']);
});

/**
 * Check if name has no more than 30 characters
 *
 * Validation rules:
 *
 * 'name' => 'required|string|max:30',
 */
test('Test if user gets error for name whens sending invalid name', function () {
    $response = $this->post(ApiUrls::USERS, Fakes::FAKE_USER_INVALID_NAME);

    $response->assertUnprocessable();
    $response->assertInvalid(['name']);
});

/**
 * Check if api is not allowing users to sign up same email
 *
 * Validation rules:
 *
 * 'email' => 'required|unique:users|email',
 */
test('Test if user gets invalid email error when trying to save an emai that is already register', function () {
    $response = $this->post(ApiUrls::USERS, Fakes::FAKE_USER);
    $response = $this->post(ApiUrls::USERS, Fakes::FAKE_USER);

    $response->assertUnprocessable();
    $response->assertInvalid(['email']);
});

/**
 * Check if password has at least 8 characters
 *
 * Validation rules:
 *
 * 'password' => 'required|string|min:8'
 */
test('Test if user gets error for password whens sending invalid name', function () {
    $response = $this->post(ApiUrls::USERS, Fakes::FAKE_USER_INVALID_PASSWORD);

    $response->assertUnprocessable();
    $response->assertInvalid(['password']);
});
