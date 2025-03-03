<?php

namespace App\Responses;

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
class HttpOkResponse
{
    public static function build(Collection|Paginator $data, string $msg): JsonResponse
    {
        return response()->ok([
            'message' => $msg,
            'data' => $data
        ]);
    }
}
