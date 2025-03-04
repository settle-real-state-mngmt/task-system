<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\{Auth, DB, Gate};
use Illuminate\Support\Str;

use App\Casts\Json;
use App\Models\Building;
use App\Responses\{HttpOkResponse, HttpCreatedResponse};
use App\Http\Requests\{TaskStoreRequest, BuildingStoreRequest, TaskUpdateRequest};
use App\Models\Task;
use Illuminate\Http\Request;

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
    public function index(Request $request, int $id): JsonResponse
    {
        Gate::authorize('getBuildingTasks', Building::find($id));

        $tasks = Building::getTasks($id);

        if ($request->query('status')) {
            $tasks->where('status', Str::ucfirst($request->query('status')));
        }

        if ($request->query('assignee')) {
            $tasks->where('t.user_id', $request->query('assignee'));
        }

        if ($request->query('start')) {
            $tasks->where('t.created_at', '>=', $request->query('start'));
        }

        if ($request->query('end')) {
            $tasks->where('t.created_at', '<=', $request->query('end'));
        }

        return HttpOkResponse::build(
            $tasks->simplePaginate(),
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

    /**
     * Updates a task by PUT to /buildings/{building}/tasks/{task}
     *
     * @param  TaskUpdateRequest $request
     * @param  Building $building
     * @param  Task $task
     * @return JsonResponse
     */
    public function updateTask(
        TaskUpdateRequest $request,
        Building $building,
        Task $task
    ): JsonResponse {
        $task->update($request->all());
        $task->fresh();

        return HttpOkResponse::build(
            $task,
            'Task updated successfully!'
        );
    }
}
