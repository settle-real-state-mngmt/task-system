<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\{Auth, DB, Gate};

use App\Casts\Json;
use App\Models\Building;
use App\Responses\{HttpOkResponse, HttpCreatedResponse};
use App\Http\Requests\{TaskStoreRequest, BuildingStoreRequest};

/**
 * Handles incoming request related to buildings.
 *
 * @author Bruno Braga <brunobraga.work@gmail.com>
 * @see Controller
 */
class BuildingController extends Controller
{
    /**
     * Fetches all tasks and its comments from a buildingId
     *
     * @return JsonResponse
     */
    public function index(int $id): JsonResponse
    {
        Gate::authorize('getBuildingTasks', Building::find($id));

        $tasks = Building::query()
            ->select([
                't.id',
                't.title',
                't.description',
                'u.name as assignee',
                DB::raw('jsonb_agg(json_build_object(\'id\', c.id, \'content\', c.content, \'name\', uc.name)) as task_comments')
            ])
            ->withCasts(['task_comments' => Json::class])
            ->join('tasks as t', 't.building_id', '=', 'buildings.id')
            ->join('users as u', 't.user_id', '=', 'u.id')
            ->join('users as uo', 'buildings.owner_id', '=', 'uo.id')
            ->leftJoin('comments as c', 't.id', '=', 'c.user_id')
            ->leftJoin('users as uc', 'c.user_id', '=', 'uc.id')
            ->where('buildings.id', $id)
            ->groupBy('t.id', 'uo.name', 'u.name')
            ->simplePaginate();

        return HttpOkResponse::build(
            $tasks,
            'Task list from building id ' . $id
        );
    }

    /**
     * Stores a build by POST /buildings
     *
     * @param  BuildingStoreRequest $request
     * @return JsonResponse
     */

    public function store(BuildingStoreRequest $request): JsonResponse
    {
        $building = Building::create([
            'owner_id' => Auth::user()->id,
            ...$request->all()
        ]);

        return HttpCreatedResponse::build(
            $building,
            'Building created with success!',
        );
    }

    /**
     * Stores a task by POST /buildings/{building}/tasks
     *
     * @param  TaskStoreRequest $request
     * @param  string $buildingId
     * @return JsonResponse
     */

    public function storeTask(TaskStoreRequest $request, Building $building): JsonResponse
    {
        $building->tasks()->create([
            ...$request->all(),
            'building_id' => $building->id
        ]);

        return HttpCreatedResponse::build(
            $building->with('tasks')->get(),
            'Task created with success!'
        );
    }
}
