<div class="page-header">
  <h1><i class="fas fa-history"></i> Activity Logs</h1>
</div>

<div class="card">
  <div class="table-wrapper">
    <table class="table">
      <thead>
        <tr>
          <th>User</th>
          <th>Action</th>
          <th>Description</th>
          <th>Model</th>
          <th>IP Address</th>
          <th>Date/Time</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($pagination->items)): ?>
          <tr><td colspan="6" class="empty-state">No activity logs found.</td></tr>
        <?php else: ?>
          <?php foreach ($pagination->items as $log): ?>
            <tr>
              <td>
                <?php if (!empty($log->user_name)): ?>
                  <strong><?= htmlspecialchars($log->user_name) ?></strong>
                  <br><small style="color:var(--text-muted);font-size:0.75rem;"><?= htmlspecialchars($log->user_email ?? '') ?></small>
                <?php else: ?>
                  <span style="color:var(--text-muted);">System</span>
                <?php endif; ?>
              </td>
              <td>
                <span class="badge badge-info"><?= htmlspecialchars($log->action ?? '') ?></span>
              </td>
              <td><?= htmlspecialchars(truncate($log->description ?? '', 100)) ?></td>
              <td><code><?= htmlspecialchars($log->model ?? '') ?></code></td>
              <td><code><?= htmlspecialchars($log->ip_address ?? '') ?></code></td>
              <td><?= !empty($log->created_at) ? formatDate($log->created_at, 'M d, Y h:i A') : '-' ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if (($pagination->lastPage ?? 1) > 1): ?>
    <div class="card-body" style="border-top:1px solid var(--border);">
      <?= paginateLinks($pagination, adminRoute('activity-logs')) ?>
    </div>
  <?php endif; ?>
</div>
