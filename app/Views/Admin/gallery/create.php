<div class="page-header">
  <h1>Create Gallery Item</h1>
  <a href="/admin/gallery" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back to Gallery</a>
</div>

<div class="card">
  <div class="card-body">
    <form method="POST" action="/admin/gallery/store" enctype="multipart/form-data">
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

      <div class="form-row">
        <div class="form-group">
          <label for="image">Image File</label>
          <input type="file" class="form-control" id="image" name="image" accept="image/*" style="padding:8px 14px;">
        </div>
        <div class="form-group">
          <label for="video_url">Video URL</label>
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
            <option value="active" <?= (($item['status'] ?? 'active') === 'active') ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= (($item['status'] ?? 'active') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
          </select>
        </div>
        <div class="form-group" style="flex:1;">
          <label for="order">Order</label>
          <input type="number" class="form-control" id="order" name="order" value="<?= (int)($item['order'] ?? 0) ?>" min="0">
        </div>
      </div>

      <div style="display:flex;gap:10px;margin-top:24px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Create Item</button>
        <a href="/admin/gallery" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
