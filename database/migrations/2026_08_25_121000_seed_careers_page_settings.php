<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            'careers_page_title' => 'Shape your Career with us',
            'careers_page_form_title' => 'Shape your Career with us',
            'careers_page_intro_1' => 'We at M/s Jitesh Tellsara & Associates LLP boost and shape the career of young and dynamic aspirants and help them become professionals with excellent work ethics and a friendly work culture. Connect with us to kick start or build your career with the best Chartered Accountant firm in Pune.',
            'careers_page_intro_2' => 'At M/s Jitesh Tellsara & Associates LLP, we are looking for professionals to further expand our team to meet the needs of our clients. We are mainly looking for professionals at the following levels:',
            'careers_page_roles' => "Chartered Accountants (Experienced as well as fresher)\nArticled Assistant\nAudit & Tax Assistants (Graduates or Post Graduates)",
            'careers_page_intro_3' => 'The areas of work shall include Audit, Taxation, and Consulting assignments of the firm. Send your profile for Audits, Direct & Indirect Tax, FEMA, ROC, and Consultancy assignments and we will get back to you.',
            'careers_page_image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function down(): void
    {
        SiteSetting::whereIn('key', ['careers_page_title', 'careers_page_form_title', 'careers_page_intro_1', 'careers_page_intro_2', 'careers_page_roles', 'careers_page_intro_3', 'careers_page_image'])->delete();
    }
};