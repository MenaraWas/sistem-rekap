<?php

namespace App\Services;

use App\Models\Platform;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class LinkExtractorService
{
    public function extract(string $url): array
    {
        // Find matching platform by domain
        $platform = Platform::whereNotNull('domain')
            ->get()
            ->first(function ($p) use ($url) {
                return str_contains($url, $p->domain);
            });

        if (!$platform || !$platform->title_selector) {
            return [
                'title' => null,
                'date_posted' => null,
            ];
        }

        $html = Http::get($url)->body();
        $crawler = new Crawler($html);

        return $this->extractDynamic($crawler, $platform);
    }

    private function extractDynamic(Crawler $crawler, Platform $platform): array
    {
        $title = null;
        $date_posted = null;

        try {
            // Extract title
            $title = $this->extractField($crawler, $platform->title_selector);

            // Extract date
            $dateRaw = $this->extractField($crawler, $platform->date_selector);

            if ($dateRaw) {
                $date_posted = $this->parseDate($dateRaw, $platform->date_format);
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
            'date_posted' => $date_posted ?? now()->format('Y-m-d'),
        ];
    }

    /**
     * Extract a field from the crawler using a CSS selector.
     * Supports meta tag selectors and regular CSS selectors.
     */
    private function extractField(Crawler $crawler, ?string $selector): ?string
    {
        if (!$selector) {
            return null;
        }

        // Handle meta tag selectors (e.g. meta[property="og:title"])
        if (str_starts_with($selector, 'meta[')) {
            $node = $crawler->filter($selector);
            return $node->count() ? $node->attr('content') : null;
        }

        // Regular CSS selector
        $node = $crawler->filter($selector);
        return $node->count() ? trim($node->first()->text()) : null;
    }

    /**
     * Parse a raw date string into Y-m-d format.
     */
    private function parseDate(?string $dateRaw, ?string $format): ?string
    {
        if (!$dateRaw) {
            return null;
        }

        try {
            if ($format) {
                return \Carbon\Carbon::createFromFormat($format, trim($dateRaw))->format('Y-m-d');
            }

            // Fallback: try to parse ISO 8601 or other auto-detected formats
            return \Carbon\Carbon::parse($dateRaw)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}