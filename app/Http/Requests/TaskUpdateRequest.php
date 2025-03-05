<?php

namespace App\Http\Requests;

use App\Rules\CheckUserInputIsPartOfTeam;
use App\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->building->owner_id == Auth::user()->id) {
            return true;
        }

        return DB::table('team_user as tu')
            ->select('user_id')
            ->join('teams as t', 't.id', '=', 'tu.team_id')
            ->where('user_id', Auth::user()->id)
            ->where('t.owner_id', $this->building->owner_id)
            ->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'max:50'],
            'description' => ['sometimes'],
            'user_id' => ['sometimes', new CheckUserInputIsPartOfTeam($this)],
            'status' => ['sometimes', new Enum(TaskStatus::class)],
        ];
    }
}
