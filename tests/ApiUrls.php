<?php

namespace Tests;

/**
 * Contains api endpoints for test purposes.
 *
 * @author Bruno Braga<bruonbraga.work@gmail.com>
 */
class ApiUrls
{
    /** @var string POST_BUILDINGS */
    const POST_BUILDINGS = '/api/buildings';

    /** @var string POST_ADD_TASK_TO_TEAM */
    const POST_ADD_TASK_TO_TEAM = '/api/buildings/:id/tasks';

    /** @var string POST_TEAMS */
    const POST_TEAMS = '/api/teams';

    /** @var string POST_ATTACH_USER_TO_TEAM */
    const POST_ATTACH_USER_TO_TEAM = '/api/teams/:id/users';
}
