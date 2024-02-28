<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->uuid,
            "name" => $this->name,
            "company_name" =>$this->company_name,
            "street" =>$this->street,
            "city" =>$this->city,
            "state" =>$this->state,
            "country" =>$this->country,
            "postal_code" =>$this->postal_code,
            "contact_number" =>$this->contact_number,
            "status" =>$this->status,
            "creator"=>$this->createdBy,
        ];
    }
}
