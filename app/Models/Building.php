<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * Handles database operation for table buildings
 *
 * @author Bruno Braga <brunobraga.work@gmail.com>
 * @see Model
 */
class Building extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'owner_id',
    ];

    /**
     * One building has one or many tasks
     *
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get all tasks from a given building.
     *
     * @param  int     $id
     * @return Builder
     */
    public static function getTasks(int $id): Builder
    {
        return self::query()
            ->select([
                't.id',
                't.title',
                't.status',
                't.description',
                'u.name as assignee',
                't.created_at',
                DB::raw('jsonb_agg(json_build_object(\'id\', c.id, \'content\', c.content, \'name\', uc.name)) as task_comments')
            ])
            ->withCasts(['task_comments' => Json::class])
            ->join('tasks as t', 't.building_id', '=', 'buildings.id')
            ->join('users as u', 't.user_id', '=', 'u.id')
            ->join('users as uo', 'buildings.owner_id', '=', 'uo.id')
            ->leftJoin('comments as c', 't.id', '=', 'c.user_id')
            ->leftJoin('users as uc', 'c.user_id', '=', 'uc.id')
            ->where('buildings.id', $id)
            ->groupBy('t.id', 'uo.name', 'u.name');
    }
}
