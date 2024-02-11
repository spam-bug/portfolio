<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeroSectionSettingsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->data->title ?? '',
            'description' => $this->data->description ?? '',
        ];
    }
}
