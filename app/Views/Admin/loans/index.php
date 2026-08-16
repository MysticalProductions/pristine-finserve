<div class="page-header">
  <h1>Loan Products</h1>
  <a href="/admin/loans/create" class="btn btn-gold btn-sm"><i class="fas fa-plus"></i> Add New Loan</a>
</div>

<div class="card">
  <div class="card-body" style="padding:0;">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Min Amount</th>
            <th>Max Amount</th>
            <th>Rate Range</th>
            <th>Status</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($loans) && is_array($loans)): ?>
            <?php foreach ($loans as $loan): ?>
              <tr>
                <td>
                  <a href="/admin/loans/edit/<?= (int)($loan['id'] ?? 0) ?>" style="color:#1B5AAE;font-weight:500;">
                    <?= htmlspecialchars($loan['name'] ?? '') ?>
                  </a>
                </td>
                <td>₹<?= number_format($loan['min_amount'] ?? 0) ?></td>
                <td>₹<?= number_format($loan['max_amount'] ?? 0) ?></td>
                <td>
                  <?= htmlspecialchars($loan['min_rate'] ?? '') ?>% - <?= htmlspecialchars($loan['max_rate'] ?? '') ?>%
                </td>
                <td>
                  <?php if (($loan['status'] ?? '') === 'published'): ?>
                    <span class="badge badge-success">Published</span>
                  <?php else: ?>
                    <span class="badge badge-warning">Draft</span>
                  <?php endif; ?>
                </td>
                <td style="text-align:right;">
                  <div class="btn-group">
                    <a href="/admin/loans/edit/<?= (int)($loan['id'] ?? 0) ?>" class="btn btn-navy btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                    <a href="/admin/loans/delete/<?= (int)($loan['id'] ?? 0) ?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this loan product?')"><i class="fas fa-trash"></i></a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6">
                <div class="empty-state">
                  <i class="fas fa-hand-holding-usd"></i>
                  <p>No loan products found. Create your first loan!</p>
                  <a href="/admin/loans/create" class="btn btn-gold btn-sm" style="margin-top:12px;"><i class="fas fa-plus"></i> Add New Loan</a>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
