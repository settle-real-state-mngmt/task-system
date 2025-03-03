<?php

namespace App\Responses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

/**
 * Complements JsonResponse by having a
 * default set of keys according to the
 * http status that this class is abstracting
 *
 * @author Bruno Braga <brunobraga.work@gmail.com>
 */
class HttpNotFoundResponse
{
    public static function build(Model|Collection|Paginator $data, string $msg): JsonResponse
    {
        return response()->notfound([
            'message' => $msg,
            'data' => $data
        ]);
    }
}
