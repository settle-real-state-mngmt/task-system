<?php


namespace App\Http\Controllers;

use Exception;

use Illuminate\Support\Facades\{Auth, DB, Response as ResponseFacade, Log};
use Illuminate\Http\{Response, JsonResponse};

use App\Models\User;
use App\Models\Staff;
use App\Http\Requests\UserRegisterRequest;

/**
 * Handles incoming request related to users.
 *
 * @author Bruno Braga <brunobraga.work@gmail.com>
 * @see Controller
 */
class UserController extends Controller
{
    /**
     * Registers a user by POST /store.
     *
     * @param  UserRegisterRequest $request
     * @throws Exception
     * @return JsonResponse
     */
    public function store(UserRegisterRequest $request): JsonResponse
    {
        try {
            $user = User::create($request->all());
            $body = [
                'message' => 'User successfuly created!',
                'data' => $user
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
     * Registers a staff by POST /staff.
     *
     * @param  Request $request
     * @throws Exception
     * @return JsonResponse
     */
    public function storeStaff(UserRegisterRequest $request): JsonResponse
    {
        try {
            $bossId = Auth::user()->id;

            DB::beginTransaction();

            $user = User::create($request->all());
            $staff = Staff::create([
                'user_id' => $user->id,
                'boss_id' => $bossId,
            ]);

            DB::commit();

            $body = [
                'message' => 'User successfuly created, and, added as Staff!',
                'data' => $staff
            ];

            return ResponseFacade::json(
                $body,
                Response::HTTP_CREATED
            );
        } catch (Exception $e) {
            Log::info($e->getMessage());

            DB::rollBack();

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
