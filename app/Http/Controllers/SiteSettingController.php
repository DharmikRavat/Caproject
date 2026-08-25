<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        return view('admin.site-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_address' => 'nullable|string|max:255',
            'about_us_text' => 'nullable|string',
            'about_us_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
            'facebook_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
        ]);

        foreach ($validated as $key => $value) {
            if ($key === 'about_us_image' && $request->hasFile('about_us_image')) {
                $setting = SiteSetting::firstOrNew(['key' => $key]);
                if ($setting->value) {
                    Storage::disk('public')->delete($setting->value);
                }
                $setting->value = $request->file('about_us_image')->store('settings', 'public');
                $setting->save();
            } else if ($key !== 'about_us_image') {
                SiteSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        return redirect()->back()->with('success', 'Site settings updated successfully.');
    }
}
