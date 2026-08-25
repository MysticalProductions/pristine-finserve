<?php

namespace App\Services;

use Core\Database;

class SeoService
{
    private Database $db;
    private string $table;

    public function __construct()
    {
        $this->db = Database::instance();
        $this->table = $this->db->getPrefix() . 'seo_meta';
    }

    public function getForPage(string $url): ?object
    {
        return $this->db->fetch(
            "SELECT * FROM {$this->table} WHERE page_url = :url LIMIT 1",
            ['url' => $url]
        );
    }

    public function updateOrCreate(string $pageUrl, array $data): bool
    {
        $existing = $this->getForPage($pageUrl);

        $data['page_url'] = $pageUrl;
        $data['updated_at'] = date('Y-m-d H:i:s');

        if ($existing) {
            return $this->db->update(
                'seo_meta',
                $data,
                'id = :id',
                ['id' => $existing->id]
            ) > 0;
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('seo_meta', $data) > 0;
    }

    public function renderMetaTags(string $pageUrl): string
    {
        $seo = $this->getForPage($pageUrl);

        if (!$seo) {
            return '';
        }

        $tags = '';

        if (!empty($seo->title)) {
            $tags .= '<title>' . htmlspecialchars($seo->title, ENT_QUOTES, 'UTF-8') . '</title>' . "\n";
            $tags .= '<meta property="og:title" content="' . htmlspecialchars($seo->title, ENT_QUOTES, 'UTF-8') . '">' . "\n";
        }

        if (!empty($seo->description)) {
            $tags .= '<meta name="description" content="' . htmlspecialchars($seo->description, ENT_QUOTES, 'UTF-8') . '">' . "\n";
            $tags .= '<meta property="og:description" content="' . htmlspecialchars($seo->description, ENT_QUOTES, 'UTF-8') . '">' . "\n";
        }

        if (!empty($seo->keywords)) {
            $tags .= '<meta name="keywords" content="' . htmlspecialchars($seo->keywords, ENT_QUOTES, 'UTF-8') . '">' . "\n";
        }

        if (!empty($seo->og_image)) {
            $tags .= '<meta property="og:image" content="' . htmlspecialchars($seo->og_image, ENT_QUOTES, 'UTF-8') . '">' . "\n";
        }

        if (!empty($seo->canonical_url)) {
            $tags .= '<link rel="canonical" href="' . htmlspecialchars($seo->canonical_url, ENT_QUOTES, 'UTF-8') . '">' . "\n";
        }

        if (!empty($seo->robots)) {
            $tags .= '<meta name="robots" content="' . htmlspecialchars($seo->robots, ENT_QUOTES, 'UTF-8') . '">' . "\n";
        }

        if (!empty($seo->og_type)) {
            $tags .= '<meta property="og:type" content="' . htmlspecialchars($seo->og_type, ENT_QUOTES, 'UTF-8') . '">' . "\n";
        }

        return $tags;
    }
}
