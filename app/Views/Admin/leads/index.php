<div class="page-header">
  <h1><i class="fas fa-user-clock"></i> Leads</h1>
  <div class="btn-group">
    <a href="<?= adminRoute('leads/export') . (!empty($status) ? '?status=' . htmlspecialchars($status) : '') ?>" class="btn btn-outline btn-sm">
      <i class="fas fa-download"></i> Export CSV
    </a>
  </div>
</div>

<div class="card" style="margin-bottom:20px;">
  <div class="card-body">
    <form method="GET" action="<?= adminRoute('leads') ?>" class="form-row" style="grid-template-columns: 1fr 1fr auto; align-items: end;">
      <div class="form-group" style="margin-bottom:0;">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
          <option value="">All Statuses</option>
          <option value="new" <?= ($status ?? '') === 'new' ? 'selected' : '' ?>>New</option>
          <option value="contacted" <?= ($status ?? '') === 'contacted' ? 'selected' : '' ?>>Contacted</option>
          <option value="qualified" <?= ($status ?? '') === 'qualified' ? 'selected' : '' ?>>Qualified</option>
          <option value="proposal" <?= ($status ?? '') === 'proposal' ? 'selected' : '' ?>>Proposal</option>
          <option value="negotiation" <?= ($status ?? '') === 'negotiation' ? 'selected' : '' ?>>Negotiation</option>
          <option value="converted" <?= ($status ?? '') === 'converted' ? 'selected' : '' ?>>Converted</option>
          <option value="lost" <?= ($status ?? '') === 'lost' ? 'selected' : '' ?>>Lost</option>
        </select>
      </div>
      <div class="form-group" style="margin-bottom:0;">
        <label for="date_from">Date Range</label>
        <div style="display:flex;gap:8px;">
          <input type="date" name="date_from" id="date_from" class="form-control" value="<?= htmlspecialchars($_GET['date_from'] ?? '') ?>">
          <input type="date" name="date_to" id="date_to" class="form-control" value="<?= htmlspecialchars($_GET['date_to'] ?? '') ?>">
        </div>
      </div>
      <button type="submit" class="btn btn-navy"><i class="fas fa-filter"></i> Filter</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="table-wrapper">
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Loan Type</th>
          <th>Amount</th>
          <th>Source</th>
          <th>Status</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($pagination->items)): ?>
          <tr><td colspan="9" class="empty-state">No leads found.</td></tr>
        <?php else: ?>
          <?php foreach ($pagination->items as $lead): ?>
            <tr>
              <td><strong><?= htmlspecialchars($lead->name ?? '') ?></strong></td>
              <td><a href="mailto:<?= htmlspecialchars($lead->email ?? '') ?>"><?= htmlspecialchars($lead->email ?? '') ?></a></td>
              <td><?= htmlspecialchars($lead->phone ?? '') ?></td>
              <td><?= htmlspecialchars($lead->loan_type ?? '') ?></td>
              <td><?= !empty($lead->loan_amount) ? formatCurrency((float)$lead->loan_amount) : '-' ?></td>
              <td><?= htmlspecialchars($lead->source ?? '') ?></td>
              <td>
                <?php
                  $badgeMap = ['new'=>'badge-info', 'contacted'=>'badge-secondary', 'qualified'=>'badge-primary', 'proposal'=>'badge-warning', 'negotiation'=>'badge-warning', 'converted'=>'badge-success', 'lost'=>'badge-danger'];
                  $badge = $badgeMap[$lead->status ?? ''] ?? 'badge-secondary';
                ?>
                <span class="badge <?= $badge ?>"><?= htmlspecialchars(ucfirst($lead->status ?? 'unknown')) ?></span>
              </td>
              <td><?= !empty($lead->created_at) ? formatDate($lead->created_at) : '-' ?></td>
              <td>
                <div class="btn-group">
                  <a href="<?= adminRoute('leads/view/' . $lead->id) ?>" class="btn btn-sm btn-outline"><i class="fas fa-eye"></i> View</a>
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
      <?= paginateLinks($pagination, adminRoute('leads')) ?>
    </div>
  <?php endif; ?>
</div>
