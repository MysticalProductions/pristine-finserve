<div class="page-header">
  <h1>Edit Loan Product</h1>
  <a href="/admin/loans" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back to Loans</a>
</div>

<div class="card">
  <div class="card-body">
    <form method="POST" action="/admin/loans/update/<?= (int)($loan['id'] ?? 0) ?>" enctype="multipart/form-data">
      <?= csrfField() ?>
      <div class="form-row">
        <div class="form-group">
          <label for="name">Name <span class="required">*</span></label>
          <input type="text" class="form-control" id="name" name="name" data-slug-source="true" data-slug-target="#slug" required value="<?= htmlspecialchars($loan['name'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="slug">Slug <span class="required">*</span></label>
          <input type="text" class="form-control" id="slug" name="slug" required value="<?= htmlspecialchars($loan['slug'] ?? '') ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="icon">Icon (Font Awesome class)</label>
          <input type="text" class="form-control" id="icon" name="icon" placeholder="fas fa-hand-holding-usd" value="<?= htmlspecialchars($loan['icon'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="interest_type">Interest Type</label>
          <select class="form-control" id="interest_type" name="interest_type">
            <option value="fixed" <?= (($loan['interest_type'] ?? '') === 'fixed') ? 'selected' : '' ?>>Fixed</option>
            <option value="floating" <?= (($loan['interest_type'] ?? '') === 'floating') ? 'selected' : '' ?>>Floating</option>
            <option value="reducing" <?= (($loan['interest_type'] ?? '') === 'reducing') ? 'selected' : '' ?>>Reducing Balance</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="min_amount">Min Amount (₹)</label>
          <input type="number" class="form-control" id="min_amount" name="min_amount" value="<?= htmlspecialchars($loan['min_amount'] ?? '') ?>" min="0" step="0.01">
        </div>
        <div class="form-group">
          <label for="max_amount">Max Amount (₹)</label>
          <input type="number" class="form-control" id="max_amount" name="max_amount" value="<?= htmlspecialchars($loan['max_amount'] ?? '') ?>" min="0" step="0.01">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="min_rate">Min Rate (%)</label>
          <input type="number" class="form-control" id="min_rate" name="min_rate" value="<?= htmlspecialchars($loan['min_rate'] ?? '') ?>" min="0" step="0.01">
        </div>
        <div class="form-group">
          <label for="max_rate">Max Rate (%)</label>
          <input type="number" class="form-control" id="max_rate" name="max_rate" value="<?= htmlspecialchars($loan['max_rate'] ?? '') ?>" min="0" step="0.01">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="min_tenure_months">Min Tenure (months)</label>
          <input type="number" class="form-control" id="min_tenure_months" name="min_tenure_months" value="<?= htmlspecialchars($loan['min_tenure_months'] ?? '') ?>" min="0">
        </div>
        <div class="form-group">
          <label for="max_tenure_months">Max Tenure (months)</label>
          <input type="number" class="form-control" id="max_tenure_months" name="max_tenure_months" value="<?= htmlspecialchars($loan['max_tenure_months'] ?? '') ?>" min="0">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="processing_fee">Processing Fee (%)</label>
          <input type="number" class="form-control" id="processing_fee" name="processing_fee" value="<?= htmlspecialchars($loan['processing_fee'] ?? '') ?>" min="0" step="0.01">
        </div>
        <div class="form-row" style="gap:16px;">
          <div class="form-group" style="flex:1;">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
              <option value="published" <?= (($loan['status'] ?? '') === 'published') ? 'selected' : '' ?>>Published</option>
              <option value="draft" <?= (($loan['status'] ?? '') === 'draft') ? 'selected' : '' ?>>Draft</option>
            </select>
          </div>
          <div class="form-group" style="flex:1;">
            <label for="order">Order</label>
            <input type="number" class="form-control" id="order" name="order" value="<?= (int)($loan['order'] ?? 0) ?>" min="0">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="short_desc">Short Description</label>
        <textarea class="form-control" id="short_desc" name="short_desc" rows="3"><?= htmlspecialchars($loan['short_desc'] ?? '') ?></textarea>
      </div>

      <div class="form-group">
        <label for="description">Full Description</label>
        <textarea class="form-control" id="description" name="description" rows="8"><?= htmlspecialchars($loan['description'] ?? '') ?></textarea>
      </div>

      <?php if (!empty($loan['featured_image'])): ?>
        <div style="margin-bottom:18px;">
          <label style="display:block;font-size:0.8rem;font-weight:600;margin-bottom:6px;">Current Featured Image</label>
          <img src="<?= uploadUrl(htmlspecialchars($loan['featured_image'])) ?>" alt="" style="max-width:200px;border-radius:6px;border:1px solid var(--border);">
        </div>
      <?php endif; ?>

      <?php if (!empty($loan['brochure'])): ?>
        <div style="margin-bottom:18px;">
          <label style="display:block;font-size:0.8rem;font-weight:600;margin-bottom:6px;">Current Brochure</label>
          <a href="<?= uploadUrl(htmlspecialchars($loan['brochure'])) ?>" target="_blank" style="color:#1B5AAE;font-size:0.85rem;">
            <i class="fas fa-file-pdf"></i> View Brochure
          </a>
        </div>
      <?php endif; ?>

      <div class="grid-2">
        <div class="form-group">
          <label for="eligibility">Eligibility</label>
          <textarea class="form-control" id="eligibility" name="eligibility" rows="5"><?= htmlspecialchars($loan['eligibility'] ?? '') ?></textarea>
          <div class="form-hint">One criteria per line</div>
        </div>
        <div class="form-group">
          <label for="documents">Documents</label>
          <textarea class="form-control" id="documents" name="documents" rows="5"><?= htmlspecialchars($loan['documents'] ?? '') ?></textarea>
          <div class="form-hint">One document per line</div>
        </div>
      </div>

      <div class="grid-2">
        <div class="form-group">
          <label for="features">Features</label>
          <textarea class="form-control" id="features" name="features" rows="5"><?= htmlspecialchars($loan['features'] ?? '') ?></textarea>
          <div class="form-hint">One feature per line</div>
        </div>
        <div class="form-group">
          <label for="benefits">Benefits</label>
          <textarea class="form-control" id="benefits" name="benefits" rows="5"><?= htmlspecialchars($loan['benefits'] ?? '') ?></textarea>
          <div class="form-hint">One benefit per line</div>
        </div>
      </div>

      <div class="form-group">
        <label for="faq">FAQ</label>
        <textarea class="form-control" id="faq" name="faq" rows="5"><?= htmlspecialchars($loan['faq'] ?? '') ?></textarea>
        <div class="form-hint">One per line: <code>Question|Answer</code></div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="featured_image">
            <?= !empty($loan['featured_image']) ? 'Change Featured Image' : 'Featured Image' ?>
          </label>
          <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*" style="padding:8px 14px;">
        </div>
        <div class="form-group">
          <label for="brochure">
            <?= !empty($loan['brochure']) ? 'Change Brochure (PDF)' : 'Brochure (PDF)' ?>
          </label>
          <input type="file" class="form-control" id="brochure" name="brochure" accept=".pdf" style="padding:8px 14px;">
        </div>
      </div>

      <div style="display:flex;gap:10px;margin-top:24px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Loan Product</button>
        <a href="/admin/loans" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
