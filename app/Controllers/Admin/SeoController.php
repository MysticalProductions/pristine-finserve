<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class SeoController extends BaseController
{
    private Database $db;
    private string $prefix;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::instance();
        $this->prefix = $this->db->getPrefix();
    }

    public function index(Request $request): void
    {
        $seoMeta = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}seo_meta ORDER BY page_url ASC"
        );

        $this->render('admin.seo.index', compact('seoMeta'));
    }

    public function create(Request $request): void
    {
        $this->render('admin.seo.edit', ['seo' => null]);
    }

    public function store(Request $request): void
    {
        $errors = $this->validate([
            'page_url' => 'required|min:1|max:200',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = [
            'page_url' => $request->input('page_url'),
            'title' => $request->input('meta_title'),
            'description' => $request->input('meta_description'),
            'keywords' => $request->input('meta_keywords'),
            'og_title' => $request->input('og_title'),
            'og_description' => $request->input('og_description'),
            'og_image' => $request->input('og_image'),
            'schema_markup' => $request->input('schema_markup'),
        ];

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!empty($data['schema_markup']) && is_string($data['schema_markup'])) {
            $decoded = json_decode($data['schema_markup'], true);
            $data['schema_markup'] = $decoded ? json_encode($decoded) : null;
        }

        $this->db->insert('seo_meta', $data);

        $this->session->flash('success', 'SEO entry created successfully.');
        $this->redirect(adminRoute('seo'));
    }

    public function edit(Request $request, int $id): void
    {
        $seo = $this->db->fetch(
            "SELECT * FROM {$this->prefix}seo_meta WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$seo) {
            $this->session->flash('error', 'SEO entry not found.');
            $this->redirect(adminRoute('seo'));
            return;
        }

        $this->render('admin.seo.edit', compact('seo'));
    }

    public function updateEntry(Request $request, int $id): void
    {
        $errors = $this->validate([
            'page_url' => 'required|min:1|max:200',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = [
            'page_url' => $request->input('page_url'),
            'title' => $request->input('meta_title'),
            'description' => $request->input('meta_description'),
            'keywords' => $request->input('meta_keywords'),
            'og_title' => $request->input('og_title'),
            'og_description' => $request->input('og_description'),
            'og_image' => $request->input('og_image'),
            'schema_markup' => $request->input('schema_markup'),
        ];

        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!empty($data['schema_markup']) && is_string($data['schema_markup'])) {
            $decoded = json_decode($data['schema_markup'], true);
            $data['schema_markup'] = $decoded ? json_encode($decoded) : null;
        }

        $this->db->update('seo_meta', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'SEO entry updated successfully.');
        $this->redirect(adminRoute('seo'));
    }

    public function delete(Request $request, int $id): void
    {
        $this->db->delete('seo_meta', 'id = :id', ['id' => $id]);
        $this->session->flash('success', 'SEO entry deleted successfully.');
        $this->redirect(adminRoute('seo'));
    }

    public function updateBulk(Request $request): void
    {
        $inputs = $request->all();

        unset($inputs['_token']);

        foreach ($inputs as $key => $value) {
            if (!str_starts_with($key, 'seo_')) continue;

            // Extract page URL by replacing "seo_" with "" and splitting at first "/"
            $pageUrl = substr($key, 4);
            // Only replace first occurrence of _ to / to reconstruct the URL path
            $pageUrl = preg_replace('/_/', '/', $pageUrl, 1);

            $existing = $this->db->fetch(
                "SELECT id FROM {$this->prefix}seo_meta WHERE page_url = :page_url LIMIT 1",
                ['page_url' => $pageUrl]
            );

            $metaData = [
                'title' => $request->input("meta_title_{$pageUrl}", ''),
                'description' => $request->input("meta_description_{$pageUrl}", ''),
                'keywords' => $request->input("meta_keywords_{$pageUrl}", ''),
                'og_title' => $request->input("og_title_{$pageUrl}", ''),
                'og_description' => $request->input("og_description_{$pageUrl}", ''),
                'og_image' => $request->input("og_image_{$pageUrl}", ''),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($existing) {
                $this->db->update('seo_meta', $metaData, 'id = :id', ['id' => $existing->id]);
            } else {
                $metaData['page_url'] = $pageUrl;
                $metaData['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('seo_meta', $metaData);
            }
        }

        $this->session->flash('success', 'SEO settings updated successfully.');
        $this->back();
    }
}
