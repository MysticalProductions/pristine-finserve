<div class="page-header">
  <h1>Edit Partner</h1>
  <a href="/admin/partners" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back to Partners</a>
</div>

<div class="card">
  <div class="card-body">
    <form method="POST" action="/admin/partners/update/<?= (int)($partner['id'] ?? 0) ?>" enctype="multipart/form-data">
      <?= csrfField() ?>
      <div class="form-row">
        <div class="form-group">
          <label for="name">Name <span class="required">*</span></label>
          <input type="text" class="form-control" id="name" name="name" data-slug-source="true" data-slug-target="#slug" required value="<?= htmlspecialchars($partner['name'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="slug">Slug <span class="required">*</span></label>
          <input type="text" class="form-control" id="slug" name="slug" required value="<?= htmlspecialchars($partner['slug'] ?? '') ?>">
          <div class="form-hint">Auto-generated from name. Can be edited manually.</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="type">Type <span class="required">*</span></label>
          <select class="form-control" id="type" name="type" required>
            <option value="bank" <?= (($partner['type'] ?? '') === 'bank') ? 'selected' : '' ?>>Bank</option>
            <option value="nbfc" <?= (($partner['type'] ?? '') === 'nbfc') ? 'selected' : '' ?>>NBFC</option>
            <option value="insurance" <?= (($partner['type'] ?? '') === 'insurance') ? 'selected' : '' ?>>Insurance</option>
            <option value="other" <?= (($partner['type'] ?? '') === 'other') ? 'selected' : '' ?>>Other</option>
          </select>
        </div>
        <div class="form-group">
          <label for="website">Website URL</label>
          <input type="url" class="form-control" id="website" name="website" placeholder="https://example.com" value="<?= htmlspecialchars($partner['website'] ?? '') ?>">
        </div>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($partner['description'] ?? '') ?></textarea>
      </div>

      <?php if (!empty($partner['logo'])): ?>
        <div style="margin-bottom:18px;">
          <label style="display:block;font-size:0.8rem;font-weight:600;margin-bottom:6px;">Current Logo</label>
          <img src="<?= uploadUrl(htmlspecialchars($partner['logo'])) ?>" alt="" style="max-width:120px;max-height:60px;border-radius:4px;border:1px solid var(--border);">
        </div>
      <?php endif; ?>

      <div class="form-row">
        <div class="form-group">
          <label for="logo"><?= !empty($partner['logo']) ? 'Change Logo' : 'Logo' ?></label>
          <input type="file" class="form-control" id="logo" name="logo" accept="image/*" style="padding:8px 14px;">
        </div>
        <div class="form-row" style="gap:16px;">
          <div class="form-group" style="flex:1;">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
              <option value="active" <?= (($partner['status'] ?? '') === 'active') ? 'selected' : '' ?>>Active</option>
              <option value="inactive" <?= (($partner['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
            </select>
          </div>
          <div class="form-group" style="flex:1;">
            <label for="order">Order</label>
            <input type="number" class="form-control" id="order" name="order" value="<?= (int)($partner['order'] ?? 0) ?>" min="0">
          </div>
        </div>
      </div>

      <div style="display:flex;gap:10px;margin-top:24px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Partner</button>
        <a href="/admin/partners" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
