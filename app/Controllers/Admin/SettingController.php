<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class SettingController extends BaseController
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
        $allSettings = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}settings ORDER BY `group` ASC"
        );

        $settings = [];
        foreach ($allSettings as $setting) {
            $group = $setting->group ?? 'general';
            if (!isset($settings[$group])) {
                $settings[$group] = [];
            }
            $settings[$group][] = $setting;
        }

        $this->render('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): void
    {
        $inputs = $request->all();

        unset($inputs['_token']);

        foreach ($inputs as $key => $value) {
            if (str_starts_with($key, '_')) continue;

            $existing = $this->db->fetch(
                "SELECT id FROM {$this->prefix}settings WHERE `key` = :key LIMIT 1",
                ['key' => $key]
            );

            if ($existing) {
                $this->db->update('settings', ['value' => $value, 'updated_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $existing->id]);
            } else {
                $this->db->insert('settings', [
                    'key' => $key,
                    'value' => $value,
                    'group' => 'general',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        $this->session->flash('success', 'Settings updated successfully.');
        $this->back();
    }
}
