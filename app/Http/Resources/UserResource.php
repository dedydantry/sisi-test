<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'user_name' => $this->user_name,
            'no_hp' => $this->no_hp,
            'wa' => $this->wa,
            'pin' => $this->pin,
            'created_at' => $this->created_at,
            'menus' => MenuResource::collection($this->whenLoaded('menus'))
        ];
    }
}
