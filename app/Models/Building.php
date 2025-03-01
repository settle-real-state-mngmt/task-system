<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
