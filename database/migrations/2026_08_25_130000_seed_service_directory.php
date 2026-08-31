<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        $services = [
            'business_registration' => [
                'GST Registration', 'MSME Udyam Registration', 'PF Registration', 'ESIC Registration',
                'Professional Tax Registration', 'FSSAI Registration', 'RERA Registration - Real Estate Agent',
                'Shop Act Registration', 'IEC Registration', 'Trademark Registration',
            ],
            'company_formation' => [
                'Private Limited Company', 'One Person Company (OPC)', 'LLP Registration',
                'Partnership Firm Registration', 'Section 8 Company', 'Sole Proprietorship Firm Registration',
            ],
            'audit_assurance' => ['Statutory Audit', 'Tax Audit', 'Stock Audit', 'LLP Audit', 'GST Audit'],
            'direct_tax' => ['Income Tax Return', 'Income Tax Notice Reply Service', 'TDS Return Services', 'Income Tax Consultancy'],
            'indirect_tax' => ['GST Return Filing Services', 'GST Refund Services', 'GST Cancellation Services', 'GST Consultancy'],
            'nri_tax_allied_services' => ['Residential Status for NRIs', 'NRI Income Tax Return Filing', 'Repatriation of Fund - 15CA, 15CB Certificate', 'Lower TDS Deduction Certificate - Form 13'],
            'corporate_laws' => ['Corporate Law Compliance', 'ROC Compliance', 'Annual Filing', 'Company Law Services'],
            'consultancy' => [
                'Accounting and Book-keeping Services', 'Payroll Processing Services', 'Management Reporting',
                'FEMA Related Services including Filings with RBI', 'Advance Ruling Representational Services',
                'Project Reports for Bank Approvals', 'Cash Flow Planning', 'Valuation & Verification of Fixed Assets',
                'Design & Review of Financial Controls, Systems and Processes', 'IND AS Conversion',
                'Group Reporting under IFRS / US GAAP',
            ],
        ];

        foreach ($services as $category => $titles) {
            foreach ($titles as $title) {
                \Illuminate\Support\Facades\DB::table('services')->updateOrInsert(
                    ['slug' => Str::slug($title)],
                    [
                        'title' => $title,
                        'category' => $category,
                        'short_description' => 'Professional support for ' . strtolower($title) . '.',
                        'description' => 'Our team provides practical, compliant, and timely support for ' . strtolower($title) . '.',
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }

    public function down()
    {
        // Service records are retained when rolling back so existing admin content is not deleted.
    }
};