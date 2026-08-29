<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceHierarchySeeder extends Seeder
{
    public function run()
    {
        $hierarchy = [
            'Business Registration' => [
                'GST Registration', 'MSME Udyam Registration', 'PF Registration', 
                'ESIC Registration', 'Professional Tax Registration', 'FSSAI Registration', 
                'RERA Registration', 'Shop Act Registration', 'IEC Registration', 
                'Trademark Registration', 'NSIC Registration'
            ],
            'Company Formation' => [
                'Private Limited Company', 'One Person Company (OPC)', 'LLP Registration', 
                'Partnership Firm Registration', 'Section 8 Company', 'Sole Proprietorship Firm Registration'
            ],
            'Audit & Assurance' => [
                'Statutory Audit', 'Internal Audit', 'Management Audit', 'Bank Audit', 
                'Limited Review', 'Tax Audit', 'GST Audit', 'Stock Audit', 'LLP Audit'
            ],
            'Direct Tax' => [
                'Income Tax Return', 'Income Tax Consultancy', 'Income Tax Notice Reply', 
                'TDS Return Services', 'Tax Planning', 'Capital Gain Tax', 'Business ITR', 
                'Salary ITR', 'NRI ITR', 'Company ITR'
            ],
            'Indirect Tax' => [
                'GST Return Filing', 'GST Refund Services', 'GST Cancellation', 'GST Consultancy'
            ],
            'Corporate Laws' => [], // Fully dynamic, services can be added from Admin
            'Regulatory & Advisory Services' => [
                'Accounting & Bookkeeping', 'Payroll Processing', 'Management Reporting', 
                'FEMA Services', 'RBI Filings', 'Advance Ruling Representation', 
                'Project Reports for Bank Approval', 'Cash Flow Planning', 
                'Fixed Asset Valuation & Verification', 'Financial Controls & Process Review', 
                'IND AS Conversion', 'IFRS / US GAAP Group Reporting'
            ],
            'NRI Tax & Allied Services' => [
                'Residential Status for NRIs', 'NRI Income Tax Return Filing', 
                'Repatriation of Funds – Form 15CA/15CB', 'Lower TDS Deduction Certificate – Form 13'
            ],
        ];

        foreach ($hierarchy as $categoryName => $services) {
            $category = ServiceCategory::updateOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName, 'status' => true]
            );

            foreach ($services as $serviceName) {
                Service::updateOrCreate(
                    ['slug' => Str::slug($serviceName)],
                    ['category_id' => $category->id, 'name' => $serviceName, 'description' => '', 'status' => true]
                );
            }
        }
    }
}
