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

    const TEAM_ID = 1;

    /** @var array FAKE_TEAM */
    const FAKE_TEAM = [
        'id' => 1,
        'title' => 'Random title',
        'owner_id' => self::OWNER_ID
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
