<div class="page-header">
  <h1><i class="fas fa-plus-circle"></i> Add Statistic</h1>
  <a href="<?= adminRoute('statistics') ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="card" style="max-width:600px;">
  <div class="card-body">
    <form method="POST" action="<?= adminRoute('statistics/store') ?>">
      <?= csrfField() ?>

      <div class="form-group">
        <label for="label">Label <span class="required">*</span></label>
        <input type="text" name="label" id="label" class="form-control" value="<?= htmlspecialchars(old('label')) ?>" placeholder="e.g. Happy Customers" required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="value">Value <span class="required">*</span></label>
          <input type="text" name="value" id="value" class="form-control" value="<?= htmlspecialchars(old('value')) ?>" placeholder="e.g. 10000" required>
        </div>
        <div class="form-group">
          <label for="suffix">Suffix</label>
          <input type="text" name="suffix" id="suffix" class="form-control" value="<?= htmlspecialchars(old('suffix', '+')) ?>" placeholder="e.g. +, %, Cr+">
        </div>
      </div>

      <div class="form-group">
        <label for="icon">Icon (emoji)</label>
        <input type="text" name="icon" id="icon" class="form-control" value="<?= htmlspecialchars(old('icon', '📊')) ?>" placeholder="e.g. 👥, 🏦, 📈">
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="order">Order</label>
          <input type="number" name="order" id="order" class="form-control" value="<?= (int) old('order', 0) ?>">
        </div>
        <div class="form-group">
          <label for="status">Status</label>
          <select name="status" id="status" class="form-control">
            <option value="active" <?= old('status', 'active') === 'active' ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= old('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
          </select>
        </div>
      </div>

      <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Create Statistic</button>
    </form>
  </div>
</div>
