<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * TestCase class that is used to extend pest tests
 *
 * @see BaseTestCase
 */
abstract class TestCase extends BaseTestCase
{
    /**
     * Logs as a $user that owns a team and
     * adds application/json header allowing to
     * chain functions on test cases.
     *
     * @example $this->loginAsOwner()->post(..)
     */
    public function loginAsOwner()
    {
        return $this
            ->actingAs(User::find(Fakes::OWNER_ID))
            ->withHeader('Accept', 'application/json');
    }

    /**
     * Logs as a $user that do not own a team and
     * adds application/json header allowing to
     * chain functions on test cases.
     *
     * @example $this->loginAsStaff()->post(..)
     */
    public function loginAsStaff()
    {
        return $this
            ->actingAs(User::find(Fakes::STAFF_ID))
            ->withHeader('Accept', 'application/json');
    }

    /**
     * Logs as a $user that do not own a team and
     * adds application/json header allowing to
     * chain functions on test cases.
     *
     * @example $this->loginAsStaff()->post(..)
     */
    public function loginAsNonStaff()
    {
        return $this
            ->actingAs(User::find(Fakes::NON_STAFF_ID))
            ->withHeader('Accept', 'application/json');
    }
}
