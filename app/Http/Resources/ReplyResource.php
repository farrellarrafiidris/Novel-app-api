<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this    ->id,
            'comment_id'        => $this    ->comment_id,
            'reply_content'     => $this    ->reply_content,
            'created_at'        => date_format($this->created_at,"Y-m-d H:i") 
        ];
    }
}
