<div class="page-header">
  <h1>Create Testimonial</h1>
  <a href="/admin/testimonials" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back to Testimonials</a>
</div>

<div class="card">
  <div class="card-body">
    <form method="POST" action="/admin/testimonials/store" enctype="multipart/form-data">
      <?= csrfField() ?>
      <div class="form-row">
        <div class="form-group">
          <label for="client_name">Client Name <span class="required">*</span></label>
          <input type="text" class="form-control" id="client_name" name="client_name" required value="<?= htmlspecialchars($testimonial['client_name'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="client_company">Client Company</label>
          <input type="text" class="form-control" id="client_company" name="client_company" value="<?= htmlspecialchars($testimonial['client_company'] ?? '') ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="client_designation">Client Designation</label>
          <input type="text" class="form-control" id="client_designation" name="client_designation" value="<?= htmlspecialchars($testimonial['client_designation'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="rating">Rating <span class="required">*</span></label>
          <select class="form-control" id="rating" name="rating" required>
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <option value="<?= $i ?>" <?= (($testimonial['rating'] ?? 5) == $i) ? 'selected' : '' ?>><?= $i ?> Star<?= $i > 1 ? 's' : '' ?></option>
            <?php endfor; ?>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="loan_type">Loan Type</label>
          <input type="text" class="form-control" id="loan_type" name="loan_type" value="<?= htmlspecialchars($testimonial['loan_type'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="amount_sanctioned">Amount Sanctioned (₹)</label>
          <input type="number" class="form-control" id="amount_sanctioned" name="amount_sanctioned" value="<?= htmlspecialchars($testimonial['amount_sanctioned'] ?? '') ?>" min="0" step="0.01">
        </div>
      </div>

      <div class="form-group">
        <label for="content">Content <span class="required">*</span></label>
        <textarea class="form-control" id="content" name="content" rows="5" required><?= htmlspecialchars($testimonial['content'] ?? '') ?></textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="client_photo">Client Photo</label>
          <input type="file" class="form-control" id="client_photo" name="client_photo" accept="image/*" style="padding:8px 14px;">
        </div>
        <div class="form-row" style="gap:16px;">
          <div class="form-group" style="flex:1;">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
              <option value="published" <?= (($testimonial['status'] ?? 'published') === 'published') ? 'selected' : '' ?>>Published</option>
              <option value="draft" <?= (($testimonial['status'] ?? 'published') === 'draft') ? 'selected' : '' ?>>Draft</option>
            </select>
          </div>
          <div class="form-group" style="flex:1;">
            <label for="order">Order</label>
            <input type="number" class="form-control" id="order" name="order" value="<?= (int)($testimonial['order'] ?? 0) ?>" min="0">
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <div class="form-check">
            <input type="checkbox" id="is_featured" name="is_featured" value="1" <?= !empty($testimonial['is_featured']) ? 'checked' : '' ?>>
            <label for="is_featured">Is Featured (Show on Homepage)</label>
          </div>
        </div>
      </div>

      <div style="display:flex;gap:10px;margin-top:24px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Create Testimonial</button>
        <a href="/admin/testimonials" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
