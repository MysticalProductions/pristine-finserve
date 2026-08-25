<!-- Stats Cards -->
<div class="stats-grid">
  <div class="stat-card">
    <div class="icon blue"><i class="fas fa-user-clock"></i></div>
    <div class="info">
      <h3><?= number_format($totalLeads ?? 0) ?></h3>
      <p>Total Leads</p>
    </div>
  </div>
  <div class="stat-card">
    <div class="icon green"><i class="fas fa-user-plus"></i></div>
    <div class="info">
      <h3><?= number_format($newLeadsToday ?? 0) ?></h3>
      <p>New Leads (Today)</p>
    </div>
  </div>
  <div class="stat-card">
    <div class="icon orange"><i class="fas fa-envelope"></i></div>
    <div class="info">
      <h3><?= number_format($totalInquiries ?? 0) ?></h3>
      <p>Total Inquiries</p>
    </div>
  </div>
  <div class="stat-card">
    <div class="icon purple"><i class="fas fa-newspaper"></i></div>
    <div class="info">
      <h3><?= number_format($blogPosts ?? 0) ?></h3>
      <p>Blog Posts</p>
    </div>
  </div>
  <div class="stat-card">
    <div class="icon gold"><i class="fas fa-concierge-biscuit"></i></div>
    <div class="info">
      <h3><?= number_format($services ?? 0) ?></h3>
      <p>Services</p>
    </div>
  </div>
  <div class="stat-card">
    <div class="icon red"><i class="fas fa-handshake"></i></div>
    <div class="info">
      <h3><?= number_format($partners ?? 0) ?></h3>
      <p>Partners</p>
    </div>
  </div>
</div>

<!-- Recent Leads -->
<div class="card" style="margin-bottom:24px;">
  <div class="card-header">
    <i class="fas fa-user-clock" style="color:var(--gold);margin-right:8px;"></i>
    Recent Leads
    <a href="/admin/leads" style="float:right;font-size:0.8rem;color:#1B5AAE;font-weight:500;">View All &rarr;</a>
  </div>
  <div class="card-body" style="padding:0;">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Loan Type</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($recentLeads) && is_array($recentLeads)): ?>
            <?php foreach ($recentLeads as $lead): ?>
              <tr>
                <td><a href="/admin/leads/view/<?= (int)($lead['id'] ?? 0) ?>" style="color:#1B5AAE;font-weight:500;"><?= htmlspecialchars($lead['name'] ?? '') ?></a></td>
                <td><?= htmlspecialchars($lead['loan_type'] ?? '') ?></td>
                <td><?php if (!empty($lead['loan_amount'])): ?>₹<?= number_format($lead['loan_amount']) ?><?php else: ?>-<?php endif; ?></td>
                <td>
                  <?php $status = $lead['status'] ?? ''; ?>
                  <?php if ($status === 'new'): ?>
                    <span class="badge badge-info">New</span>
                  <?php elseif ($status === 'contacted'): ?>
                    <span class="badge badge-warning">Contacted</span>
                  <?php elseif ($status === 'qualified'): ?>
                    <span class="badge badge-gold">Qualified</span>
                  <?php elseif ($status === 'approved'): ?>
                    <span class="badge badge-success">Approved</span>
                  <?php elseif ($status === 'rejected'): ?>
                    <span class="badge badge-danger">Rejected</span>
                  <?php else: ?>
                    <span class="badge badge-secondary"><?= htmlspecialchars(ucfirst($status)) ?></span>
                  <?php endif; ?>
                </td>
                <td style="color:var(--text-muted);font-size:0.8rem;"><?= htmlspecialchars($lead['created_at'] ?? '') ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="empty-state" style="padding:32px;">
                <i class="fas fa-user-clock"></i>
                <p>No leads yet</p>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Recent Inquiries -->
<div class="card">
  <div class="card-header">
    <i class="fas fa-envelope" style="color:var(--gold);margin-right:8px;"></i>
    Recent Contact Inquiries
    <a href="/admin/inquiries" style="float:right;font-size:0.8rem;color:#1B5AAE;font-weight:500;">View All &rarr;</a>
  </div>
  <div class="card-body" style="padding:0;">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($recentInquiries) && is_array($recentInquiries)): ?>
            <?php foreach ($recentInquiries as $inquiry): ?>
              <tr>
                <td><a href="/admin/inquiries/view/<?= (int)($inquiry['id'] ?? 0) ?>" style="color:#1B5AAE;font-weight:500;"><?= htmlspecialchars($inquiry['name'] ?? '') ?></a></td>
                <td><?= htmlspecialchars($inquiry['subject'] ?? '') ?></td>
                <td style="color:var(--text-muted);font-size:0.8rem;"><?= htmlspecialchars($inquiry['created_at'] ?? '') ?></td>
                <td>
                  <?php if (!empty($inquiry['replied_at'])): ?>
                    <span class="badge badge-success">Replied</span>
                  <?php elseif (!empty($inquiry['is_read'])): ?>
                    <span class="badge badge-warning">Read</span>
                  <?php else: ?>
                    <span class="badge badge-danger">Unread</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="empty-state" style="padding:32px;">
                <i class="fas fa-envelope"></i>
                <p>No inquiries yet</p>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
