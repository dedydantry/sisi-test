<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'id_level' => $this->id_level,
            'menu_name' => $this->menu_name,
            'menu_link' => $this->menu_link,
            'menu_icon' => $this->menu_icon,
            'parent' => new MenuResource($this->whenLoaded('parent'))
        ];
    }
}
