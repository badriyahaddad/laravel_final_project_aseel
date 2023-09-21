<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray( $request): array
    {
        // dd($this->first()->id);
        return [
            'data' => $this->collection->map(function($item){
                return [
                    'id'=>$item->id
                ];
            }),
            // 'user_id' =>$this->id,
            // 'post_id' => $this->id,
            // 'content' => $this->id,
            // 'user' => new UserResource($this->whenLoaded('user')),
// 'post' => new PostResource($this->whenLoaded('post')),
        ];
    }
}
