<?php

namespace App\Http\Controllers;

use App\Casts\Json;
use Exception;

use Illuminate\Http\{Request, Response, JsonResponse};
use Illuminate\Support\Facades\{Response as ResponseFacade, Auth, DB, Log};

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

    public function index(int $buildingId)
    {
        $tasks = Building::query()
            ->select([
                't.id',
                't.title',
                't.description',
                'u.name as assignee',
                /* DB::raw('json_clean_array(array_to_json(array_agg(c))) as task_comments') */
                DB::raw('jsonb_agg(json_build_object(\'id\', c.id, \'content\', c.content, \'name\', uc.name)) as task_comments')
            ])
            ->withCasts(['task_comments' => Json::class])
            ->join('tasks as t', 't.building_id', '=', 'buildings.id')
            ->join('users as u', 't.user_id', '=', 'u.id')
            ->join('users as uo', 'buildings.owner_id', '=', 'uo.id')
            ->leftJoin('comments as c', 't.id', '=', 'c.user_id')
            ->leftJoin('users as uc', 'c.user_id', '=', 'uc.id')
            ->where('buildings.owner_id', Auth::user()->id)
            ->where('buildings.id', $buildingId)
            ->groupBy('t.id', 'uo.name', 'u.name')
            ->simplePaginate();

        return ResponseFacade::json(
            [
                'message' => 'Task list from building id' . $buildingId,
                'data' => $tasks
            ],
            Response::HTTP_OK
        );
    }

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
