<div class="page-header">
  <h1>Edit Calculator</h1>
  <a href="/admin/calculators" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back to Calculators</a>
</div>

<div class="card">
  <div class="card-body">
    <form method="POST" action="/admin/calculators/update/<?= (int)($calculator['id'] ?? 0) ?>">
      <?= csrfField() ?>
      <div class="form-row">
        <div class="form-group">
          <label for="title">Title <span class="required">*</span></label>
          <input type="text" class="form-control" id="title" name="title" data-slug-source="true" data-slug-target="#slug" required value="<?= htmlspecialchars($calculator['title'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="slug">Slug <span class="required">*</span></label>
          <input type="text" class="form-control" id="slug" name="slug" required value="<?= htmlspecialchars($calculator['slug'] ?? '') ?>">
          <div class="form-hint">Auto-generated from title. Can be edited manually.</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="type">Type <span class="required">*</span></label>
          <select class="form-control" id="type" name="type" required>
            <option value="emi" <?= (($calculator['type'] ?? '') === 'emi') ? 'selected' : '' ?>>EMI</option>
            <option value="eligibility" <?= (($calculator['type'] ?? '') === 'eligibility') ? 'selected' : '' ?>>Affordability/Eligibility</option>
            <option value="comparison" <?= (($calculator['type'] ?? '') === 'comparison') ? 'selected' : '' ?>>Comparison</option>
            <option value="sip" <?= (($calculator['type'] ?? '') === 'sip') ? 'selected' : '' ?>>SIP</option>
            <option value="lumpsum" <?= (($calculator['type'] ?? '') === 'lumpsum') ? 'selected' : '' ?>>Lumpsum</option>
          </select>
        </div>
        <div class="form-row" style="gap:16px;">
          <div class="form-group" style="flex:1;">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
              <option value="active" <?= (($calculator['status'] ?? '') === 'active') ? 'selected' : '' ?>>Active</option>
              <option value="inactive" <?= (($calculator['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
            </select>
          </div>
          <div class="form-group" style="flex:1;">
            <label for="order">Order</label>
            <input type="number" class="form-control" id="order" name="order" value="<?= (int)($calculator['order'] ?? 0) ?>" min="0">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($calculator['description'] ?? '') ?></textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="default_rate">Default Rate (%)</label>
          <input type="number" class="form-control" id="default_rate" name="default_rate" value="<?= htmlspecialchars($calculator['default_rate'] ?? '') ?>" min="0" step="0.01">
        </div>
        <div class="form-group">
          <label for="default_tenure">Default Tenure (months)</label>
          <input type="number" class="form-control" id="default_tenure" name="default_tenure" value="<?= (int)($calculator['default_tenure'] ?? 0) ?>" min="0">
        </div>
      </div>

      <div class="form-group">
        <label for="default_amount">Default Amount (₹)</label>
        <input type="number" class="form-control" id="default_amount" name="default_amount" value="<?= htmlspecialchars($calculator['default_amount'] ?? '') ?>" min="0" step="0.01">
      </div>

      <div style="display:flex;gap:10px;margin-top:24px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Calculator</button>
        <a href="/admin/calculators" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
