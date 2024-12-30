<?php

namespace App\Services;

use App\Repositories\FAQRepository;

class FAQService
{
    private $repository;

    public function __construct(FAQRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getFAQs(): array
    {
        return $this->repository->getFAQs();
    }

    public function filterFAQsByKeyword(string $keyword): array
    {
        $faqs = $this->getFAQs();

        return array_filter($faqs, function ($faq) use ($keyword) {
            return stripos($faq['question'], $keyword) !== false || stripos($faq['answer'], $keyword) !== false;
        });
    }

}
