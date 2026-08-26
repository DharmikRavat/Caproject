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
            'is_admin' => true,
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

        SiteSetting::create(['key' => 'links_title', 'value' => 'Links']);
        SiteSetting::create(['key' => 'links_intro', 'value' => 'Explore useful government, professional, financial, news, and market resources.']);
        SiteSetting::create(['key' => 'links_footer', 'value' => 'Jitesh Tellsara & Associates LLP is a professionally managed Chartered Accountant firm in Pune providing taxation, regulatory, audit, and advisory services to domestic and international clients.']);

        foreach ([
            ['gov', 'RBI', 'https://www.rbi.org.in/'],
            ['gov', 'Mahavat', 'https://www.mahagst.gov.in/'],
            ['gov', 'Income Tax Department, India', 'https://www.incometax.gov.in/'],
            ['gov', 'e-Filing of your Income Tax Return', 'https://www.incometax.gov.in/iec/foportal/'],
            ['gov', 'Ministry of Corporate Affairs', 'https://www.mca.gov.in/'],
            ['gov', 'ITAT Online', 'https://itat.gov.in/'],
            ['gov', 'Central Board Of Excise and Customs', 'https://www.cbic.gov.in/'],
            ['gov', 'GST', 'https://www.gst.gov.in/'],
            ['gov', 'Directorate General of Foreign Trade', 'https://www.dgft.gov.in/'],
            ['gov', 'Maharera', 'https://maharera.mahaonline.gov.in/'],
            ['gov', 'Registration of Firm - ROF', 'https://rof.mahaonline.gov.in/'],
            ['gov', 'MSME', 'https://msme.gov.in/'],
            ['gov', 'Udyam Registration', 'https://udyamregistration.gov.in/'],
            ['gov', 'Mahagst', 'https://www.mahagst.gov.in/'],
            ['ca', 'ICAI', 'https://www.icai.org/'],
            ['ca', 'PUNE ICAI', 'https://puneicai.org/'],
            ['ca', 'UDIN', 'https://udin.icai.org/'],
            ['financial', 'HDFC Bank', 'https://www.hdfcbank.com/'],
            ['financial', 'ICICI Bank', 'https://www.icicibank.com/'],
            ['financial', 'State Bank Of India', 'https://sbi.co.in/'],
            ['financial', 'Indian Overseas Bank', 'https://www.iob.in/'],
            ['financial', 'Punjab National Bank', 'https://www.pnbindia.in/'],
            ['financial', 'IndusInd Bank', 'https://www.indusind.com/'],
            ['financial', 'Bank of India', 'https://bankofindia.co.in/'],
            ['financial', 'Bank of Maharashtra', 'https://bankofmaharashtra.in/'],
            ['financial', 'Canara Bank', 'https://canarabank.com/'],
            ['financial', 'Union Bank Of India', 'https://www.unionbankofindia.co.in/'],
            ['news', 'Times of India', 'https://timesofindia.indiatimes.com/'],
            ['news', 'Indian Express', 'https://indianexpress.com/'],
            ['news', 'Hindustan Times', 'https://www.hindustantimes.com/'],
            ['news', 'Economic Times', 'https://economictimes.indiatimes.com/'],
            ['finance', 'Bombay Stock Exchange', 'https://www.bseindia.com/'],
            ['finance', 'National Stock Exchange', 'https://www.nseindia.com/'],
            ['finance', 'Moneycontrol', 'https://www.moneycontrol.com/'],
        ] as $order => [$category, $title, $url]) {
            \App\Models\Link::create(compact('category', 'title', 'url') + ['sort_order' => $order, 'is_active' => true]);
        }
    }
}
