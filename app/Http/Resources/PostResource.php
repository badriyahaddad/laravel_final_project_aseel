<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'location' => $this->location,
            'image' => $this->image,
            'user_id' => $this->user_id,
            'category_id' =>new CatagoryResource($this->whenLoaded('category_id')),
           'admin' => new AdminResource($this->whenLoaded('user_id')),
        ];
    }
    }

