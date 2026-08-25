<div class="page-header">
  <h1>Edit Page</h1>
  <a href="/admin/pages" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back to Pages</a>
</div>

<div class="card">
  <div class="card-body">
    <form method="POST" action="/admin/pages/update/<?= (int)($page['id'] ?? 0) ?>" enctype="multipart/form-data">
      <?= csrfField() ?>
      <div class="form-group">
        <label for="title">Title <span class="required">*</span></label>
        <input type="text" class="form-control" id="title" name="title" data-slug-source="true" data-slug-target="#slug" required value="<?= htmlspecialchars($page['title'] ?? '') ?>">
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="slug">Slug <span class="required">*</span></label>
          <input type="text" class="form-control" id="slug" name="slug" required value="<?= htmlspecialchars($page['slug'] ?? '') ?>">
          <div class="form-hint">Auto-generated from title. Can be edited manually.</div>
        </div>
        <div class="form-group">
          <label for="status">Status <span class="required">*</span></label>
          <select class="form-control" id="status" name="status" required>
            <option value="draft" <?= (($page['status'] ?? '') === 'draft') ? 'selected' : '' ?>>Draft</option>
            <option value="published" <?= (($page['status'] ?? '') === 'published') ? 'selected' : '' ?>>Published</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" rows="16"><?= htmlspecialchars($page['content'] ?? '') ?></textarea>
      </div>

      <div class="card" style="margin-bottom:18px;">
        <div class="card-header">SEO Settings</div>
        <div class="card-body">
          <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= htmlspecialchars($page['meta_title'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea class="form-control" id="meta_description" name="meta_description" rows="3"><?= htmlspecialchars($page['meta_description'] ?? '') ?></textarea>
          </div>
          <div class="form-group">
            <label for="meta_keywords">Meta Keywords</label>
            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="keyword1, keyword2, keyword3" value="<?= htmlspecialchars($page['meta_keywords'] ?? '') ?>">
            <div class="form-hint">Comma-separated keywords</div>
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <div class="form-check">
            <input type="checkbox" id="show_in_menu" name="show_in_menu" value="1" <?= !empty($page['show_in_menu']) ? 'checked' : '' ?>>
            <label for="show_in_menu">Show in Menu</label>
          </div>
        </div>
        <div class="form-group">
          <label for="menu_order">Menu Order</label>
          <input type="number" class="form-control" id="menu_order" name="menu_order" value="<?= (int)($page['menu_order'] ?? 0) ?>" min="0">
        </div>
      </div>

      <?php if (!empty($page['featured_image'])): ?>
        <div style="margin-bottom:18px;">
          <label style="display:block;font-size:0.8rem;font-weight:600;margin-bottom:6px;">Current Featured Image</label>
          <img src="<?= uploadUrl(htmlspecialchars($page['featured_image'])) ?>" alt="" style="max-width:200px;border-radius:6px;border:1px solid var(--border);">
        </div>
      <?php endif; ?>

      <div class="form-group">
        <label for="featured_image">
          <?= !empty($page['featured_image']) ? 'Change Featured Image' : 'Featured Image' ?>
        </label>
        <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*" style="padding:8px 14px;">
      </div>

      <div style="display:flex;gap:10px;margin-top:24px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Page</button>
        <a href="/admin/pages" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
