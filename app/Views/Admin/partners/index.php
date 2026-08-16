<div class="page-header">
  <h1>Partners</h1>
  <a href="/admin/partners/create" class="btn btn-gold btn-sm"><i class="fas fa-plus"></i> Add New Partner</a>
</div>

<div class="card">
  <div class="card-body" style="padding:0;">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>Logo</th>
            <th>Name</th>
            <th>Type</th>
            <th>Website</th>
            <th>Status</th>
            <th>Order</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($partners) && is_array($partners)): ?>
            <?php foreach ($partners as $p): ?>
              <tr>
                <td>
                  <?php if (!empty($p['logo'])): ?>
                    <img src="<?= uploadUrl(htmlspecialchars($p['logo'])) ?>" alt="<?= htmlspecialchars($p['name'] ?? '') ?>" style="width:40px;height:40px;object-fit:contain;border-radius:4px;border:1px solid var(--border);">
                  <?php else: ?>
                    <span style="color:var(--text-muted);font-size:0.75rem;">—</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="/admin/partners/edit/<?= (int)($p['id'] ?? 0) ?>" style="color:#1B5AAE;font-weight:500;">
                    <?= htmlspecialchars($p['name'] ?? '') ?>
                  </a>
                </td>
                <td>
                  <span class="badge badge-gold"><?= htmlspecialchars(ucfirst($p['type'] ?? 'other')) ?></span>
                </td>
                <td>
                  <?php if (!empty($p['website'])): ?>
                    <a href="<?= htmlspecialchars($p['website']) ?>" target="_blank" style="color:#1B5AAE;font-size:0.8rem;">
                      <i class="fas fa-external-link-alt"></i> Visit
                    </a>
                  <?php else: ?>
                    <span style="color:var(--text-muted);">—</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if (($p['status'] ?? '') === 'active'): ?>
                    <span class="badge badge-success">Active</span>
                  <?php else: ?>
                    <span class="badge badge-warning">Inactive</span>
                  <?php endif; ?>
                </td>
                <td><?= (int)($p['order'] ?? 0) ?></td>
                <td style="text-align:right;">
                  <div class="btn-group">
                    <a href="/admin/partners/edit/<?= (int)($p['id'] ?? 0) ?>" class="btn btn-navy btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                    <a href="/admin/partners/delete/<?= (int)($p['id'] ?? 0) ?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this partner?')"><i class="fas fa-trash"></i></a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7">
                <div class="empty-state">
                  <i class="fas fa-handshake"></i>
                  <p>No partners found. Add your first partner!</p>
                  <a href="/admin/partners/create" class="btn btn-gold btn-sm" style="margin-top:12px;"><i class="fas fa-plus"></i> Add New Partner</a>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php if (($pagination->lastPage ?? 1) > 1): ?>
    <div class="card-body" style="border-top:1px solid var(--border);">
      <?= paginateLinks($pagination, adminRoute('partners')) ?>
    </div>
  <?php endif; ?>
</div>
