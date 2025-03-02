<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Building;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'building_id',
        'user_id',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->chaperone();
    }
}
