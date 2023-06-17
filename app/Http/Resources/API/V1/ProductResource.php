<?php

namespace App\Http\Resources\API\V1;

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
            'id'=>$this->id,
            'user_id'=>$this->user,
            'name'=>$this->name,
            'bidmargin'=>$this->bidmargin,
            'image'=>asset($this->image),
            'description'=>$this->description
        ];
    }
}
