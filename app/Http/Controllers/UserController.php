<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Responses\HttpCreatedResponse;
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
     * @return JsonResponse
     */
    public function store(UserRegisterRequest $request): JsonResponse
    {
        $user = User::create($request->all());

        return HttpCreatedResponse::build(
            $user,
            'User successfuly created!'
        );
    }
}
