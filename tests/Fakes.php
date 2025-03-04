<?php

namespace Tests;

/**
 * Class containing Fake data for test purpose.
 *
 * @author Bruno Braga <brunobraga.work@gmail.com>
 */
class Fakes
{
    /** @var int OWNER_ID */
    const OWNER_ID = 1;

    /** @var int STAFF_ID */
    const STAFF_ID = 2;

    /** @var int NON_STAFF_ID */
    const NON_STAFF_ID = 4;

    /** @var int TEAM_ID */
    const TEAM_ID = 1;

    /** @var int FAKE_BUILDING_ID */
    const FAKE_BUILDING_ID = 1;

    const TASK_ID = 1;

    /**
     * @var array FAKE_USER
     *
     * Represehts a user, specifically that owns a building
     */
    const FAKE_USER = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.org',
        'password' => 'password'
    ];

    /**
     * @var array FAKE_USER_INVALID_FIELDS
     *
     * Represents a body of a request containing
     * all fields with an error
     */
    const FAKE_USER_INVALID_FIELDS = [
        'name' => 'thisisanamethatdefinitelyhasmorethan30chars',
        'email' => 'johndoe',
        'password' => '1'
    ];

    /**
     * @var array FAKE_USER
     *
     * Represents a body of a request containing
     * the field name with an error
     */
    const FAKE_USER_INVALID_NAME = [
        'name' => 'thisisanamethatdefinitelyhasmorethan30chars',
        'email' => 'johndoe@example.org',
        'password' => 'password'
    ];

    /**
     * @var array FAKE_USER
     *
     * Represents a body of a request containing
     * the field email with an error
     */
    const FAKE_USER_INVALID_EMAIL = [
        'name' => 'John Doe',
        'email' => 'johndoe',
        'password' => 'password'
    ];

    /**
     * @var array FAKE_USER
     *
     * Represents a body of a request containing
     * with field password with an error
     */
    const FAKE_USER_INVALID_PASSWORD = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.org',
        'password' => '1'
    ];

    /**
     * @var array FAKE_TEAM
     *
     * Represents a team that has user id 1 as its owner
     */
    const FAKE_TEAM = [
        'id' => 1,
        'title' => 'Random title',
        'owner_id' => self::OWNER_ID
    ];

    /**
     * @var array FAKE_BUILDING
     *
     * Represents a building that has user id 1 as its owner
     */
    const FAKE_BUILDING = [
        'name' => 'Av. Brazuca',
        'owner_id' => self::OWNER_ID
    ];

    /**
     * @var array FAKE_INVALID_BUILDING_NAME
     *
     * Represents a body of a request containing
     * with field name with an error
     */
    const INVALID_BUILDING_NAME = [
        'name' => 'thisisabuildingwithnamethatistooolong',
    ];

    /**
     * @var array FAKE_INVALID_BUILDING_NAME
     *
     * Represents a body of a request containing
     * the key with a typo
     */
    const INVALID_BUILDING_NAME_NO_KEY = [
        'namenokey' => 'thisisabuildingwithnamethatistooolong',
    ];

    /**
     * @var array FAKE_TASK
     *
     * Represents a task for building with id 1
     * and user with id 2
     */
    const FAKE_TASK = [
        'title' => 'Clean the garage.',
        'building_id' => self::FAKE_BUILDING_ID,
        'user_id' => self::STAFF_ID
    ];

    /**
     * @var array INVALID_TEAM
     *
     * Represents the body of a request containing
     * title with with an error
     */
    const INVALID_TEAM = [
        'id' => 1,
        'title' => 'thisisatooooooooolongtitleforateam',
        'owner_id' => self::OWNER_ID
    ];

    /**
     * @var array NULL_USER_ID
     *
     * Represents the body of a POST to /teams/{id}/users
     */
    const NULL_USER_ID = [
        'user_id' => null
    ];

    /**
     * @var array NOT_IN_DB_USER_ID
     *
     * Represents the body of a POST to /teams/{id}/users
     */
    const NOT_IN_DB_USER_ID = [
        'user_id' => 999999999
    ];

    /**
     * @var array STRING_USER_ID
     *
     * Represents the body of a POST to /teams/{id}/users
     */
    const STRING_USER_ID = [
        'user_id' => 'adfhaiuhdfad'
    ];

    /**
     * @var array OWNER_USER_ID
     *
     * Represents the body of a POST to /teams/{id}/users
     */
    const OWNER_USER_ID = [
        'user_id' => self::OWNER_ID
    ];

    /**
     * @var array STAFF_USER_ID
     *
     * Represents the body of a POST to /teams/{id}/users
     */
    const STAFF_USER_ID = [
        'user_id' => self::STAFF_ID
    ];

    const FAKE_COMMENT = [
        'content' => 'this is the description of the ',
        'user_id' => self::STAFF_ID,
        'task_id' => 1
    ];

    /**
     * Generates fake team data for test purposes.
     *
     * @return array
     */
    public static function getFakeTeam(): array
    {
        return [
            ...self::FAKE_TEAM,
            'title' => fake()->title
        ];
    }
}
