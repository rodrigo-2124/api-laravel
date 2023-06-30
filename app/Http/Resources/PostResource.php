<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'nombre'=>$this->name,
            'slug'=>$this->slug,
            'extracto'=>$this->extract,
            'cuerpo'=>$this->body,
            'status'=>$this->status==1 ? 'BORRADOR' : 'PUBLICADO',
            'usuario'=>UserResource::make($this->whenLoaded('user')),
            'categoria'=>CategoryResource::make($this->whenLoaded('category')),
        ];
    }
}
