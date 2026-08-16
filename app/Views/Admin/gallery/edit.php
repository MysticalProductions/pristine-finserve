<div class="page-header">
  <h1>Edit Gallery Item</h1>
  <a href="/admin/gallery" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back to Gallery</a>
</div>

<div class="card">
  <div class="card-body">
    <form method="POST" action="/admin/gallery/update/<?= (int)($item['id'] ?? 0) ?>" enctype="multipart/form-data">
      <?= csrfField() ?>
      <div class="form-row">
        <div class="form-group">
          <label for="title">Title <span class="required">*</span></label>
          <input type="text" class="form-control" id="title" name="title" required value="<?= htmlspecialchars($item['title'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="type">Type <span class="required">*</span></label>
          <select class="form-control" id="type" name="type" required>
            <option value="photo" <?= (($item['type'] ?? '') === 'photo') ? 'selected' : '' ?>>Photo</option>
            <option value="video" <?= (($item['type'] ?? '') === 'video') ? 'selected' : '' ?>>Video</option>
            <option value="event" <?= (($item['type'] ?? '') === 'event') ? 'selected' : '' ?>>Event</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
      </div>

      <?php if (!empty($item['image'])): ?>
        <div style="margin-bottom:18px;">
          <label style="display:block;font-size:0.8rem;font-weight:600;margin-bottom:6px;">Current Image</label>
          <img src="<?= uploadUrl(htmlspecialchars($item['image'])) ?>" alt="" style="max-width:200px;border-radius:6px;border:1px solid var(--border);">
        </div>
      <?php endif; ?>

      <?php if (!empty($item['video_url'])): ?>
        <div style="margin-bottom:18px;">
          <label style="display:block;font-size:0.8rem;font-weight:600;margin-bottom:6px;">Current Video URL</label>
          <a href="<?= htmlspecialchars($item['video_url']) ?>" target="_blank" style="color:#1B5AAE;"><?= htmlspecialchars($item['video_url']) ?></a>
        </div>
      <?php endif; ?>

      <div class="form-row">
        <div class="form-group">
          <label for="image"><?= !empty($item['image']) ? 'Change Image File' : 'Image File' ?></label>
          <input type="file" class="form-control" id="image" name="image" accept="image/*" style="padding:8px 14px;">
        </div>
        <div class="form-group">
          <label for="video_url"><?= !empty($item['video_url']) ? 'Change Video URL' : 'Video URL' ?></label>
          <input type="url" class="form-control" id="video_url" name="video_url" placeholder="https://youtube.com/watch?v=..." value="<?= htmlspecialchars($item['video_url'] ?? '') ?>">
          <div class="form-hint">Required if type is Video</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="category">Category</label>
          <input type="text" class="form-control" id="category" name="category" placeholder="Events, Branding, Team, etc." value="<?= htmlspecialchars($item['category'] ?? '') ?>">
        </div>
        <div class="form-group">
          <div class="form-check">
            <input type="checkbox" id="is_featured" name="is_featured" value="1" <?= !empty($item['is_featured']) ? 'checked' : '' ?>>
            <label for="is_featured">Is Featured</label>
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group" style="flex:1;">
          <label for="status">Status</label>
          <select class="form-control" id="status" name="status">
            <option value="active" <?= (($item['status'] ?? '') === 'active') ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= (($item['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
          </select>
        </div>
        <div class="form-group" style="flex:1;">
          <label for="order">Order</label>
          <input type="number" class="form-control" id="order" name="order" value="<?= (int)($item['order'] ?? 0) ?>" min="0">
        </div>
      </div>

      <div style="display:flex;gap:10px;margin-top:24px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Item</button>
        <a href="/admin/gallery" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
