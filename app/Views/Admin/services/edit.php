<div class="page-header">
  <h1>Edit Service</h1>
  <a href="/admin/services" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back to Services</a>
</div>

<div class="card">
  <div class="card-body">
    <form method="POST" action="/admin/services/update/<?= (int)($service['id'] ?? 0) ?>" enctype="multipart/form-data">
      <?= csrfField() ?>
      <div class="form-row">
        <div class="form-group">
          <label for="title">Title <span class="required">*</span></label>
          <input type="text" class="form-control" id="title" name="title" data-slug-source="true" data-slug-target="#slug" required value="<?= htmlspecialchars($service['title'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="slug">Slug <span class="required">*</span></label>
          <input type="text" class="form-control" id="slug" name="slug" required value="<?= htmlspecialchars($service['slug'] ?? '') ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="icon">Icon (Font Awesome class)</label>
          <input type="text" class="form-control" id="icon" name="icon" placeholder="fas fa-concierge-biscuit" value="<?= htmlspecialchars($service['icon'] ?? '') ?>">
          <div class="form-hint">e.g. <code>fas fa-concierge-biscuit</code></div>
        </div>
        <div class="form-row" style="gap:16px;">
          <div class="form-group" style="flex:1;">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
              <option value="published" <?= (($service['status'] ?? '') === 'published') ? 'selected' : '' ?>>Published</option>
              <option value="draft" <?= (($service['status'] ?? '') === 'draft') ? 'selected' : '' ?>>Draft</option>
            </select>
          </div>
          <div class="form-group" style="flex:1;">
            <label for="order">Order</label>
            <input type="number" class="form-control" id="order" name="order" value="<?= (int)($service['order'] ?? 0) ?>" min="0">
          </div>
        </div>
      </div>

      <div class="form-group">
          <label for="short_desc">Short Description</label>
          <textarea class="form-control" id="short_desc" name="short_desc" rows="3"><?= htmlspecialchars($service['short_desc'] ?? '') ?></textarea>
      </div>

      <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" rows="10"><?= htmlspecialchars($service['content'] ?? '') ?></textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="features">Features</label>
          <textarea class="form-control" id="features" name="features" rows="5"><?= htmlspecialchars($service['features'] ?? '') ?></textarea>
          <div class="form-hint">One feature per line</div>
        </div>
        <div class="form-group">
          <label for="benefits">Benefits</label>
          <textarea class="form-control" id="benefits" name="benefits" rows="5"><?= htmlspecialchars($service['benefits'] ?? '') ?></textarea>
          <div class="form-hint">One benefit per line</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="process">Process Steps</label>
          <textarea class="form-control" id="process" name="process" rows="5"><?= htmlspecialchars($service['process'] ?? '') ?></textarea>
          <div class="form-hint">One step per line. Use <code>Title|Description</code> format for detailed steps.</div>
        </div>
        <div class="form-group">
          <label for="faq">FAQ</label>
          <textarea class="form-control" id="faq" name="faq" rows="5"><?= htmlspecialchars($service['faq'] ?? '') ?></textarea>
          <div class="form-hint">One per line: <code>Question|Answer</code></div>
        </div>
      </div>

      <?php if (!empty($service['featured_image'])): ?>
        <div style="margin-bottom:18px;">
          <label style="display:block;font-size:0.8rem;font-weight:600;margin-bottom:6px;">Current Featured Image</label>
          <img src="<?= uploadUrl(htmlspecialchars($service['featured_image'])) ?>" alt="" style="max-width:200px;border-radius:6px;border:1px solid var(--border);">
        </div>
      <?php endif; ?>

      <div class="form-group">
        <label for="featured_image">
          <?= !empty($service['featured_image']) ? 'Change Featured Image' : 'Featured Image' ?>
        </label>
        <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*" style="padding:8px 14px;">
      </div>

      <div style="display:flex;gap:10px;margin-top:24px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Service</button>
        <a href="/admin/services" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
