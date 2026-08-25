<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            'about_page_title' => 'About Us - CA in Pune',
            'about_page_intro' => 'Jitesh Tellsara & Associates LLP is a Pune based professionally managed firm catering to domestic and international clients with a wide range of services in domestic and international taxation, regulatory and advisory services, and cross border transaction related services. Our team consists of experienced professionals who possess deep technical knowledge in their respective areas of specialization.',
            'about_page_intro_secondary' => 'We are a dedicated team of Chartered Accountants in Maharashtra providing dynamic services covering accounting, auditing, internal control reviews, direct and indirect taxation, corporate governance, and corporate financial advisory.',
            'about_page_why_title' => 'Why choose Jitesh Tellsara & Associates LLP?',
            'about_page_why_points' => json_encode([
                "We have a professional, proactive, and partnership approach towards clients' needs.",
                'We prioritize regular communication to eliminate concerns and ensure prompt services.',
                'We abide by our commitments and maintain total transparency in reporting.',
                'We provide a wide range of expert solutions under one single roof.',
            ]),
            'about_page_vision' => 'To be the most highly respected professional firm where clients come for peace of mind that their interests are being cared for, delivered with continuous quality standards, consistency, integrity, and trust.',
            'about_page_hero_image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=1600&q=80',
            'about_page_vision_image' => 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=1600&q=80',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function down(): void
    {
        SiteSetting::whereIn('key', [
            'about_page_title', 'about_page_intro', 'about_page_intro_secondary',
            'about_page_why_title', 'about_page_why_points', 'about_page_vision',
            'about_page_hero_image', 'about_page_vision_image',
        ])->delete();
    }
};