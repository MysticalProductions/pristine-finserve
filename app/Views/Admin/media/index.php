<div class="page-header">
  <h1><i class="fas fa-photo-video"></i> Media Library</h1>
  <button class="btn btn-gold" id="uploadBtn"><i class="fas fa-upload"></i> Upload</button>
</div>

<form method="POST" action="<?= adminRoute('media/upload') ?>" enctype="multipart/form-data" id="uploadForm" style="display:none;">
  <?= csrfField() ?>
  <div class="card" style="margin-bottom:20px;">
    <div class="card-body">
      <div class="form-group">
        <label for="file">Choose File</label>
        <input type="file" name="file" id="file" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-gold"><i class="fas fa-upload"></i> Upload</button>
    </div>
  </div>
</form>

<div class="card">
  <div class="card-body">
    <?php if (empty($pagination->items)): ?>
      <div class="empty-state">
        <i class="fas fa-images"></i>
        <p>No media found. Click "Upload" to add files.</p>
      </div>
    <?php else: ?>
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;">
        <?php foreach ($pagination->items as $item): ?>
          <div style="background:var(--white);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;">
            <div style="height:140px;display:flex;align-items:center;justify-content:center;background:var(--light-gray);overflow:hidden;">
              <?php if (str_starts_with($item->mime_type ?? '', 'image/')): ?>
                <img src="/<?= htmlspecialchars($item->path ?? '') ?>" alt="<?= htmlspecialchars($item->original_name ?? '') ?>" style="width:100%;height:100%;object-fit:cover;">
              <?php else: ?>
                <i class="fas fa-file" style="font-size:2.5rem;color:var(--text-muted);"></i>
              <?php endif; ?>
            </div>
            <div style="padding:10px;">
              <p style="font-size:0.8rem;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?= htmlspecialchars($item->original_name ?? '') ?>"><?= htmlspecialchars($item->original_name ?? '') ?></p>
              <p style="font-size:0.7rem;color:var(--text-muted);">
                <?= htmlspecialchars($item->extension ?? '') ?>
                &middot; <?= !empty($item->size) ? number_format($item->size / 1024, 1) . ' KB' : '' ?>
              </p>
              <p style="font-size:0.7rem;color:var(--text-muted);"><?= !empty($item->created_at) ? formatDate($item->created_at) : '' ?></p>
              <div style="margin-top:8px;display:flex;gap:4px;">
                <a href="/<?= htmlspecialchars($item->path ?? '') ?>" target="_blank" class="btn btn-sm btn-outline" style="flex:1;"><i class="fas fa-external-link-alt"></i></a>
                <a href="<?= adminRoute('media/delete/' . $item->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this file?')"><i class="fas fa-trash"></i></a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
  <?php if (($pagination->lastPage ?? 1) > 1): ?>
    <div class="card-body" style="border-top:1px solid var(--border);">
      <?= paginateLinks($pagination, adminRoute('media')) ?>
    </div>
  <?php endif; ?>
</div>

<script>
document.getElementById('uploadBtn')?.addEventListener('click', function() {
  const form = document.getElementById('uploadForm');
  form.style.display = form.style.display === 'none' ? 'block' : 'none';
});
</script>
