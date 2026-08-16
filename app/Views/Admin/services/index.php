<div class="page-header">
  <h1>Services</h1>
  <a href="/admin/services/create" class="btn btn-gold btn-sm"><i class="fas fa-plus"></i> Add New Service</a>
</div>

<div class="card">
  <div class="card-body" style="padding:0;">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Icon</th>
            <th>Status</th>
            <th>Order</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($services) && is_array($services)): ?>
            <?php foreach ($services as $service): ?>
              <tr>
                <td>
                  <a href="/admin/services/edit/<?= (int)($service['id'] ?? 0) ?>" style="color:#1B5AAE;font-weight:500;">
                    <?= htmlspecialchars($service['title'] ?? '') ?>
                  </a>
                </td>
                <td><i class="<?= htmlspecialchars($service['icon'] ?? 'fas fa-concierge-biscuit') ?>" style="color:var(--gold);"></i></td>
                <td>
                  <?php if (($service['status'] ?? '') === 'published'): ?>
                    <span class="badge badge-success">Published</span>
                  <?php else: ?>
                    <span class="badge badge-warning">Draft</span>
                  <?php endif; ?>
                </td>
                <td><?= (int)($service['order'] ?? 0) ?></td>
                <td style="text-align:right;">
                  <div class="btn-group">
                    <a href="/admin/services/edit/<?= (int)($service['id'] ?? 0) ?>" class="btn btn-navy btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                    <a href="/admin/services/delete/<?= (int)($service['id'] ?? 0) ?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this service?')"><i class="fas fa-trash"></i></a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5">
                <div class="empty-state">
                  <i class="fas fa-concierge-biscuit"></i>
                  <p>No services found. Create your first service!</p>
                  <a href="/admin/services/create" class="btn btn-gold btn-sm" style="margin-top:12px;"><i class="fas fa-plus"></i> Add New Service</a>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
