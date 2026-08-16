<div class="page-header">
  <h1>Gallery</h1>
  <a href="/admin/gallery/create" class="btn btn-gold btn-sm"><i class="fas fa-plus"></i> Add New Item</a>
</div>

<div class="card">
  <div class="card-body" style="padding:0;">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>Image / Video</th>
            <th>Title</th>
            <th>Type</th>
            <th>Category</th>
            <th>Status</th>
            <th>Featured</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($gallery) && is_array($gallery)): ?>
            <?php foreach ($gallery as $g): ?>
              <tr>
                <td>
                  <?php if (($g['type'] ?? '') === 'video' && !empty($g['video_url'])): ?>
                    <a href="<?= htmlspecialchars($g['video_url']) ?>" target="_blank" style="display:inline-flex;align-items:center;gap:4px;color:#1B5AAE;font-size:0.8rem;">
                      <i class="fas fa-play-circle" style="font-size:1.2rem;"></i> Play
                    </a>
                  <?php elseif (!empty($g['image'])): ?>
                    <img src="<?= uploadUrl(htmlspecialchars($g['image'])) ?>" alt="<?= htmlspecialchars($g['title'] ?? '') ?>" style="width:60px;height:45px;object-fit:cover;border-radius:4px;border:1px solid var(--border);">
                  <?php else: ?>
                    <span style="color:var(--text-muted);font-size:0.75rem;">—</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="/admin/gallery/edit/<?= (int)($g['id'] ?? 0) ?>" style="color:#1B5AAE;font-weight:500;">
                    <?= htmlspecialchars($g['title'] ?? '') ?>
                  </a>
                </td>
                <td>
                  <?php $type = $g['type'] ?? 'photo'; ?>
                  <?php if ($type === 'photo'): ?>
                    <span class="badge badge-info">Photo</span>
                  <?php elseif ($type === 'video'): ?>
                    <span class="badge badge-gold">Video</span>
                  <?php else: ?>
                    <span class="badge badge-secondary">Event</span>
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($g['category'] ?? '') ?></td>
                <td>
                  <?php if (($g['status'] ?? '') === 'active'): ?>
                    <span class="badge badge-success">Active</span>
                  <?php else: ?>
                    <span class="badge badge-warning">Inactive</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if (!empty($g['is_featured'])): ?>
                    <span class="badge badge-success">Yes</span>
                  <?php else: ?>
                    <span class="badge badge-secondary">No</span>
                  <?php endif; ?>
                </td>
                <td style="text-align:right;">
                  <div class="btn-group">
                    <a href="/admin/gallery/edit/<?= (int)($g['id'] ?? 0) ?>" class="btn btn-navy btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                    <a href="/admin/gallery/delete/<?= (int)($g['id'] ?? 0) ?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this gallery item?')"><i class="fas fa-trash"></i></a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7">
                <div class="empty-state">
                  <i class="fas fa-images"></i>
                  <p>No gallery items found. Add your first item!</p>
                  <a href="/admin/gallery/create" class="btn btn-gold btn-sm" style="margin-top:12px;"><i class="fas fa-plus"></i> Add New Item</a>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
