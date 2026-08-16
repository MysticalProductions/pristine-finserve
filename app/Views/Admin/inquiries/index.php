<div class="page-header">
  <h1><i class="fas fa-envelope"></i> Contact Inquiries</h1>
</div>

<div class="card">
  <div class="table-wrapper">
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Subject</th>
          <th>Status</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($pagination->items)): ?>
          <tr><td colspan="7" class="empty-state">No inquiries found.</td></tr>
        <?php else: ?>
          <?php foreach ($pagination->items as $inquiry): ?>
            <tr>
              <td><strong><?= htmlspecialchars($inquiry->name ?? '') ?></strong></td>
              <td><a href="mailto:<?= htmlspecialchars($inquiry->email ?? '') ?>"><?= htmlspecialchars($inquiry->email ?? '') ?></a></td>
              <td><?= htmlspecialchars($inquiry->phone ?? '') ?></td>
              <td><?= htmlspecialchars($inquiry->subject ?? '') ?></td>
              <td>
                <?php if (!empty($inquiry->replied_at)): ?>
                  <span class="badge badge-success">Replied</span>
                <?php elseif (!empty($inquiry->is_read)): ?>
                  <span class="badge badge-warning">Read</span>
                <?php else: ?>
                  <span class="badge badge-danger">Unread</span>
                <?php endif; ?>
              </td>
              <td><?= !empty($inquiry->created_at) ? formatDate($inquiry->created_at) : '-' ?></td>
              <td>
                <div class="btn-group">
                  <a href="<?= adminRoute('inquiries/view/' . $inquiry->id) ?>" class="btn btn-sm btn-outline"><i class="fas fa-eye"></i> View</a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if (($pagination->lastPage ?? 1) > 1): ?>
    <div class="card-body" style="border-top:1px solid var(--border);">
      <?= paginateLinks($pagination, adminRoute('inquiries')) ?>
    </div>
  <?php endif; ?>
</div>
