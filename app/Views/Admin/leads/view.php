<div class="page-header">
  <h1><i class="fas fa-user-clock"></i> Lead Details</h1>
  <a href="<?= adminRoute('leads') ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Leads</a>
</div>

<div class="grid-2">
  <div class="card">
    <div class="card-header">Lead Information</div>
    <div class="card-body">
      <table style="width:100%;border-collapse:collapse;">
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;width:140px;">Name</td><td style="padding:8px 0;"><?= htmlspecialchars($lead->name ?? '') ?></td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Email</td><td style="padding:8px 0;"><a href="mailto:<?= htmlspecialchars($lead->email ?? '') ?>"><?= htmlspecialchars($lead->email ?? '') ?></a></td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Phone</td><td style="padding:8px 0;"><?= htmlspecialchars($lead->phone ?? '') ?></td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Loan Type</td><td style="padding:8px 0;"><?= htmlspecialchars($lead->loan_type ?? '') ?></td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Amount</td><td style="padding:8px 0;"><?= !empty($lead->loan_amount) ? formatCurrency((float)$lead->loan_amount) : '-' ?></td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">City</td><td style="padding:8px 0;"><?= htmlspecialchars($lead->city ?? '') ?></td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Source</td><td style="padding:8px 0;"><?= htmlspecialchars($lead->source ?? '') ?></td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Status</td><td style="padding:8px 0;">
          <?php
            $badgeMap = ['new'=>'badge-info', 'contacted'=>'badge-secondary', 'qualified'=>'badge-primary', 'proposal'=>'badge-warning', 'negotiation'=>'badge-warning', 'converted'=>'badge-success', 'lost'=>'badge-danger'];
            $badge = $badgeMap[$lead->status ?? ''] ?? 'badge-secondary';
          ?>
          <span class="badge <?= $badge ?>"><?= htmlspecialchars(ucfirst($lead->status ?? 'unknown')) ?></span>
        </td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Date</td><td style="padding:8px 0;"><?= !empty($lead->created_at) ? formatDate($lead->created_at, 'M d, Y h:i A') : '-' ?></td></tr>
        <?php if (!empty($lead->converted_at)): ?>
          <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Converted At</td><td style="padding:8px 0;"><?= formatDate($lead->converted_at, 'M d, Y h:i A') ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($lead->lost_at)): ?>
          <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Lost At</td><td style="padding:8px 0;"><?= formatDate($lead->lost_at, 'M d, Y h:i A') ?></td></tr>
        <?php endif; ?>
      </table>
    </div>
  </div>

  <div>
    <div class="card" style="margin-bottom:20px;">
      <div class="card-header">Update Status</div>
      <div class="card-body">
        <form method="POST" action="<?= adminRoute('leads/status/' . $lead->id) ?>">
          <?= csrfField() ?>
          <div class="form-group">
            <select name="status" class="form-control">
              <option value="new" <?= ($lead->status ?? '') === 'new' ? 'selected' : '' ?>>New</option>
              <option value="contacted" <?= ($lead->status ?? '') === 'contacted' ? 'selected' : '' ?>>Contacted</option>
              <option value="qualified" <?= ($lead->status ?? '') === 'qualified' ? 'selected' : '' ?>>Qualified</option>
              <option value="proposal" <?= ($lead->status ?? '') === 'proposal' ? 'selected' : '' ?>>Proposal</option>
              <option value="negotiation" <?= ($lead->status ?? '') === 'negotiation' ? 'selected' : '' ?>>Negotiation</option>
              <option value="converted" <?= ($lead->status ?? '') === 'converted' ? 'selected' : '' ?>>Converted</option>
              <option value="lost" <?= ($lead->status ?? '') === 'lost' ? 'selected' : '' ?>>Lost</option>
            </select>
          </div>
          <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Status</button>
        </form>
      </div>
    </div>

    <div class="card">
      <div class="card-header">Message</div>
      <div class="card-body">
        <p style="color:var(--text-secondary);line-height:1.6;"><?= nl2br(htmlspecialchars($lead->message ?? 'No message provided.')) ?></p>
      </div>
    </div>
  </div>
</div>

<div class="card" style="margin-top:20px;">
  <div class="card-header"><i class="fas fa-sticky-note"></i> Notes</div>
  <div class="card-body">
    <?php
      $notes = [];
      if (!empty($lead->notes)) {
        $notes = is_string($lead->notes) ? json_decode($lead->notes, true) : (array)$lead->notes;
      }
    ?>
    <?php if (!empty($notes)): ?>
      <div style="margin-bottom:20px;">
        <?php foreach (array_reverse($notes) as $note): ?>
          <div style="padding:12px;background:var(--light-gray);border-radius:var(--radius);margin-bottom:10px;">
            <p style="margin-bottom:4px;"><?= nl2br(htmlspecialchars($note['note'] ?? '')) ?></p>
            <small style="color:var(--text-muted);">
              <?= !empty($note['created_at']) ? formatDate($note['created_at'], 'M d, Y h:i A') : '' ?>
              <?= !empty($note['user_id']) ? '- User #' . (int)$note['user_id'] : '' ?>
            </small>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p style="color:var(--text-muted);margin-bottom:16px;">No notes yet.</p>
    <?php endif; ?>

    <form method="POST" action="<?= adminRoute('leads/notes/' . $lead->id) ?>">
      <?= csrfField() ?>
      <div class="form-group">
        <label for="note">Add Note</label>
        <textarea name="note" id="note" class="form-control" rows="3" placeholder="Enter a note..."></textarea>
      </div>
      <button type="submit" class="btn btn-navy"><i class="fas fa-plus"></i> Add Note</button>
    </form>
  </div>
</div>

<div class="card" style="margin-top:20px;">
  <div class="card-header"><i class="fas fa-history"></i> Lead Timeline</div>
  <div class="card-body">
    <div style="position:relative;padding-left:24px;border-left:2px solid var(--border);">
      <div style="margin-bottom:16px;position:relative;">
        <div style="position:absolute;left:-31px;top:2px;width:14px;height:14px;border-radius:50%;background:var(--gold);border:2px solid var(--white);"></div>
        <strong>Created</strong><br>
        <small style="color:var(--text-muted);"><?= !empty($lead->created_at) ? formatDate($lead->created_at, 'M d, Y h:i A') : '' ?></small>
      </div>
      <?php if (!empty($lead->converted_at)): ?>
        <div style="margin-bottom:16px;position:relative;">
          <div style="position:absolute;left:-31px;top:2px;width:14px;height:14px;border-radius:50%;background:var(--success);border:2px solid var(--white);"></div>
          <strong>Converted</strong><br>
          <small style="color:var(--text-muted);"><?= formatDate($lead->converted_at, 'M d, Y h:i A') ?></small>
        </div>
      <?php endif; ?>
      <?php if (!empty($lead->lost_at)): ?>
        <div style="margin-bottom:16px;position:relative;">
          <div style="position:absolute;left:-31px;top:2px;width:14px;height:14px;border-radius:50%;background:var(--error);border:2px solid var(--white);"></div>
          <strong>Lost</strong><br>
          <small style="color:var(--text-muted);"><?= formatDate($lead->lost_at, 'M d, Y h:i A') ?></small>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
