<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class LinkExtractorService
{
    public function extract(string $url): array
    {
        $html = Http::get($url)->body();
        $crawler = new Crawler($html);

        if (str_contains($url, 'kompasiana.com')) {
            return $this->extractKompasiana($crawler);
        }
        if (str_contains($url, 'retizen.republika.co.id')) {
            return $this->extractRetizen($crawler);
        }
        if (str_contains($url, 'man2bantul.id')) {
            return $this->extractMan2Bantul($crawler);
        }

        return [
            'title' => null,
            'date_posted' => null,
        ];
    }

    private function extractKompasiana(Crawler $crawler): array
    {
         // Judul bisa kamu sesuaikan dengan struktur H1 yang benar (misal: h1.read__title atau h1.article__title)
        $titleNode = $crawler->filter('h1.title');
        $title = $titleNode->count() ? $titleNode->text() : null;

        // Ambil tanggal dari <span class="count-item"> pertama
        $dateNode = $crawler->filter('span.count-item')->first();
        $dateText = $dateNode->count() ? $dateNode->text() : null;

        $tanggal = now();

        if ($dateText) {
            // Ambil hanya tanggalnya (tanpa waktu)
            // Misal: "24 Juli 2025 12:43" → ambil "24 Juli 2025"
            $tanggalStr = trim(explode(' ', $dateText)[0]);

            try {
                $tanggal = \Carbon\Carbon::createFromLocaleFormat('d F Y', 'id', $tanggalStr);
            } catch (\Exception $e) {
                $tanggal = now(); // fallback
            }
        }

        return [
            'title' => $title,
            'date_posted' => $tanggal->format('Y-m-d'),
        ];
    }

    private function extractRetizen(Crawler $crawler): array
    {
        // Judul dari og:title
        $title = $crawler->filterXPath('//meta[@property="og:title"]')->attr('content') ?? null;

        // Tanggal dari article:published_time (format: 2025-07-04T14:30:00+07:00)
        $dateRaw = $crawler->filterXPath('//meta[@property="article:published_time"]')->attr('content') ?? null;

        $tanggal = now();

        if ($dateRaw) {
            try {
                $tanggal = \Carbon\Carbon::parse($dateRaw)->startOfDay(); // Ambil tanggal saja
            } catch (\Exception $e) {
                // fallback tetap pakai now()
            }
        }

        return [
            'title' => $title,
            'date_posted' => $tanggal->format('Y-m-d'),
        ];
    }

    private function extractMan2Bantul(Crawler $crawler): array
{
    $title = null;
    $date_posted = null;

    try {
        // Coba H1 dulu
        if ($crawler->filter('h1.elementor-heading-title')->count()) {
            $title = $crawler->filter('h1.elementor-heading-title')->text();
        }

        // Fallback ke og:title
        if (!$title && $crawler->filterXPath('//meta[@property="og:title"]')->count()) {
            $title = $crawler->filterXPath('//meta[@property="og:title"]')->attr('content');
        }

        // Tanggal dari meta
        if ($crawler->filterXPath('//meta[@property="article:published_time"]')->count()) {
            $dateRaw = $crawler->filterXPath('//meta[@property="article:published_time"]')->attr('content');
            $date_posted = \Carbon\Carbon::parse($dateRaw)->format('Y-m-d');
        }
    } catch (\Exception $e) {
        return [
            'title' => null,
            'date_posted' => null,
            'error' => $e->getMessage(),
        ];
    }

    return [
        'title' => $title,
        'date_posted' => $date_posted,
    ];
}

}