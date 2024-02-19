<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category->name,
            'subcategory' => $this->subcategory->name,
            'slug' => $this->slug,
            'title' => $this->title,
            'url' => $this->url,
            'status' => $this->status,
        ];
    }
}
