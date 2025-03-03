<?php

use Illuminate\Http\Response;
use Illuminate\Support\Collection;

use Tests\Fakes;

use App\Responses\HttpOkResponse;
use App\Responses\HttpCreatedResponse;
use App\Responses\HttpForbiddenResponse;
use App\Responses\HttpUnauthorizedResponse;
use App\Responses\HttpUnprocessableEntityResponse;
use App\Responses\HttpServerErrorResponse;

/**
 * Checks if the class HttpOkResponse is correctly
 * returning its status code as 200
 */
test('Test if HttpOkResponse returns status code 200', function () {
    $collection = new Collection(Fakes::getFakeTeam());
    $res = HttpOkResponse::build($collection, 'Data saved successfully');

    $status = $res->getStatusCode();

    expect($status)->toBe(Response::HTTP_OK);
});

/**
 * Checks if the class HttpCreatedResponse is correctly
 * returning its status code as 201
 */
test('Test if HttpCreatedResponse returns status code 201', function () {
    $collection = new Collection(Fakes::getFakeTeam());
    $res = HttpCreatedResponse::build($collection, 'Data saved successfully');

    $status = $res->getStatusCode();

    expect($status)->toBe(Response::HTTP_CREATED);
});

/**
 * Checks if the class HttpUnprocessableEntityResponse is correctly
 * returning its status code as 422
 */
test('Test if HttpUnprocessableEntityResponse returns status code 422', function () {
    $collection = new Collection(Fakes::getFakeTeam());
    $res = HttpUnprocessableEntityResponse::build($collection, 'Data saved successfully');

    $status = $res->getStatusCode();

    expect($status)->toBe(Response::HTTP_UNPROCESSABLE_ENTITY);
});

/**
 * Checks if the class HttpUnauthorizedResponse is correctly
 * returning its status code as 401
 */
test('Test if HttpUnauthorizedResponse returns status code 401', function () {
    $collection = new Collection(Fakes::getFakeTeam());
    $res = HttpUnauthorizedResponse::build($collection, 'Data saved successfully');

    $status = $res->getStatusCode();

    expect($status)->toBe(Response::HTTP_UNAUTHORIZED);
});

/**
 * Checks if the class HttpForbiddenResponse is correctly
 * returning its status code as 403
 */
test('Test if HttpForbiddenResponse returns status code 403', function () {
    $collection = new Collection(Fakes::getFakeTeam());
    $res = HttpForbiddenResponse::build($collection, 'Data saved successfully');

    $status = $res->getStatusCode();

    expect($status)->toBe(Response::HTTP_FORBIDDEN);
});

/**
 * Checks if the class HttpServerErrorResponse is correctly
 * returning its status code as 403
 */
test('Test if HttpServerErrorResponse returns status code 500', function () {
    $collection = new Collection(Fakes::getFakeTeam());
    $res = HttpServerErrorResponse::build($collection, 'Data saved successfully');

    $status = $res->getStatusCode();

    expect($status)->toBe(Response::HTTP_INTERNAL_SERVER_ERROR);
});
