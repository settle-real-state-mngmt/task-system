<?php

namespace App\Http\Requests;

use App\Policies\BuildingPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $task = DB::table('tasks as t')
            ->where('t.id', $this->task->id)
            ->join('buildings as b', 't.building_id', '=', 'b.id');

        if ($task->first()->owner_id == Auth::user()->id) {
            return true;
        }

        return DB::table('team_user')
            ->select('user_id')
            ->where('user_id', Auth::user()->id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => ['required'],
            'user_id' => ['required'],
        ];
    }
}
