<div class="page-header">
  <h1><i class="fas fa-chart-bar"></i> Home Page Statistics</h1>
  <a href="<?= adminRoute('statistics/create') ?>" class="btn btn-gold"><i class="fas fa-plus"></i> Add Statistic</a>
</div>

<div class="card">
  <div class="table-wrapper">
    <table class="table">
      <thead>
        <tr>
          <th>Icon</th>
          <th>Label</th>
          <th>Value</th>
          <th>Suffix</th>
          <th>Order</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($statistics)): ?>
          <tr><td colspan="7" class="empty-state">No statistics found.</td></tr>
        <?php else: ?>
          <?php foreach ($statistics as $s): ?>
            <tr>
              <td style="font-size:1.5rem;"><?= htmlspecialchars($s->icon ?? '📊') ?></td>
              <td><strong><?= htmlspecialchars($s->label ?? '') ?></strong></td>
              <td><?= htmlspecialchars($s->value ?? '') ?></td>
              <td><?= htmlspecialchars($s->suffix ?? '+') ?></td>
              <td><?= (int)($s->order ?? 0) ?></td>
              <td>
                <?php if (($s->status ?? '') === 'active'): ?>
                  <span class="badge badge-success">Active</span>
                <?php else: ?>
                  <span class="badge badge-warning">Inactive</span>
                <?php endif; ?>
              </td>
              <td>
                <div class="btn-group">
                  <a href="<?= adminRoute('statistics/edit/' . $s->id) ?>" class="btn btn-navy btn-sm"><i class="fas fa-edit"></i></a>
                  <a href="<?= adminRoute('statistics/delete/' . $s->id) ?>" class="btn btn-sm btn-outline" style="color:var(--error);border-color:var(--error);" onclick="return confirm('Delete this statistic?')"><i class="fas fa-trash"></i></a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
