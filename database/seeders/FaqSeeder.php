<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What is Campus SafeLine?',
                'answer' => 'Campus SafeLine is a secure platform for reporting safety concerns and incidents on campus.',
                'order' => 1,
            ],
            [
                'question' => 'How can I track my report?',
                'answer' => 'You can track your report using the case tracking number provided to you after submission.',
                'order' => 2,
            ],
            [
                'question' => 'Is my report confidential?',
                'answer' => 'Yes, all reports are handled with strict confidentiality and can only be accessed by authorized personnel.',
                'order' => 3,
            ],
            [
                'question' => 'How long does it take to process a report?',
                'answer' => 'Processing times vary depending on the nature and complexity of the report. You will be kept updated through the case tracking system.',
                'order' => 4,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
