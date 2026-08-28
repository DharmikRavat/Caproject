<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Link;

class LinkSeeder extends Seeder
{
    public function run()
    {
        $links = [
            // Government Websites -> gov
            ['category' => 'gov', 'title' => 'RBI', 'url' => 'https://www.rbi.org.in/'],
            ['category' => 'gov', 'title' => 'Mahagst / MAHAVAT', 'url' => 'https://www.mahagst.gov.in/'],
            ['category' => 'gov', 'title' => 'Income Tax Department, India', 'url' => 'https://www.incometax.gov.in/'],
            ['category' => 'gov', 'title' => 'e-Filing of Income Tax Return', 'url' => 'https://www.incometax.gov.in/iec/foportal/'],
            ['category' => 'gov', 'title' => 'Ministry of Corporate Affairs', 'url' => 'https://www.mca.gov.in/'],
            ['category' => 'gov', 'title' => 'ITAT Online', 'url' => 'https://itat.gov.in/'],
            ['category' => 'gov', 'title' => 'Central Board of Excise and Customs / CBIC', 'url' => 'https://www.cbic.gov.in/'],
            ['category' => 'gov', 'title' => 'GST', 'url' => 'https://www.gst.gov.in/'],
            ['category' => 'gov', 'title' => 'Directorate General of Foreign Trade', 'url' => 'https://www.dgft.gov.in/'],
            ['category' => 'gov', 'title' => 'MahaRERA', 'url' => 'https://www.maharera.maharashtra.gov.in/'],
            ['category' => 'gov', 'title' => 'Registration of Firm – ROF', 'url' => 'https://rof.maharashtra.gov.in/'],
            ['category' => 'gov', 'title' => 'MSME / Udyam Registration', 'url' => 'https://udyamregistration.gov.in/'],
            ['category' => 'gov', 'title' => 'Udyog Aadhaar Registration', 'url' => 'https://udyamregistration.gov.in/'],
            ['category' => 'gov', 'title' => 'Mahagst', 'url' => 'https://www.mahagst.gov.in/'],

            // Financial Institutions -> financial
            ['category' => 'financial', 'title' => 'HDFC Bank', 'url' => 'https://www.hdfc.bank.in/'],
            ['category' => 'financial', 'title' => 'ICICI Bank', 'url' => 'https://www.icici.bank.in/'],
            ['category' => 'financial', 'title' => 'State Bank of India', 'url' => 'https://sbi.co.in/'],
            ['category' => 'financial', 'title' => 'Indian Overseas Bank', 'url' => 'https://www.iob.in/'],
            ['category' => 'financial', 'title' => 'Punjab National Bank', 'url' => 'https://www.pnbindia.in/'],
            ['category' => 'financial', 'title' => 'IndusInd Bank', 'url' => 'https://www.indusind.com/'],
            ['category' => 'financial', 'title' => 'Bank of India', 'url' => 'https://bankofindia.co.in/'],
            ['category' => 'financial', 'title' => 'Bank of Maharashtra', 'url' => 'https://bankofmaharashtra.bank.in/'],
            ['category' => 'financial', 'title' => 'Canara Bank', 'url' => 'https://canarabank.com/'],
            ['category' => 'financial', 'title' => 'Union Bank of India', 'url' => 'https://www.unionbankofindia.co.in/'],

            // CA Governance -> ca
            ['category' => 'ca', 'title' => 'ICAI', 'url' => 'https://www.icai.org/'],
            ['category' => 'ca', 'title' => 'Pune ICAI', 'url' => 'https://www.icai.org/post/wirc-branches-directory'],
            ['category' => 'ca', 'title' => 'UDIN', 'url' => 'https://udin.icai.org/'],

            // News -> news
            ['category' => 'news', 'title' => 'Times of India', 'url' => 'https://timesofindia.indiatimes.com/'],
            ['category' => 'news', 'title' => 'Indian Express', 'url' => 'https://indianexpress.com/'],
            ['category' => 'news', 'title' => 'Hindustan Times', 'url' => 'https://www.hindustantimes.com/'],
            ['category' => 'news', 'title' => 'Economic Times', 'url' => 'https://economictimes.indiatimes.com/'],

            // Finance -> finance
            ['category' => 'finance', 'title' => 'Bombay Stock Exchange', 'url' => 'https://www.bseindia.com/'],
            ['category' => 'finance', 'title' => 'National Stock Exchange', 'url' => 'https://www.nseindia.com/'],
            ['category' => 'finance', 'title' => 'Moneycontrol', 'url' => 'https://www.moneycontrol.com/'],
        ];

        Link::truncate();

        foreach ($links as $index => $link) {
            $link['sort_order'] = $index;
            $link['is_active'] = true;
            Link::create($link);
        }
    }
}
