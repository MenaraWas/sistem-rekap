<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Platform;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            [
                'name' => 'Instagram',
                'code' => 'instagram',
                'domain' => 'instagram.com',
                'category' => 'social_media',
                'icon' => 'heroicon-o-camera',
                'title_selector' => null,
                'date_selector' => null,
                'date_format' => null,
            ],
            [
                'name' => 'Facebook',
                'code' => 'facebook',
                'domain' => 'facebook.com',
                'category' => 'social_media',
                'icon' => 'heroicon-o-thumb-up',
                'title_selector' => null,
                'date_selector' => null,
                'date_format' => null,
            ],
            [
                'name' => 'Threads',
                'code' => 'threads',
                'domain' => 'threads.net',
                'category' => 'social_media',
                'icon' => 'heroicon-o-document-text',
                'title_selector' => null,
                'date_selector' => null,
                'date_format' => null,
            ],
            [
                'name' => 'Twitter',
                'code' => 'twitter',
                'domain' => 'x.com',
                'category' => 'social_media',
                'icon' => 'heroicon-o-document-text',
                'title_selector' => null,
                'date_selector' => null,
                'date_format' => null,
            ],
            [
                'name' => 'TikTok',
                'code' => 'tiktok',
                'domain' => 'tiktok.com',
                'category' => 'social_media',
                'icon' => 'heroicon-o-document-text',
                'title_selector' => null,
                'date_selector' => null,
                'date_format' => null,
            ],
            [
                'name' => 'Kompasiana',
                'code' => 'kompasiana',
                'domain' => 'kompasiana.com',
                'category' => 'news_portal',
                'icon' => 'heroicon-o-newspaper',
                'title_selector' => 'h1.title',
                'date_selector' => 'span.count-item',
                'date_format' => 'd F Y',
            ],
            [
                'name' => 'Retizen',
                'code' => 'retizen',
                'domain' => 'retizen.republika.co.id',
                'category' => 'news_portal',
                'icon' => 'heroicon-o-newspaper',
                'title_selector' => 'meta[property="og:title"]',
                'date_selector' => 'meta[property="article:published_time"]',
                'date_format' => null,
            ],
            [
                'name' => 'Telik Sandi',
                'code' => 'telik_sandi',
                'domain' => null,
                'category' => 'news_portal',
                'icon' => 'heroicon-o-document-text',
                'title_selector' => null,
                'date_selector' => null,
                'date_format' => null,
            ],
            [
                'name' => 'MAN 2 Bantul',
                'code' => 'man_2_bantul',
                'domain' => 'man2bantul.id',
                'category' => 'news_portal',
                'icon' => 'heroicon-o-academic-cap',
                'title_selector' => 'h1.elementor-heading-title',
                'date_selector' => 'meta[property="article:published_time"]',
                'date_format' => null,
            ],
            [
                'name' => 'Kemenag Bantul',
                'code' => 'kemenag_bantul',
                'domain' => 'bantul.kemenag.go.id',
                'category' => 'news_portal',
                'icon' => 'heroicon-o-globe-alt',
                'title_selector' => 'meta[property="og:title"]',
                'date_selector' => '.post-meta .post-created',
                'date_format' => 'm/d/Y',
            ],
        ];

        foreach ($platforms as $platform) {
            Platform::updateOrCreate(
                ['code' => $platform['code']],
                $platform
            );
        }
    }
}
