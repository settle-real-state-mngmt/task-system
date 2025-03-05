<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckUserInputIsPartOfTeam implements ValidationRule
{
    public function __construct(private Request $request)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $teamOwner = DB::table('users as u')
            ->select('u.id', DB::raw('true as is_owner'))
            ->join('teams as t', 't.owner_id', '=', 'u.id')
            ->join('buildings as b', 'b.owner_id', '=', 'u.id')
            ->where('b.id', $this->request->building->id);

        $teamMembers = DB::table('users as u')
            ->select('u.id', DB::raw('false as is_owner'))
            ->join('team_user as tu', 'tu.user_id', '=', 'u.id')
            ->join('teams as t', 't.id', '=', 'tu.team_id')
            ->union($teamOwner);

        if (!$teamMembers->get()->contains('id', $value)) {
            $fail('user_id is not part of the team.');
        }
    }
}
