<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
use App\Http\Requests\UserRegisterRequest;

class UserController extends Controller
{
    /*
    *
    *
    */
    public function register(UserRegisterRequest $request)
    {
        try {
            $user = User::create($request->all());

            return response()->json(
                [
                    'msg' => 'User successfuly created!',
                    'data' => $user
                ],
                Response::HTTP_CREATED
            );
        } catch (Exception $e) {
            Log::info($e->getMessage());

            return response()->json([
                'msg' => '',

            ]);
        }
    }
}
