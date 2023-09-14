<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=> $this->id,
            'title'=> $this->title,
    'content'=>$this->content,
    'location'=>$this->location,
    'image'=> $this ->  image,
    'user_id'=>$this -> user_id,
    'category_id' => $this -> category_id
        ];
    }
}
