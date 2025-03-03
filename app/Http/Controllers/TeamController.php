<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachUserToTeamRequest;
use App\Http\Requests\TeamStoreRequest;
use Exception;

use Illuminate\Support\Facades\{Auth, Gate, Response as ResponseFacade, Log};
use Illuminate\Http\{Response, JsonResponse};

use App\Models\Team;
use App\Models\User;
use App\Responses\HttpCreatedResponse;

/**
 * Handles incoming request related to teams.
 *
 * @author Bruno Braga <brunobraga.work@gmail.com>
 * @see Controller
 */
class TeamController extends Controller
{
    /**
     * Creates a team by POST /api/teams.
     *
     * @param  UserRegisterRequest $request
     * @return JsonResponse
     */
    public function store(TeamStoreRequest $request): JsonResponse
    {
        $team = Team::create([
            ...$request->all(),
            'owner_id' => Auth::user()->id
        ]);

        return HttpCreatedResponse::build(
            $team,
            'Team successfuly created!',
        );
    }

    /**
     * Attaches a user to the $team by POST /teams/{id}/users
     *
     * @param  AttachUserToTeamRequest $request
     * @param  Team $team
     * @return
     */
    public function attachUserToTeam(AttachUserToTeamRequest $request, Team $team)
    {
        Gate::authorize('attach', $team);

        $userId = $request->only('user_id');
        User::findOrFail($userId);

        $team->users()->attach($userId);

        return HttpCreatedResponse::build(
            $team,
            'User Attached to the team successfuly!',
        );
    }
}
