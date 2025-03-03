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
    const BUILDINGS = '/api/buildings';

    /** @var string POST_ADD_TASK_TO_TEAM */
    const ADD_TASK_TO_TEAM = '/api/buildings/:id/tasks';

    /** @var string GET_BUILDING_TASKS */
    const GET_BUILDING_TASKS  = '/api/buildings/:id/tasks';

    /** @var string POST_TEAMS */
    const POST_TEAMS = '/api/teams';

    /** @var string POST_ATTACH_USER_TO_TEAM */
    const ATTACH_USER_TO_TEAM = '/api/teams/:id/users';

    /** @var string POST_LOGIN */
    const LOGIN = '/api/login';

    /** @var string USERS */
    const USERS = '/api/users';

    const ADD_COMMENT_TO_TASK = '/api/tasks/:id/comments';
}
