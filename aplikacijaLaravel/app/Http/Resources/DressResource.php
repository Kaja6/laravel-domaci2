<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap='dress';

    public function toArray($request)
    {
        return [
            'model'=> $this -> resource->model,
            'color'=> $this -> resource->color,
            'releaseYear' => $this -> resource->releaseYear,
            'designer_id'=> new DesignerResource($this -> resource->designer),
            'type_id'=>new TypeResource($this -> resource->type),
            'user_id'=>new UserResource($this -> resource->user)
        ];
    }
}
