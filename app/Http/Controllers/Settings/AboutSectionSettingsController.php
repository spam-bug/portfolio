<?php

namespace App\Http\Controllers\Settings;

use App\Enums\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AboutSectionSettingsRequest;
use App\Http\Resources\Settings\AboutSectionSettingsResource;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;

class AboutSectionSettingsController extends Controller
{
    public function index(): AboutSectionSettingsResource
    {
        return new AboutSectionSettingsResource(
            resource: Setting::where('name', Settings::AboutSection)->first()
        );
    }

    public function update(AboutSectionSettingsRequest $request): RedirectResponse
    {
        Setting::updateOrCreate(
            ['name' => Settings::AboutSection],
            ['data' => $request->all()]
        );

        return redirect()->back();
    }
}
