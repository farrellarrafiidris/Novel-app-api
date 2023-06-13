<?php

namespace App\Http\Resources;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                =>  $this   ->  id,
            'title'             =>  $this   ->  title,
            'content'           =>  $this   ->  content,
            'image'             =>  $this   ->  image,
            'writer'            =>  $this   ->  penulis['username'],
            'created_at'        =>  date_format($this->created_at,"Y-m-d H:i"),
            'total_komentar'    =>  $this   ->  comments->count(),
            
            

        ];
    }
}
