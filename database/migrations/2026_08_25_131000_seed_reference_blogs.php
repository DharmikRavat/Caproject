<?php

use App\Models\Blog;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $blogs = [
            ['UPDATED RETURN (ITR-U)', '30 May 2024', 'Updated returns allow taxpayers to correct omissions or errors within the permitted statutory window.', 'Income Tax', 'ITR, Income Tax, Compliance', 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1000&q=80'],
            ['PENALTY FOR LATE FILING OF ITR', '15 May 2024', 'A practical overview of late filing consequences and the steps taxpayers should take before submitting a return.', 'Income Tax', 'ITR, Tax Planning, Compliance', 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=1000&q=80'],
            ['ITR FILING FOR SALARIED EMPLOYEES', '10 May 2024', 'Learn how to review Form 16, claim eligible deductions, and submit an accurate income tax return.', 'Income Tax', 'ITR, Salaried Employees, Tax', 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1000&q=80'],
            ['BELATED INCOME TAX RETURN VS REVISED INCOME TAX RETURN', '02 May 2024', 'Understand when a belated return or a revised return may be appropriate and how the two options differ.', 'Compliance', 'ITR, Compliance, Income Tax', 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1000&q=80'],
            ['INCOME TAX RETURN (ITR) DUE DATE FY 2025-26', '25 Apr 2024', 'A useful filing calendar helps taxpayers plan documentation and avoid preventable late fees.', 'Tax', 'ITR, Tax Planning, Compliance', 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=1000&q=80'],
        ];

        foreach ($blogs as [$title, $date, $excerpt, $category, $tags, $image]) {
            Blog::firstOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'author' => 'CA Jitesh Tellsara',
                    'excerpt' => $excerpt,
                    'content' => $excerpt . ' This article is intended for general information; seek professional advice for your circumstances.',
                    'image' => $image,
                    'category' => $category,
                    'tags' => $tags,
                    'is_published' => true,
                    'created_at' => now()->setDateFrom(now()->createFromFormat('d M Y', $date)),
                    'updated_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
        foreach (['updated-return-itr-u', 'penalty-for-late-filing-of-itr', 'itr-filing-for-salaried-employees', 'belated-income-tax-return-vs-revised-income-tax-return', 'income-tax-return-itr-due-date-fy-2025-26'] as $slug) {
            Blog::where('slug', $slug)->delete();
        }
    }
};