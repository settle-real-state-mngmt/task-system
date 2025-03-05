<?php

use Database\Seeders\DatabaseSeeder;

use Tests\ApiUrls;
use Tests\Fakes;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

/**
 * Checks if a user logged as owner of a building can comment on a task
 */
test('Test if team/building owner can comment on a task of a owned building', function () {
    $response = $this->loginAsOwner()->post(
        strtr(ApiUrls::ADD_COMMENT_TO_TASK, [':id' => Fakes::TASK_ID]),
        Fakes::FAKE_COMMENT
    );

    $response->assertOk();
});

/**
 * Checks if a user logged as a team member of a building can comment on a task
 */
test('Test if team member can comment on a task of a building that he/she works', function () {
    $response = $this->loginAsStaff()->post(
        strtr(ApiUrls::ADD_COMMENT_TO_TASK, [':id' => Fakes::TASK_ID]),
        Fakes::FAKE_COMMENT
    );

    $response->assertOk();
});

/**
 * Checks if a user logged that is not a team member of a building can comment on a task
 */
test('Test if user that is not from a team can comment on a task', function () {
    $response = $this->loginAsNonStaff()->post(
        strtr(ApiUrls::ADD_COMMENT_TO_TASK, [':id' => Fakes::TASK_ID]),
        Fakes::FAKE_COMMENT
    );

    $response->assertForbidden();
});
