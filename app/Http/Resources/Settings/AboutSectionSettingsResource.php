<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutSectionSettingsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'description' => $this->data->description ?? '',
        ];
    }
}
