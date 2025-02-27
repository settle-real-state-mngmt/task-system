<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Http\{Request, Response, JsonResponse};
use Illuminate\Support\Facades\{Response as ResponseFacade, Auth, Log};

use App\Models\Building;

class BuildingController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $building = Building::create([
                'owner_id' => Auth::user()->id,
                ...$request->all()
            ]);

            return ResponseFacade::json(
                [
                    'message' => 'Building created with success!',
                    'data' => $building
                ],
                Response::HTTP_CREATED
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());

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
