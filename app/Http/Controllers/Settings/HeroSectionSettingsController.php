<?php

namespace App\Http\Controllers\Settings;

use App\Enums\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\HeroSectionSettingsRequest;
use App\Http\Resources\Settings\HeroSectionSettingsResource;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;

class HeroSectionSettingsController extends Controller
{
    public function index(): HeroSectionSettingsResource
    {
        return new HeroSectionSettingsResource(
            resource: Setting::where('name', Settings::HeroSection)->first()
        );
    }

    public function update(HeroSectionSettingsRequest $request): RedirectResponse
    {
        Setting::updateOrCreate(
            ['name' => Settings::HeroSection],
            ['data' => $request->all()],
        );

        return redirect()->back();
    }
}
