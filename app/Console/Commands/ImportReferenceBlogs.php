<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Symfony\Component\DomCrawler\Crawler;
use Exception;
use Carbon\Carbon;

class ImportReferenceBlogs extends Command
{
    protected $signature = 'blogs:import-reference';
    protected $description = 'Import blogs from the reference website';

    protected $baseUrl = 'https://www.cajiteshtelisara.com';

    public function handle()
    {
        $this->info("Starting blog import from {$this->baseUrl}...");

        $listingUrls = [$this->baseUrl . '/blogs/'];
        $processedUrls = [];
        $blogUrls = [];

        // 1. Discover all listing pages (Pagination)
        $this->info("Fetching listing pages to discover blogs...");
        
        // Loop through multiple pages (we'll do up to 3 pages for now as a safe default, or until 404)
        for ($page = 1; $page <= 5; $page++) {
            $pageUrl = $page === 1 ? $this->baseUrl . '/blogs/' : $this->baseUrl . '/blogs/page/' . $page . '/';
            $this->info("Scanning: " . $pageUrl);
            
            try {
                $response = Http::get($pageUrl);
                if ($response->failed()) {
                    $this->info("Reached end of pagination or failed to load page: " . $page);
                    break;
                }

                $crawler = new Crawler($response->body(), $pageUrl);
                
                // On this theme, blog titles are typically inside h2 a, h3 a, or article a
                $links = $crawler->filter('h2 a, h3 a, .post-title a, article a.more-link, article .entry-title a')->links();
                
                foreach ($links as $link) {
                    $uri = $link->getUri();
                    // Exclude non-blog links
                    if (strpos($uri, '/author/') === false && strpos($uri, '/category/') === false && strpos($uri, '/tag/') === false && $uri !== $this->baseUrl . '/blogs/') {
                        // Strip query params and hashes to get clean URL
                        $cleanUri = explode('?', explode('#', $uri)[0])[0];
                        if (strlen($cleanUri) > strlen($this->baseUrl) + 5) {
                            $blogUrls[] = $cleanUri;
                        }
                    }
                }
            } catch (Exception $e) {
                $this->error("Error fetching page {$page}: " . $e->getMessage());
                break;
            }
        }
        
        $blogUrls = array_unique($blogUrls);
        $this->info("Discovered " . count($blogUrls) . " blog URLs.");

        $stats = [
            'discovered' => count($blogUrls),
            'imported' => 0,
            'updated' => 0,
            'skipped' => 0,
            'errors' => 0,
            'categories' => 0,
            'tags' => 0,
        ];

        // 2. Process each blog
        foreach ($blogUrls as $url) {
            $this->info("Processing: {$url}");
            
            try {
                // Check if we already have this blog (Idempotent)
                $existingBlog = Blog::where('original_url', $url)->first();
                if ($existingBlog) {
                    $this->line(" - Blog already exists (ID: {$existingBlog->id}), skipping to avoid overwriting admin changes.");
                    $stats['skipped']++;
                    continue;
                }

                $response = Http::get($url);
                if ($response->failed()) {
                    $this->error(" - Failed to fetch blog: " . $response->status());
                    $stats['errors']++;
                    continue;
                }

                $html = $response->body();
                $crawler = new Crawler($html, $url);

                // Title: use og:title or title tag
                $title = null;
                if ($crawler->filter('meta[property="og:title"]')->count() > 0) {
                    $title = $crawler->filter('meta[property="og:title"]')->attr('content');
                } else if ($crawler->filter('title')->count() > 0) {
                    $title = str_replace(' - CA Jitesh Telisara', '', $crawler->filter('title')->first()->text());
                } else if ($crawler->filter('h1')->count() > 0) {
                    $title = trim($crawler->filter('h1')->first()->text());
                }
                
                if (!$title || $title === 'Archives' || $title === 'Blogs' || $title === 'Home') {
                    $this->error(" - Invalid title '{$title}', skipping.");
                    $stats['errors']++;
                    continue;
                }

                // Excerpt: Try to get meta description
                $excerpt = null;
                if ($crawler->filter('meta[name="description"]')->count() > 0) {
                    $excerpt = $crawler->filter('meta[name="description"]')->attr('content');
                } else if ($crawler->filter('meta[property="og:description"]')->count() > 0) {
                    $excerpt = $crawler->filter('meta[property="og:description"]')->attr('content');
                }

                // Content: Grab the actual post content, avoiding sidebar
                $contentHtml = '';
                if ($crawler->filter('.elementor-widget-theme-post-content')->count() > 0) {
                    $contentHtml = $crawler->filter('.elementor-widget-theme-post-content')->html();
                } else if ($crawler->filter('.entry-content')->count() > 0) {
                    $contentHtml = $crawler->filter('.entry-content')->html();
                } else if ($crawler->filter('article')->count() > 0) {
                    $contentHtml = $crawler->filter('article')->html();
                } else {
                    $contentHtml = "<p>Content could not be automatically parsed.</p>"; // Fallback
                }

                // Image
                $imageUrl = null;
                if ($crawler->filter('meta[property="og:image"]')->count() > 0) {
                    $imageUrl = $crawler->filter('meta[property="og:image"]')->attr('content');
                } else if ($crawler->filter('article img')->count() > 0) {
                    $imageUrl = $crawler->filter('article img')->first()->attr('src');
                }

                $localImagePath = null;
                if ($imageUrl) {
                    // Fix relative URLs
                    if (!preg_match('~^(?:f|ht)tps?://~i', $imageUrl)) {
                        $imageUrl = rtrim($this->baseUrl, '/') . '/' . ltrim($imageUrl, '/');
                    }

                    try {
                        $imageContents = file_get_contents($imageUrl);
                        if ($imageContents) {
                            $filename = 'imported_' . Str::random(10) . '_' . basename(parse_url($imageUrl, PHP_URL_PATH));
                            $path = 'blogs/' . $filename;
                            Storage::disk('public')->put($path, $imageContents);
                            $localImagePath = $path;
                        }
                    } catch (Exception $e) {
                        $this->warn(" - Failed to download image: " . $imageUrl);
                    }
                }

                // Category
                $categoryName = 'Uncategorized';
                $catLinks = $crawler->filter('a[rel="category tag"]');
                if ($catLinks->count() > 0) {
                    $categoryName = trim($catLinks->first()->text());
                }

                $category = BlogCategory::firstOrCreate(
                    ['slug' => Str::slug($categoryName)],
                    [
                        'name' => $categoryName,
                        'is_active' => true,
                    ]
                );
                if ($category->wasRecentlyCreated) $stats['categories']++;

                // Create the blog
                $slug = Str::slug($title);
                // Ensure unique slug
                $originalSlug = $slug;
                $counter = 1;
                while (Blog::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }

                $blog = Blog::create([
                    'title' => $title,
                    'slug' => $slug,
                    'original_url' => $url,
                    'excerpt' => $excerpt,
                    'content' => $contentHtml,
                    'image' => $localImagePath,
                    'blog_category_id' => $category->id,
                    'author' => 'Admin', // Default
                    'is_published' => true,
                    'published_date' => Carbon::now(), // Fallback if no date found
                    'meta_title' => $title,
                    'meta_description' => $excerpt,
                ]);

                // Tags: Use meta keywords to avoid scraping the entire sidebar tag cloud
                $tagIds = [];
                if ($crawler->filter('meta[name="keywords"]')->count() > 0) {
                    $keywords = $crawler->filter('meta[name="keywords"]')->attr('content');
                    if ($keywords) {
                        $tagNames = array_map('trim', explode(',', $keywords));
                        foreach ($tagNames as $tagName) {
                            if (!empty($tagName)) {
                                $tag = BlogTag::firstOrCreate(
                                    ['slug' => Str::slug($tagName)],
                                    [
                                        'name' => $tagName,
                                        'is_active' => true,
                                    ]
                                );
                                if ($tag->wasRecentlyCreated) $stats['tags']++;
                                $tagIds[] = $tag->id;
                            }
                        }
                    }
                }
                
                if (count($tagIds) > 0) {
                    $blog->tags()->sync($tagIds);
                }

                $this->info(" - Successfully imported: {$title}");
                $stats['imported']++;

            } catch (Exception $e) {
                $this->error(" - Error processing {$url}: " . $e->getMessage());
                $stats['errors']++;
            }
        }

        // Summary
        $this->info("==========================================");
        $this->info("IMPORT SUMMARY:");
        $this->info("Blogs discovered: " . $stats['discovered']);
        $this->info("New blogs imported: " . $stats['imported']);
        $this->info("Existing blogs updated: " . $stats['updated']);
        $this->info("Skipped: " . $stats['skipped']);
        $this->info("Categories imported: " . $stats['categories']);
        $this->info("Tags imported: " . $stats['tags']);
        $this->info("Errors: " . $stats['errors']);
        $this->info("==========================================");

        return 0;
    }
}
