<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            'contact_page_title' => 'Reach us for Best Chartered Accounting Services',
            'contact_page_intro' => "Even though we are a firm of Chartered Accountants in Vimannagar, with our services of online consultation and 'No Need to Visit' approach for our clients, we act as any CA Near Me for our prospective clients located anywhere on the globe.",
            'contact_page_schedule' => "Monday to Saturday: 10.00 am to 06.30 pm\nSunday: Closed",
            'contact_page_map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.359560416399!2d73.916168!3d18.557885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m3!1m2!1s0x0%3A0x0!2zMTjCsDMzJzI4LjQiTiA3M8KwNTQnNTguMiJF!5e0!3m2!1sen!2sin!4v1650000000000!5m2!1sen!2sin',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function down(): void
    {
        SiteSetting::whereIn('key', ['contact_page_title', 'contact_page_intro', 'contact_page_schedule', 'contact_page_map'])->delete();
    }
};