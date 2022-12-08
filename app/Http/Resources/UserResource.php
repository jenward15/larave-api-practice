<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'users',
            'id' => $this->id,
            'attributes' => [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'birthdate' => $this->birthdate_format,
                'address' => $this->address,
                'is_active' => $this->is_active,
                'created' => [
                    'string' => $this->created_at->toDateString(),
                    'human' => $this->created_at->diffForHumans(),
                ]
            ],
            'relationships' => [],
            'links' => [
                'self' =>  route('api.users.show', $this->id)
            ]
        ];
    }
}
