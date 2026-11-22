<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'isbn' => $this->isbn,
            'description' => $this->description,
            'published_year' => $this->published_year,
            'total_copies' => $this->total_copies,
            'available_copies' => $this->availableCopiesCount(),
            'categories' => $this->whenLoaded('categories'),
            'created_at' => $this->created_at,
        ];
    }
}
