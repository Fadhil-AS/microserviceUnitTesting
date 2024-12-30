<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Repositories\FAQRepository;
use App\Services\FAQService;

class FAQTest extends TestCase
{
   private $faqService;

    protected function setUp(): void
    {
        $faqRepositoryMock = $this->createMock(FAQRepository::class);

        $faqRepositoryMock->method('getFAQs')
            ->willReturn([
            [
                'id' => 1,
                'question' => 'Bagaimana membuat janji temu dengan dokter?',
                'answer' => 'Anda dapat menghubungi call center RSUP Hasan Sadikin.'
            ],
            [
                'id' => 2,
                'question' => 'Bagaimana saya menghubungi ambulan?',
                'answer' => 'Anda dapat menghubungi layanan ambulan 24 jam kami di nomor: (021) 123-4567. Layanan ini tersedia untuk kebutuhan darurat dan non-darurat.'
            ]
        ]);


        $this->faqService = new FAQService($faqRepositoryMock);
    }

    public function testGetFAQs(): void
    {
        $faqs = $this->faqService->getFAQs();

        $this->assertCount(2, $faqs);
        $this->assertEquals('Bagaimana membuat janji temu dengan dokter?', $faqs[0]['question']);
        $this->assertEquals('Anda dapat menghubungi call center RSUP Hasan Sadikin.', $faqs[0]['answer']);
    }

    public function testFAQFilterByKeyword(): void
    {
        $filteredFAQs = $this->faqService->filterFAQsByKeyword('ambulan');

        $this->assertCount(1, $filteredFAQs);

        $this->assertEquals('Bagaimana saya menghubungi ambulan?', $filteredFAQs[array_key_first($filteredFAQs)]['question']);
    }

}

