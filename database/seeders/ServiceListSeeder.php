<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceListSeeder extends Seeder
{
    public function run()
    {
        $categoriesWithServices = [
            'business_registration' => [
                'GST Registration',
                'Udyog Aadhaar Registration',
                'PF Registration',
                'ESIC Registration',
                'Professional Tax Registration',
                'FSSAI Registration',
                'RERA Registration',
                'Shop Act Registration',
                'IEC Registration',
                'Trademark Registration'
            ],
            'company_formation' => [
                'Private Limited Company',
                'One Person Company',
                'Limited Liability Partnership',
                'Partnership Firm Registration',
                'Section 8 Company Registration',
                'Sole Proprietorship Firm Registration'
            ],
            'audit_assurance' => [
                'Statutory Audit',
                'Internal Audit',
                'Management Audit',
                'Bank Audit',
                'Limited Review',
                'Tax Audit',
                'GST Audit',
                'Other audit-related services'
            ],
            'direct_tax' => [
                'Income Tax Return',
                'Income Tax Consultancy',
                'Tax Planning',
                'Capital Gain',
                'Business ITR',
                'Salary ITR',
                'NRI ITR',
                'Company ITR',
                'LLP/Partnership ITR',
                'Other income-tax services'
            ],
            'corporate_laws' => [
                'Company incorporation',
                'ROC compliance',
                'Companies Act compliance',
                'LLP compliance',
                'Corporate regulatory services'
            ],
            'consultancy' => [
                'Business consultancy',
                'Tax consultancy',
                'Financial consultancy',
                'Management consultancy',
                'Advisory services'
            ],
            'nri_tax_allied_services' => [
                'NRI taxation',
                'NRI ITR',
                'NRI compliance',
                'Tax planning',
                'Allied NRI services'
            ]
        ];

        foreach ($categoriesWithServices as $category => $serviceTitles) {
            foreach ($serviceTitles as $index => $title) {
                $slug = Str::slug($title);
                Service::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'title' => $title,
                        'category' => $category,
                        'is_active' => true,
                        'featured' => ($index < 3),
                        'short_description' => "Professional {$title} services offered with comprehensive regulatory guidance and compliance support.",
                        'description' => "Our team provides complete end-to-end {$title} solutions for companies, startups, firms, and individuals with accuracy, efficiency, and compliance adhering to current statutory guidelines."
                    ]
                );
            }
        }
    }
}
