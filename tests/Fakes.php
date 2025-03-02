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

    /** @var int TEAM_ID */
    const TEAM_ID = 1;

    /** @var int FAKE_BUILDING_ID */
    const FAKE_BUILDING_ID = 1;

    /** @var array FAKE_TEAM */
    const FAKE_TEAM = [
        'id' => 1,
        'title' => 'Random title',
        'owner_id' => self::OWNER_ID
    ];

    /** @var array FAKE_BUILDING */
    const FAKE_BUILDING = [
        'name' => 'Av. Brazuca',
        'owner_id' => self::OWNER_ID
    ];

    /** @var array FAKE_TASK */
    const FAKE_TASK = [
        'title' => 'Clean the garage.',
        'building_id' => self::FAKE_BUILDING_ID,
        'user_id' => self::STAFF_ID
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
