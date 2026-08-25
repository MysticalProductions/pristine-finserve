<div class="page-header">
  <h1><i class="fas fa-user-plus"></i> Add New User</h1>
  <a href="<?= adminRoute('users') ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Users</a>
</div>

<div class="card" style="max-width:700px;">
  <div class="card-body">
    <form method="POST" action="<?= adminRoute('users/store') ?>" enctype="multipart/form-data">
      <?= csrfField() ?>

      <div class="form-row">
        <div class="form-group">
          <label for="name">Name <span class="required">*</span></label>
          <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars(old('name')) ?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email <span class="required">*</span></label>
          <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars(old('email')) ?>" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="password">Password <span class="required">*</span></label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="password_confirm">Confirm Password <span class="required">*</span></label>
          <input type="password" name="password_confirm" id="password_confirm" class="form-control" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="role_id">Role <span class="required">*</span></label>
          <select name="role_id" id="role_id" class="form-control" required>
            <option value="">Select Role</option>
            <?php if (!empty($roles)): ?>
              <?php foreach ($roles as $role): ?>
                <option value="<?= (int)$role->id ?>" <?= (int)old('role_id') === (int)$role->id ? 'selected' : '' ?>><?= htmlspecialchars($role->name ?? '') ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars(old('phone')) ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="status">Status</label>
          <select name="status" id="status" class="form-control">
            <option value="active" <?= (old('status') ?: 'active') === 'active' ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= (old('status') ?: 'active') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
            <option value="suspended" <?= (old('status') ?: 'active') === 'suspended' ? 'selected' : '' ?>>Suspended</option>
          </select>
        </div>
        <div class="form-group">
          <label for="avatar">Avatar</label>
          <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
        </div>
      </div>

      <div style="display:flex;gap:8px;margin-top:8px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Create User</button>
        <a href="<?= adminRoute('users') ?>" class="btn btn-outline"><i class="fas fa-times"></i> Cancel</a>
      </div>
    </form>
  </div>
</div>
