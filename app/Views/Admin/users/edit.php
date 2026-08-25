<div class="page-header">
  <h1><i class="fas fa-user-edit"></i> Edit User</h1>
  <a href="<?= adminRoute('users') ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Users</a>
</div>

<div class="card" style="max-width:700px;">
  <div class="card-body">
    <form method="POST" action="<?= adminRoute('users/update/' . $user->id) ?>" enctype="multipart/form-data">
      <?= csrfField() ?>

      <div class="form-row">
        <div class="form-group">
          <label for="name">Name <span class="required">*</span></label>
          <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($user->name ?? old('name')) ?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email <span class="required">*</span></label>
          <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user->email ?? old('email')) ?>" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current">
          <p class="form-hint">Leave empty to keep the current password.</p>
        </div>
        <div class="form-group">
          <label for="password_confirm">Confirm Password</label>
          <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Confirm new password">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="role_id">Role <span class="required">*</span></label>
          <select name="role_id" id="role_id" class="form-control" required>
            <option value="">Select Role</option>
            <?php if (!empty($roles)): ?>
              <?php foreach ($roles as $role): ?>
                <option value="<?= (int)$role->id ?>" <?= ((int)($user->role_id ?? old('role_id'))) === (int)$role->id ? 'selected' : '' ?>><?= htmlspecialchars($role->name ?? '') ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($user->phone ?? old('phone')) ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="status">Status</label>
          <select name="status" id="status" class="form-control">
            <option value="active" <?= (($user->status ?? 'active') === 'active') ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= (($user->status ?? 'active') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
            <option value="suspended" <?= (($user->status ?? 'active') === 'suspended') ? 'selected' : '' ?>>Suspended</option>
          </select>
        </div>
        <div class="form-group">
          <label for="avatar">Avatar</label>
          <div style="display:flex;align-items:center;gap:12px;">
            <?php if (!empty($user->avatar)): ?>
              <img src="/storage/uploads/<?= htmlspecialchars($user->avatar) ?>" alt="" style="width:48px;height:48px;border-radius:50%;object-fit:cover;border:2px solid var(--border);">
            <?php endif; ?>
            <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
          </div>
        </div>
      </div>

      <div style="display:flex;gap:8px;margin-top:8px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update User</button>
        <a href="<?= adminRoute('users') ?>" class="btn btn-outline"><i class="fas fa-times"></i> Cancel</a>
      </div>
    </form>
  </div>
</div>
