<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;

/**
 * Handles authorization for the model Team
 *
 * @author Bruno Braga <brunobraga.work@gmail.com>
 */
class TeamPolicy
{
    /**
     * Determine whether the user can add a user to a team specific team.
     *
     * @param  Team $team
     * @return bool
     */
    public function attach(User $user, Team $team): bool
    {
        return $team->owner_id == $user->id;
    }
}
