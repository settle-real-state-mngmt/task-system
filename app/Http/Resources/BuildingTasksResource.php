<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuildingTasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $this['data'];

        return [
            'data' => $data,
            'current_page' => $this['current_page'],
            'first_page_url' => $this['first_page_url'],
            'from' => $this['from'],
            'next_page_url' => $this['next_page_url'],
            'path' => $this['path'],
            'per_page' => $this['per_page'],
            'prev_page_url' => $this['prev_page_url'],
        ];
    }
}
