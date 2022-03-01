<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "uuid" => $this->uuid,
            "category" => new CategoryResource($this->category),
            "title" => $this->title,
            "price" => $this->price,
            "description" => $this->description,
            "metadata" => $this->metadata,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
