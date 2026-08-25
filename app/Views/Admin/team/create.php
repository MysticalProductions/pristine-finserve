<div class="page-header">
  <h1>Create Promoter Profile</h1>
  <a href="/admin/team" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back to Promoter</a>
</div>

<div class="card">
  <div class="card-body">
    <form method="POST" action="/admin/team/store" enctype="multipart/form-data">
      <?= csrfField() ?>
      <div class="form-row">
        <div class="form-group">
          <label for="name">Name <span class="required">*</span></label>
          <input type="text" class="form-control" id="name" name="name" required value="<?= htmlspecialchars($member['name'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="designation">Designation <span class="required">*</span></label>
          <input type="text" class="form-control" id="designation" name="designation" required value="<?= htmlspecialchars($member['designation'] ?? '') ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($member['email'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($member['phone'] ?? '') ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="linkedin_url">LinkedIn URL</label>
          <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" placeholder="https://linkedin.com/in/username" value="<?= htmlspecialchars($member['linkedin_url'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="twitter_url">Twitter URL</label>
          <input type="url" class="form-control" id="twitter_url" name="twitter_url" placeholder="https://twitter.com/username" value="<?= htmlspecialchars($member['twitter_url'] ?? '') ?>">
        </div>
      </div>

      <div class="form-group">
        <label for="bio">Bio</label>
        <textarea class="form-control" id="bio" name="bio" rows="5"><?= htmlspecialchars($member['bio'] ?? '') ?></textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="photo">Photo</label>
          <input type="file" class="form-control" id="photo" name="photo" accept="image/*" style="padding:8px 14px;">
        </div>
        <div class="form-row" style="gap:16px;">
          <div class="form-group" style="flex:1;">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
              <option value="active" <?= (($member['status'] ?? 'active') === 'active') ? 'selected' : '' ?>>Active</option>
              <option value="inactive" <?= (($member['status'] ?? 'active') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
            </select>
          </div>
          <div class="form-group" style="flex:1;">
            <label for="order">Order</label>
            <input type="number" class="form-control" id="order" name="order" value="<?= (int)($member['order'] ?? 0) ?>" min="0">
          </div>
        </div>
      </div>

      <div style="display:flex;gap:10px;margin-top:24px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Create Promoter</button>
        <a href="/admin/team" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
