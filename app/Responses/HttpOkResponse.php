<?php

namespace App\Responses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
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
    public static function build(Model|Collection|array $data, string $msg): JsonResponse
    {
        $body = [];
        if (is_array($data)) {
            $body = [...$data];
        } else {
            $body = ['data' => $data];
        }

        return response()->ok([
            'message' => $msg,
            ...$body
        ]);
    }
}
