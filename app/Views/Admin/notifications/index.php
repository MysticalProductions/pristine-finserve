<div class="page-header">
  <h1><i class="fas fa-bell"></i> Notifications</h1>
</div>

<div class="card">
  <div class="card-body" style="padding:0;">
    <?php if (empty($pagination->items)): ?>
      <div class="empty-state">
        <i class="fas fa-bell-slash"></i>
        <p>No notifications found.</p>
      </div>
    <?php else: ?>
      <?php foreach ($pagination->items as $notif): ?>
        <?php
          $iconMap = ['info'=>'fa-info-circle', 'success'=>'fa-check-circle', 'warning'=>'fa-exclamation-triangle', 'error'=>'fa-times-circle', 'lead'=>'fa-user-clock', 'message'=>'fa-envelope', 'system'=>'fa-cog'];
          $icon = $iconMap[$notif->type ?? ''] ?? 'fa-bell';
          $colorMap = ['info'=>'var(--info)', 'success'=>'var(--success)', 'warning'=>'var(--warning)', 'error'=>'var(--error)', 'lead'=>'var(--gold)', 'message'=>'var(--info)', 'system'=>'var(--text-secondary)'];
          $color = $colorMap[$notif->type ?? ''] ?? 'var(--text-secondary)';
          $isUnread = !empty($notif->is_read) ? false : true;
        ?>
        <div style="display:flex;align-items:flex-start;gap:14px;padding:16px 20px;border-bottom:1px solid var(--border);<?= $isUnread ? 'background:rgba(212,168,67,0.04);' : '' ?>">
          <div style="width:36px;height:36px;border-radius:50%;background:<?= $color ?>15;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fas <?= $icon ?>" style="color:<?= $color ?>;font-size:0.9rem;"></i>
          </div>
          <div style="flex:1;min-width:0;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:2px;">
              <strong style="font-size:0.85rem;<?= $isUnread ? '' : 'color:var(--text-secondary);' ?>"><?= htmlspecialchars($notif->title ?? '') ?></strong>
              <?php if ($isUnread): ?>
                <span style="width:8px;height:8px;border-radius:50%;background:var(--gold);flex-shrink:0;"></span>
              <?php endif; ?>
            </div>
            <?php if (!empty($notif->message)): ?>
              <p style="font-size:0.8rem;color:var(--text-secondary);margin-bottom:4px;"><?= htmlspecialchars($notif->message) ?></p>
            <?php endif; ?>
            <div style="display:flex;align-items:center;gap:12px;font-size:0.7rem;color:var(--text-muted);">
              <span><i class="far fa-clock"></i> <?= !empty($notif->created_at) ? formatDate($notif->created_at, 'M d, Y h:i A') : '' ?></span>
              <?php if ($isUnread): ?>
                <button class="mark-read-btn" data-id="<?= (int)$notif->id ?>" style="background:none;border:none;color:var(--gold);cursor:pointer;font-size:0.7rem;font-weight:600;"><i class="fas fa-check"></i> Mark as read</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <?php if (($pagination->lastPage ?? 1) > 1): ?>
    <div class="card-body" style="border-top:1px solid var(--border);">
      <?= paginateLinks($pagination, adminRoute('notifications')) ?>
    </div>
  <?php endif; ?>
</div>

<script>
document.querySelectorAll('.mark-read-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const id = this.dataset.id;
    fetch('<?= adminRoute('notifications/mark-read/') ?>' + id, { method: 'POST' })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          const parent = this.closest('div[style*="background"]');
          if (parent) parent.style.background = 'none';
          this.remove();
        }
      });
  });
});
</script>
