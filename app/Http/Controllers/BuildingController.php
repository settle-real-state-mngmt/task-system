<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Http\{Request, Response, JsonResponse};
use Illuminate\Support\Facades\{Response as ResponseFacade, Auth, Log};

use App\Models\Building;
use App\Http\Requests\TaskStoreRequest;

/**
 * Handles incoming request related to buildings.
 *
 * @author Bruno Braga <brunobraga.work@gmail.com>
 * @see Controller
 */
class BuildingController extends Controller
{
    /**
     * Stores a build by POST /buildings
     *
     * @param  Request $request
     * @throws Exception
     * @return JsonResponse
     */
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

    /**
     * Stores a task by POST /buildings/tasks
     *
     * @param  Request $request
     * @param  string $buildingId
     * @throws Exception
     * @return JsonResponse
     */
    public function storeTask(TaskStoreRequest $request, string $buildingId): JsonResponse
    {
        try {
            $building = Building::where('id', $buildingId)
                ->where('owner_id', Auth::user()->id)
                ->first();

            $building->tasks()->create($request->all());

            return ResponseFacade::json(
                [
                    'message' => 'Building created with success!',
                    'data' => $building
                ],
                Response::HTTP_CREATED
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());

            dump($e->getMessage());

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
