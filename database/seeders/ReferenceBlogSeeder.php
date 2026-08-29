<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Blog;
use Illuminate\Support\Str;

class ReferenceBlogSeeder extends Seeder
{
    public function run()
    {
        // Add Categories
        $categories = [
            'Taxation',
            'GST Updates',
            'Business Registration',
            'Auditing & Assurance',
            'Startup Compliance'
        ];

        $categoryModels = [];
        foreach ($categories as $index => $catName) {
            $categoryModels[] = BlogCategory::firstOrCreate(
                ['slug' => Str::slug($catName)],
                [
                    'name' => $catName,
                    'is_active' => true,
                    'sort_order' => $index
                ]
            );
        }

        // Add Tags
        $tags = [
            'Income Tax', 'GST', 'Startups', 'ROC', 'Compliance', 'Finance Bill', 'Updates'
        ];

        $tagModels = [];
        foreach ($tags as $tagName) {
            $tagModels[] = BlogTag::firstOrCreate(
                ['slug' => Str::slug($tagName)],
                ['name' => $tagName]
            );
        }

        // Add Blogs
        $blogs = [
            [
                'title' => 'Relaxation In E-filing Of Income Tax Forms 15CA/15CB Explained',
                'excerpt' => 'Understanding the recent relaxations provided by the IT department for manual filing of forms 15CA and 15CB.',
                'content' => '<p>The Central Board of Direct Taxes (CBDT) has granted further relaxation in electronic filing of forms 15CA and 15CB. Taxpayers can now submit manual forms to authorized dealers till the specified deadline.</p><h2>What are Forms 15CA and 15CB?</h2><p>Form 15CA is a declaration of remitter and is used as a tool for collecting information in respect of payments which are chargeable to tax in the hands of recipient non-resident. Form 15CB is a certificate issued by a Chartered Accountant ensuring that the provisions of the Double Taxation Avoidance Agreement and the Income Tax Act have been complied with.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1000&q=80',
                'category_id' => $categoryModels[0]->id,
                'published_date' => now()->subMonths(2)->format('Y-m-d'),
                'author' => 'CA Jitesh',
            ],
            [
                'title' => 'New Guidelines for Startup Recognition and Tax Exemption',
                'excerpt' => 'A comprehensive look at the new DPIIT guidelines for startup recognition and claiming tax holidays under Section 80IAC.',
                'content' => '<p>Startups recognized by DPIIT can avail tax exemptions for 3 consecutive years out of their first 10 years of incorporation. The new guidelines have streamlined the application process.</p><p>Key benefits include self-certification under labor laws, easy winding up of company, and fast-tracking of patent applications.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=1000&q=80',
                'category_id' => $categoryModels[4]->id,
                'published_date' => now()->subMonths(1)->format('Y-m-d'),
                'author' => 'CA Team',
            ],
            [
                'title' => 'Complete Guide to GST Registration Process for E-commerce Sellers',
                'excerpt' => 'Are you selling on Amazon or Flipkart? Here is everything you need to know about mandatory GST registration for e-commerce.',
                'content' => '<p>Under the GST regime, anyone selling goods or services through an e-commerce operator is required to register for GST irrespective of their turnover.</p><p>This means the threshold limit of Rs. 40 lakhs does not apply to e-commerce sellers.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1000&q=80',
                'category_id' => $categoryModels[1]->id,
                'published_date' => now()->subDays(15)->format('Y-m-d'),
                'author' => 'CA Team',
            ],
            [
                'title' => 'Why is Professional Tax Mandatory in Maharashtra?',
                'excerpt' => 'Understanding the PT slab rates and compliance requirements for employers and professionals in Maharashtra.',
                'content' => '<p>Professional Tax (PT) is a state-level tax imposed on income earned by way of profession, trade, calling, or employment.</p><p>In Maharashtra, the maximum PT payable is Rs. 2,500 per year. Employers must deduct this from salaries and remit it to the state government.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1554224154-26032ffc0d07?auto=format&fit=crop&w=1000&q=80',
                'category_id' => $categoryModels[2]->id,
                'published_date' => now()->subDays(5)->format('Y-m-d'),
                'author' => 'CA Jitesh',
            ],
            [
                'title' => 'Key Changes in the Latest Finance Bill',
                'excerpt' => 'An analysis of the major direct and indirect tax proposals introduced in the latest Union Budget.',
                'content' => '<p>The recent Finance Bill has brought significant changes to the new tax regime, making it the default option and increasing the rebate limit.</p><p>Additionally, presumptive taxation limits for small businesses and professionals have been enhanced, provided their cash receipts do not exceed 5% of total receipts.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1000&q=80',
                'category_id' => $categoryModels[0]->id,
                'published_date' => now()->format('Y-m-d'),
                'author' => 'CA Jitesh',
            ]
        ];

        foreach ($blogs as $blogData) {
            $blog = Blog::firstOrCreate(
                ['slug' => Str::slug($blogData['title'])],
                [
                    'title' => $blogData['title'],
                    'excerpt' => $blogData['excerpt'],
                    'content' => $blogData['content'],
                    'image' => $blogData['image_url'], // Since the blade view handles URLs, this works perfectly
                    'blog_category_id' => $blogData['category_id'],
                    'is_published' => true,
                    'published_date' => $blogData['published_date'],
                    'author' => $blogData['author'],
                    'sort_order' => 0,
                    'created_at' => \Carbon\Carbon::parse($blogData['published_date']), // Backdate created_at to populate archives
                ]
            );

            // Attach 2 random tags to each blog
            $randomTags = collect($tagModels)->random(2)->pluck('id')->toArray();
            $blog->tags()->sync($randomTags);
        }
    }
}
