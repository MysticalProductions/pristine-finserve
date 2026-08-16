<div class="page-header">
  <h1><i class="fas fa-user-shield"></i> Users</h1>
  <a href="<?= adminRoute('users/create') ?>" class="btn btn-gold"><i class="fas fa-plus"></i> Add New User</a>
</div>

<div class="card">
  <div class="table-wrapper">
    <table class="table">
      <thead>
        <tr>
          <th>Avatar</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th>Last Login</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($pagination->items)): ?>
          <tr><td colspan="7" class="empty-state">No users found.</td></tr>
        <?php else: ?>
          <?php foreach ($pagination->items as $user): ?>
            <tr>
              <td>
                <?php if (!empty($user->avatar)): ?>
                  <img src="/storage/uploads/<?= htmlspecialchars($user->avatar) ?>" alt="" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                <?php else: ?>
                  <div style="width:32px;height:32px;border-radius:50%;background:var(--navy);display:flex;align-items:center;justify-content:center;color:var(--white);font-weight:700;font-size:0.75rem;">
                    <?= strtoupper(substr($user->name ?? '?', 0, 1)) ?>
                  </div>
                <?php endif; ?>
              </td>
              <td><strong><?= htmlspecialchars($user->name ?? '') ?></strong></td>
              <td><?= htmlspecialchars($user->email ?? '') ?></td>
              <td><span class="badge badge-gold"><?= htmlspecialchars($user->role_name ?? 'User') ?></span></td>
              <td>
                <?php if (!empty($user->is_active)): ?>
                  <span class="badge badge-success">Active</span>
                <?php else: ?>
                  <span class="badge badge-danger">Inactive</span>
                <?php endif; ?>
              </td>
              <td><?= !empty($user->last_login) ? formatDate($user->last_login, 'M d, Y h:i A') : '-' ?></td>
              <td>
                <div class="btn-group">
                  <a href="<?= adminRoute('users/edit/' . $user->id) ?>" class="btn btn-sm btn-outline"><i class="fas fa-edit"></i> Edit</a>
                  <a href="<?= adminRoute('users/delete/' . $user->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')"><i class="fas fa-trash"></i> Delete</a>
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
      <?= paginateLinks($pagination, adminRoute('users')) ?>
    </div>
  <?php endif; ?>
</div>
