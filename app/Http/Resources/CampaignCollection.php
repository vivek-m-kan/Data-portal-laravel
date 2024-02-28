<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CampaignCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data" => $this->collection,
        ];
    }

    public function paginationInformation($request, $paginated, $default)
    {
        $default['meta'] = [
            'next' => (bool) $default['links']['next'],
            'prev' => (bool) $default['links']['prev'],
            'page' => $default['meta']['current_page'],
            'limit' => $default['meta']['per_page'],
            'totalRecords' => $default['meta']['total'],
            'totalPages' => $default['meta']['last_page'],
        ];
        unset($default['links']);
        return $default;
    }
}
