<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    private const DEFAULT_INTRO = 'Discovering reliable and high-quality resources online can take considerable effort. To make things easier, we have gathered a collection of external websites that provide valuable information. Simply click any link to open it in a new tab.';
    private const DEFAULT_FOOTER = 'Our CA firm in Pune is dedicated to providing exceptional accounting, taxation, and advisory services to a diverse clientele. With a focus on delivering personalized solutions, our experienced professionals assist businesses in navigating complex financial landscapes.';

    public function index()
    {
        $links = Link::where('is_active', true)->orderBy('sort_order')->get()->groupBy('category');
        $siteSettings = SiteSetting::pluck('value', 'key');

        return view('links', compact('links', 'siteSettings'));
    }

    public function edit()
    {
        $links = Link::orderBy('sort_order')->get();
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        $settings += [
            'links_title' => 'Links',
            'links_intro' => self::DEFAULT_INTRO,
            'links_footer' => self::DEFAULT_FOOTER,
        ];

        return view('admin.links.edit', compact('links', 'settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'links_title' => 'required|string|max:255',
            'links_intro' => 'nullable|string',
            'links_footer' => 'nullable|string',
            'links' => 'nullable|array',
            'links.*.title' => 'required|string|max:255',
            'links.*.url' => 'required|url|max:2000',
            'links.*.category' => 'required|in:gov,ca,financial,news,finance',
        ]);

        DB::transaction(function () use ($validated) {
            foreach (['links_title', 'links_intro', 'links_footer'] as $key) {
                SiteSetting::updateOrCreate(['key' => $key], ['value' => $validated[$key] ?? '']);
            }

            Link::query()->delete();
            foreach ($validated['links'] ?? [] as $order => $link) {
                Link::create([
                    'category' => $link['category'],
                    'title' => $link['title'],
                    'url' => $link['url'],
                    'sort_order' => $order,
                    'is_active' => true,
                ]);
            }
        });

        return redirect()->route('admin.links.edit')->with('success', 'Links page updated successfully.');
    }
}