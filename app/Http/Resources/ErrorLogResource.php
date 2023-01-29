<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorLogResource extends JsonResource
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
            'user_id' => $this->user_id,
            'modules' => $this->modules,
            'controller' => $this->controller,
            'function' => $this->function,
            'error_line' => $this->error_line,
            'error_message' => $this->error_message,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d M Y H:m'),
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
