<div class="page-header">
  <h1>Calculators</h1>
  <a href="/admin/calculators" class="btn btn-outline btn-sm"><i class="fas fa-sync-alt"></i> Refresh</a>
</div>

<div class="card">
  <div class="card-body" style="padding:0;">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Default Rate</th>
            <th>Default Tenure</th>
            <th>Status</th>
            <th>Order</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($calculators) && is_array($calculators)): ?>
            <?php foreach ($calculators as $c): ?>
              <tr>
                <td>
                  <a href="/admin/calculators/edit/<?= (int)($c['id'] ?? 0) ?>" style="color:#1B5AAE;font-weight:500;">
                    <?= htmlspecialchars($c['title'] ?? '') ?>
                  </a>
                </td>
                <td>
                  <span class="badge badge-info"><?= htmlspecialchars(ucfirst($c['type'] ?? '')) ?></span>
                </td>
                <td><?= htmlspecialchars($c['default_rate'] ?? '') ?>%</td>
                <td><?= (int)($c['default_tenure'] ?? 0) ?> months</td>
                <td>
                  <?php if (($c['status'] ?? '') === 'active'): ?>
                    <span class="badge badge-success">Active</span>
                  <?php else: ?>
                    <span class="badge badge-warning">Inactive</span>
                  <?php endif; ?>
                </td>
                <td><?= (int)($c['order'] ?? 0) ?></td>
                <td style="text-align:right;">
                  <div class="btn-group">
                    <a href="/admin/calculators/edit/<?= (int)($c['id'] ?? 0) ?>" class="btn btn-navy btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7">
                <div class="empty-state">
                  <i class="fas fa-calculator"></i>
                  <p>No calculators found.</p>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
