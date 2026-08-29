<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
            'site_name' => 'nullable|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:4096',
            'contact_page_hero_image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:4096',
            'links_page_hero_image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:4096',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_address' => 'nullable|string|max:255',
            'header_office_timing' => 'nullable|string|max:255',
            'footer_copyright_text' => 'nullable|string|max:500',
            'footer_about_text' => 'nullable|string',
            'about_us_text' => 'nullable|string',
            'about_us_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
            'about_page_title' => 'required|string|max:255',
            'about_page_intro' => 'required|string',
            'about_page_intro_secondary' => 'required|string',
            'about_page_why_title' => 'required|string|max:255',
            'about_page_why_points' => 'required|array|size:4',
            'about_page_why_points.*' => 'required|string|max:500',
            'about_page_vision' => 'required|string',
            'about_page_hero_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
            'about_page_vision_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
            'careers_page_title' => 'required|string|max:255',
            'careers_page_form_title' => 'required|string|max:255',
            'careers_page_intro_1' => 'required|string',
            'careers_page_intro_2' => 'required|string',
            'careers_page_roles' => 'required|string',
            'careers_page_intro_3' => 'required|string',
            'careers_page_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
            'contact_page_title' => 'required|string|max:255',
            'contact_page_intro' => 'required|string',
            'contact_page_schedule' => 'required|string',
            'contact_page_map' => 'nullable|url|max:2000',
            'facebook_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
        ]);

        foreach ($validated as $key => $value) {
            if (in_array($key, ['site_logo', 'about_us_image', 'about_page_hero_image', 'about_page_vision_image', 'careers_page_image', 'contact_page_hero_image', 'links_page_hero_image'], true) && $request->hasFile($key)) {
                $setting = SiteSetting::firstOrNew(['key' => $key]);
                if ($setting->value) {
                    Storage::disk('public')->delete($setting->value);
                }
                $setting->value = $request->file($key)->store('settings', 'public');
                $setting->save();
            } else if ($key === 'about_page_why_points') {
                SiteSetting::updateOrCreate(['key' => $key], ['value' => json_encode($value)]);
            } else if (!in_array($key, ['site_logo', 'about_us_image', 'about_page_hero_image', 'about_page_vision_image', 'careers_page_image', 'contact_page_hero_image', 'links_page_hero_image'], true)) {
                SiteSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        Cache::forget('site_settings');

        return redirect()->back()->with('success', 'Site settings updated successfully.');
    }
}
