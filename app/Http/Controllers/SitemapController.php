<?php

namespace App\Http\Controllers;

use App\Models\Villas;
use App\Models\Product;
use App\Models\Experience;
use App\Models\BlogPost;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate sitemap.xml for SEO (prasanabyarjaniresorts.com/sitemap.xml)
     */
    public function index(): Response
    {
        $baseUrl = rtrim(config('app.url'), '/');

        $urls = [];

        // Halaman statis
        $staticPages = [
            ['path' => '', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['path' => '/our-villa', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/dinings', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/menaka-spa', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/weddings', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/offers', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/experience', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/gallery', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/contact-us', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog', 'priority' => '0.9', 'changefreq' => 'weekly'],
        ];

        foreach ($staticPages as $page) {
            $urls[] = [
                'loc' => $baseUrl . $page['path'],
                'lastmod' => now()->toW3cString(),
                'changefreq' => $page['changefreq'],
                'priority' => $page['priority'],
            ];
        }

        // Villa detail
        $villas = Villas::orderBy('id')->get(['slug', 'updated_at']);
        foreach ($villas as $villa) {
            $urls[] = [
                'loc' => $baseUrl . '/our-villa/' . $villa->slug,
                'lastmod' => $villa->updated_at->toW3cString(),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ];
        }

        // Wedding detail
        $weddings = Product::where('type', 'wedding')->orderBy('id')->get(['slug', 'updated_at']);
        foreach ($weddings as $item) {
            $urls[] = [
                'loc' => $baseUrl . '/weddings/' . $item->slug,
                'lastmod' => $item->updated_at->toW3cString(),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ];
        }

        // Offers detail
        $offers = Product::where('type', 'offer')->orderBy('id')->get(['slug', 'updated_at']);
        foreach ($offers as $item) {
            $urls[] = [
                'loc' => $baseUrl . '/offers/' . $item->slug,
                'lastmod' => $item->updated_at->toW3cString(),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ];
        }

        // Experience detail
        $experiences = Experience::orderBy('id')->get(['slug', 'updated_at']);
        foreach ($experiences as $item) {
            $urls[] = [
                'loc' => $baseUrl . '/experience/' . $item->slug,
                'lastmod' => $item->updated_at->toW3cString(),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ];
        }

        // Blog posts (hanya yang published)
        $posts = BlogPost::published()->orderBy('published_at', 'desc')->get(['slug', 'updated_at', 'published_at']);
        foreach ($posts as $post) {
            $lastmod = $post->updated_at ?? $post->published_at ?? now();
            $urls[] = [
                'loc' => $baseUrl . '/blog/' . $post->slug,
                'lastmod' => $lastmod->toW3cString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        }

        $xml = $this->buildXml($urls);

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
            'Charset' => 'UTF-8',
        ]);
    }

    private function buildXml(array $urls): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $u) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($u['loc']) . '</loc>' . "\n";
            $xml .= '    <lastmod>' . ($u['lastmod'] ?? now()->toW3cString()) . '</lastmod>' . "\n";
            if (!empty($u['changefreq'])) {
                $xml .= '    <changefreq>' . $u['changefreq'] . '</changefreq>' . "\n";
            }
            if (!empty($u['priority'])) {
                $xml .= '    <priority>' . $u['priority'] . '</priority>' . "\n";
            }
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';
        return $xml;
    }
}
