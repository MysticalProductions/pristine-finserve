<div class="page-header">
  <h1><i class="fas fa-search"></i> SEO Manager</h1>
  <a href="<?= adminRoute('seo/create') ?>" class="btn btn-gold"><i class="fas fa-plus"></i> Add New SEO Entry</a>
</div>

<div class="card">
  <div class="table-wrapper">
    <table class="table">
      <thead>
        <tr>
          <th>Page URL</th>
          <th>Meta Title</th>
          <th>Meta Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($seoMeta)): ?>
          <tr><td colspan="4" class="empty-state">No SEO entries found.</td></tr>
        <?php else: ?>
          <?php foreach ($seoMeta as $seo): ?>
            <tr>
              <td><code><?= htmlspecialchars($seo->page_url ?? '') ?></code></td>
              <td><?= htmlspecialchars($seo->title ?? '') ?></td>
              <td><?= htmlspecialchars(truncate($seo->description ?? '', 80)) ?></td>
              <td>
                <div class="btn-group">
                  <a href="<?= adminRoute('seo/edit/' . $seo->id) ?>" class="btn btn-sm btn-outline"><i class="fas fa-edit"></i> Edit</a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
