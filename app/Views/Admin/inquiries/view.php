<div class="page-header">
  <h1><i class="fas fa-envelope"></i> Inquiry Details</h1>
  <a href="<?= adminRoute('inquiries') ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to Inquiries</a>
</div>

<div class="grid-2">
  <div class="card">
    <div class="card-header">Contact Information</div>
    <div class="card-body">
      <table style="width:100%;border-collapse:collapse;">
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;width:120px;">Name</td><td style="padding:8px 0;"><?= htmlspecialchars($inquiry->name ?? '') ?></td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Email</td><td style="padding:8px 0;"><a href="mailto:<?= htmlspecialchars($inquiry->email ?? '') ?>"><?= htmlspecialchars($inquiry->email ?? '') ?></a></td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Phone</td><td style="padding:8px 0;"><?= htmlspecialchars($inquiry->phone ?? '') ?></td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Subject</td><td style="padding:8px 0;"><?= htmlspecialchars($inquiry->subject ?? '') ?></td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Status</td><td style="padding:8px 0;">
          <?php if (!empty($inquiry->replied_at)): ?>
            <span class="badge badge-success">Replied</span>
          <?php elseif (!empty($inquiry->is_read)): ?>
            <span class="badge badge-warning">Read</span>
          <?php else: ?>
            <span class="badge badge-danger">Unread</span>
          <?php endif; ?>
        </td></tr>
        <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Date</td><td style="padding:8px 0;"><?= !empty($inquiry->created_at) ? formatDate($inquiry->created_at, 'M d, Y h:i A') : '-' ?></td></tr>
        <?php if (!empty($inquiry->replied_at)): ?>
          <tr><td style="padding:8px 0;color:var(--text-secondary);font-weight:600;">Replied At</td><td style="padding:8px 0;"><?= formatDate($inquiry->replied_at, 'M d, Y h:i A') ?></td></tr>
        <?php endif; ?>
      </table>
    </div>
  </div>

  <div>
    <div class="card" style="margin-bottom:20px;">
      <div class="card-header">Message</div>
      <div class="card-body">
        <p style="color:var(--text-secondary);line-height:1.6;white-space:pre-wrap;"><?= htmlspecialchars($inquiry->message ?? '') ?></p>
      </div>
    </div>

    <?php if (!empty($inquiry->reply_message)): ?>
      <div class="card" style="margin-bottom:20px;">
        <div class="card-header"><i class="fas fa-reply"></i> Your Reply</div>
        <div class="card-body">
          <p style="color:var(--text-secondary);line-height:1.6;white-space:pre-wrap;"><?= htmlspecialchars($inquiry->reply_message) ?></p>
          <small style="color:var(--text-muted);">Replied on <?= formatDate($inquiry->replied_at, 'M d, Y h:i A') ?></small>
        </div>
      </div>
    <?php endif; ?>

    <div class="card">
      <div class="card-header"><i class="fas fa-reply"></i> Send Reply</div>
      <div class="card-body">
        <form method="POST" action="<?= adminRoute('inquiries/reply/' . $inquiry->id) ?>">
          <?= csrfField() ?>
          <div class="form-group">
            <label for="reply_message">Reply Message</label>
            <textarea name="reply_message" id="reply_message" class="form-control" rows="6" placeholder="Type your reply..."></textarea>
          </div>
          <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-gold"><i class="fas fa-paper-plane"></i> Send Reply</button>
            <a href="<?= adminRoute('inquiries/delete/' . $inquiry->id) ?>" class="btn btn-outline" style="color:var(--error);border-color:var(--error);" onclick="return confirm('Delete this inquiry?')"><i class="fas fa-trash"></i> Delete</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
