<?php

namespace App\Http\Controllers\Settings;

use App\Enums\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ContactSectionSettingsRequest;
use App\Http\Resources\Settings\ContactSectionSettingsResource;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;

class ContactSectionSettingsController extends Controller
{
    public function index(): ContactSectionSettingsResource
    {
        return new ContactSectionSettingsResource(
            resource: Setting::where('name', Settings::ContactSection)->first()
        );
    }

    public function update(ContactSectionSettingsRequest $request): RedirectResponse
    {
        Setting::updateOrCreate(
            ['name' => Settings::ContactSection],
            ['data' => $request->all()]
        );

        return redirect()->back();
    }
}
