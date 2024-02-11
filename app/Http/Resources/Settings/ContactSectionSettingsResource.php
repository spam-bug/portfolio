<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactSectionSettingsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'email' => $this->data->email ?? '',
            'mobile_number' => $this->data->mobile_number ?? ''
        ];
    }
}
