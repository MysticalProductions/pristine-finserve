<div class="page-header">
  <h1>Testimonials</h1>
  <a href="/admin/testimonials/create" class="btn btn-gold btn-sm"><i class="fas fa-plus"></i> Add New Testimonial</a>
</div>

<div class="card">
  <div class="card-body" style="padding:0;">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>Client Name</th>
            <th>Company</th>
            <th>Rating</th>
            <th>Loan Type</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Featured</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($testimonials) && is_array($testimonials)): ?>
            <?php foreach ($testimonials as $t): ?>
              <tr>
                <td>
                  <a href="/admin/testimonials/edit/<?= (int)($t['id'] ?? 0) ?>" style="color:#1B5AAE;font-weight:500;">
                    <?= htmlspecialchars($t['client_name'] ?? '') ?>
                  </a>
                </td>
                <td><?= htmlspecialchars($t['client_company'] ?? '') ?></td>
                <td style="color:var(--gold);">
                  <?php $rating = (int)($t['rating'] ?? 0); ?>
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <i class="fas fa-star<?= $i <= $rating ? '' : ' fa-regular' ?>"></i>
                  <?php endfor; ?>
                </td>
                <td><?= htmlspecialchars($t['loan_type'] ?? '') ?></td>
                <td><?= !empty($t['amount_sanctioned']) ? '₹' . number_format((float)$t['amount_sanctioned']) : '-' ?></td>
                <td>
                  <?php if (($t['status'] ?? '') === 'published'): ?>
                    <span class="badge badge-success">Published</span>
                  <?php else: ?>
                    <span class="badge badge-warning">Draft</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if (!empty($t['is_featured'])): ?>
                    <span class="badge badge-success">Yes</span>
                  <?php else: ?>
                    <span class="badge badge-secondary">No</span>
                  <?php endif; ?>
                </td>
                <td style="text-align:right;">
                  <div class="btn-group">
                    <a href="/admin/testimonials/edit/<?= (int)($t['id'] ?? 0) ?>" class="btn btn-navy btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                    <a href="/admin/testimonials/delete/<?= (int)($t['id'] ?? 0) ?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this testimonial?')"><i class="fas fa-trash"></i></a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8">
                <div class="empty-state">
                  <i class="fas fa-star"></i>
                  <p>No testimonials found. Add your first testimonial!</p>
                  <a href="/admin/testimonials/create" class="btn btn-gold btn-sm" style="margin-top:12px;"><i class="fas fa-plus"></i> Add New Testimonial</a>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
