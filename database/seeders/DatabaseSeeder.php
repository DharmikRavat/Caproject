<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Industry;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\Testimonial;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@cafirm.com',
            'password' => Hash::make('password123'),
        ]);

        Service::create([
            'title' => 'GST Registration & Filing',
            'slug' => 'gst-registration-filing',
            'category' => 'ca_services',
            'icon' => 'file-invoice-dollar',
            'short_description' => 'Professional GST registration, return filing, and compliance support.',
            'description' => 'We help businesses with GST registration, monthly/quarterly returns, reconciliations, notices, and ongoing compliance support to keep operations smooth and legally compliant.',
            'featured' => true,
            'is_active' => true,
        ]);

        Service::create([
            'title' => 'Income Tax Advisory',
            'slug' => 'income-tax-advisory',
            'category' => 'ca_services',
            'icon' => 'calculator',
            'short_description' => 'Strategic tax planning and smooth ITR filing services.',
            'description' => 'Our team provides tax planning, ITR preparation, capital gains support, and advisory services for individuals, HUFs, businesses, and partnerships.',
            'featured' => true,
            'is_active' => true,
        ]);

        Service::create([
            'title' => 'Audit & Assurance',
            'slug' => 'audit-assurance',
            'category' => 'ca_services',
            'icon' => 'clipboard-check',
            'short_description' => 'Reliable audit, review, and internal control services.',
            'description' => 'We deliver statutory audit, tax audit, internal audit, and assurance support with a focus on accuracy, risk mitigation, and governance.',
            'featured' => true,
            'is_active' => true,
        ]);

        Service::create(['title' => 'Professional Tax Registration', 'slug' => 'professional-tax-registration', 'category' => 'business_registration', 'description' => 'Description', 'icon' => 'fa-file-invoice']);
        Service::create(['title' => 'FSSAI Registration', 'slug' => 'fssai-registration', 'category' => 'business_registration', 'description' => 'Description', 'icon' => 'fa-leaf']);
        Service::create(['title' => 'RERA Registration', 'slug' => 'rera-registration', 'category' => 'business_registration', 'description' => 'Description', 'icon' => 'fa-building']);
        Service::create(['title' => 'Shop Act Registration', 'slug' => 'shop-act-registration', 'category' => 'business_registration', 'description' => 'Description', 'icon' => 'fa-store']);
        
        Service::create(['title' => 'Section 8 Company Registration', 'slug' => 'section-8-company-registration', 'category' => 'company_formation', 'description' => 'Description', 'icon' => 'fa-hands-helping']);
        Service::create(['title' => 'Sole Proprietorship Firm', 'slug' => 'sole-proprietorship-firm', 'category' => 'company_formation', 'description' => 'Description', 'icon' => 'fa-user-tie']);
        Service::create(['title' => 'Private Limited Company', 'slug' => 'private-limited-company', 'category' => 'company_formation', 'description' => 'Description', 'icon' => 'fa-city']);
        Service::create(['title' => 'One Person Company', 'slug' => 'one-person-company', 'category' => 'company_formation', 'description' => 'Description', 'icon' => 'fa-user']);

        Industry::create([
            'name' => 'Manufacturing',
            'slug' => 'manufacturing',
            'description' => 'Custom financial advisory for manufacturing businesses dealing with supply chains, GST, and inventory compliance.',
            'icon' => 'industry',
            'is_active' => true,
        ]);

        Industry::create([
            'name' => 'Healthcare',
            'slug' => 'healthcare',
            'description' => 'Specialized compliance and financial planning support for clinics, hospitals, and healthcare startups.',
            'icon' => 'hospital',
            'is_active' => true,
        ]);

        Blog::create([
            'title' => 'Top Tax Planning Strategies for FY 2026',
            'slug' => 'top-tax-planning-strategies-for-fy-2026',
            'author' => 'Ritika Sharma',
            'excerpt' => 'Explore practical methods to reduce tax exposure while staying compliant.',
            'content' => 'Tax planning can make a major difference to your annual financial outcomes. Proactive review of deductions, investments, and compliance filings helps avoid unnecessary liabilities while supporting growth.',
            'is_published' => true,
        ]);

        Blog::create([
            'title' => 'How GST Compliance Helps Grow Your Business',
            'slug' => 'how-gst-compliance-helps-grow-your-business',
            'author' => 'Amit Verma',
            'excerpt' => 'A smooth GST process improves transparency and strengthens decision-making.',
            'content' => 'GST compliance is more than a filing task—it supports cash flow management, business credibility, and data-driven planning. Keeping records clean and timely improves the resilience of your operations.',
            'is_published' => true,
        ]);

        Career::create([
            'title' => 'Senior Tax Associate',
            'slug' => 'senior-tax-associate',
            'location' => 'New Delhi',
            'type' => 'Full-time',
            'experience' => '3-5 years',
            'summary' => 'Support client tax planning and direct tax compliance work.',
            'description' => 'We are looking for a Senior Tax Associate to prepare returns, handle documentation, and work closely with clients on tax advisory assignments.',
            'is_active' => true,
        ]);

        Career::create([
            'title' => 'Audit Executive',
            'slug' => 'audit-executive',
            'location' => 'Bengaluru',
            'type' => 'Full-time',
            'experience' => '1-3 years',
            'summary' => 'Assist in audit fieldwork, risk analysis, and financial review.',
            'description' => 'The Audit Executive will support statutory and tax audits, prepare working papers, and review key financial processes for accuracy and compliance.',
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'CA Neha Gupta',
            'position' => 'Managing Partner',
            'bio' => 'Leading strategic growth, client advisory, and governance across the firm.',
            'email' => 'neha@cafirm.com',
            'phone' => '+91 98765 43210',
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'CA Rohit Mehta',
            'position' => 'Head of Taxation',
            'bio' => 'Specializes in tax planning, restructuring, and advanced compliance support.',
            'email' => 'rohit@cafirm.com',
            'phone' => '+91 98765 43211',
            'is_active' => true,
        ]);

        Banner::create([
            'title' => 'Trusted Chartered Accountants',
            'subtitle' => 'Helping businesses grow with clarity, compliance, and confidence.',
            'link' => '/services',
            'button_text' => 'Explore Services',
            'is_active' => true,
        ]);

        Testimonial::create(['author' => 'Prakash Sharma', 'rating' => 5, 'content' => 'Excellent service! Highly professional and timely communication.', 'is_active' => true]);
        Testimonial::create(['author' => 'Ramesh Gupta', 'rating' => 5, 'content' => 'They helped me with my GST registration very quickly.', 'is_active' => true]);
        Testimonial::create(['author' => 'Aarti Desai', 'rating' => 4, 'content' => 'Great experience overall. The team is very knowledgeable.', 'is_active' => true]);

        SiteSetting::create(['key' => 'about_us_text', 'value' => 'Apex CA is a leading firm of Chartered Accountants in Pune. We provide a comprehensive range of professional services, including Audit and Assurance, Direct and Indirect Taxation, Corporate Advisory, Accounting, and Business Outsourcing. Our team of dedicated professionals is committed to delivering quality services with a focus on client satisfaction.']);
        SiteSetting::create(['key' => 'contact_email', 'value' => 'info@apexca.in']);
        SiteSetting::create(['key' => 'contact_phone', 'value' => '+91 98765 43210']);
    }
}
