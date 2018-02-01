<?php

namespace App\Http\Resources;

use App\Comment;
use Illuminate\Http\Resources\Json\Resource;

class CommentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'commentable_id' => $this->commentable_id,
            'commentable_type' => $this->commentable_type,
            'content' => $this->content,
            'user' => new UserResource($this->user) ,
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
