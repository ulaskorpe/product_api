<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'status' => $this->status,
            'type' => $this->type,
            'process' => $this->process,
            'user' =>  new UserResource($this->user()->first()),
            'product' =>  new ProductResource($this->product()->first()),
             
        ];
    }
}
