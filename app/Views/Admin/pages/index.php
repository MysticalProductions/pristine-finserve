<div class="page-header">
  <h1>Pages</h1>
  <a href="/admin/pages/create" class="btn btn-gold btn-sm"><i class="fas fa-plus"></i> Create Page</a>
</div>

<div class="card">
  <div class="card-body" style="padding:0;">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Status</th>
            <th>Last Updated</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($pages) && is_array($pages)): ?>
            <?php foreach ($pages as $page): ?>
              <tr>
                <td>
                  <a href="/admin/pages/edit/<?= (int)($page['id'] ?? 0) ?>" style="color:#1B5AAE;font-weight:500;">
                    <?= htmlspecialchars($page['title'] ?? '') ?>
                  </a>
                </td>
                <td style="color:var(--text-muted);font-size:0.8rem;">/<?= htmlspecialchars($page['slug'] ?? '') ?></td>
                <td>
                  <?php if (($page['status'] ?? '') === 'published'): ?>
                    <span class="badge badge-success">Published</span>
                  <?php else: ?>
                    <span class="badge badge-warning">Draft</span>
                  <?php endif; ?>
                </td>
                <td style="color:var(--text-muted);font-size:0.8rem;"><?= htmlspecialchars($page['updated_at'] ?? $page['created_at'] ?? '') ?></td>
                <td style="text-align:right;">
                  <div class="btn-group">
                    <a href="/<?= htmlspecialchars($page['slug'] ?? '') ?>" class="btn btn-outline btn-sm" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                    <a href="/admin/pages/edit/<?= (int)($page['id'] ?? 0) ?>" class="btn btn-navy btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5">
                <div class="empty-state">
                  <i class="fas fa-file"></i>
                  <p>No pages found.</p>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
