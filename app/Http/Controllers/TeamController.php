<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachUserToTeamRequest;
use App\Http\Requests\TeamStoreRequest;
use Exception;

use Illuminate\Support\Facades\{Auth, DB, Response as ResponseFacade, Log};
use Illuminate\Http\{Response, JsonResponse};

use App\Models\Team;

/**
 * Handles incoming request related to teams.
 *
 * @author Bruno Braga <brunobraga.work@gmail.com>
 * @see Controller
 */
class TeamController extends Controller
{
    /**
     * Registers a user by POST /store.
     *
     * @param  UserRegisterRequest $request
     * @throws Exception
     * @return JsonResponse
     */
    public function store(TeamStoreRequest $request): JsonResponse
    {
        try {
            $team = Team::create($request->all());
            $body = [
                'message' => 'Team successfuly created!',
                'data' => $team
            ];

            return ResponseFacade::json(
                $body,
                Response::HTTP_CREATED
            );
        } catch (Exception $e) {
            Log::info($e->getMessage());

            return ResponseFacade::json(
                [
                    'message' => 'Uh, something went wrong, talk to the API admin in order to sort it out!',
                    'data' => [],
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Attaches a user to the $team by POST /teams/{id}/users
     *
     * @param  AttachUserToTeamRequest $request
     * @param  Team $team
     * @throws Exception
     * @return
     */
    public function attachUserToTeam(AttachUserToTeamRequest $request, Team $team)
    {
        try {
            $team->users()->attach($request->only('user_id'));
            $body = [
                'message' => 'User Attached to the team successfuly!',
                'data' => $team
            ];

            return ResponseFacade::json(
                $body,
                Response::HTTP_CREATED
            );
        } catch (Exception $e) {
            Log::info($e->getMessage());

            return ResponseFacade::json(
                [
                    'message' => 'Uh, something went wrong, talk to the API admin in order to sort it out!',
                    'data' => [],
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
