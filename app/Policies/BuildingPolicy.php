<?php

namespace App\Policies;

use App\Models\Building;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Handles authorization for the model Building
 *
 * @author Bruno Braga <brunobraga.work@gmail.com>
 */
class BuildingPolicy
{
    /**
     * Determine whether the user can add a user to a team specific team.
     *
     * @param  User $user
     * @param  Building $building
     * @return bool
     */
    public function getBuildingTasks(User $user, Building $building): bool
    {
        if ($building->owner_id == $user->id) {
            return true;
        }

        return DB::table('team_user')
            ->select('user_id')
            ->where('user_id', $user->id)->exists();
    }
}
