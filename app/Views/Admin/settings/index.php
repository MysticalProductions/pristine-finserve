<div class="page-header">
  <h1><i class="fas fa-cog"></i> Settings</h1>
</div>

<form method="POST" action="<?= adminRoute('settings/update') ?>" enctype="multipart/form-data">
  <?= csrfField() ?>

  <?php if (!empty($settings)): ?>
    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px;">
      <?php foreach ($settings as $group => $items): ?>
        <a href="#group-<?= htmlspecialchars($group) ?>" class="btn btn-sm btn-outline"><?= htmlspecialchars(ucfirst($group)) ?></a>
      <?php endforeach; ?>
    </div>

    <?php foreach ($settings as $group => $items): ?>
      <div class="card" style="margin-bottom:20px;" id="group-<?= htmlspecialchars($group) ?>">
        <div class="card-header">
          <?= htmlspecialchars(ucfirst(str_replace('_', ' ', $group))) ?>
        </div>
        <div class="card-body">
          <?php foreach ($items as $setting): ?>
            <div class="form-group">
              <label for="setting_<?= htmlspecialchars($setting->key) ?>">
                <?= htmlspecialchars(ucfirst(str_replace(['_', '-'], ' ', $setting->key))) ?>
              </label>
              <?php if (($setting->type ?? 'text') === 'textarea'): ?>
                <textarea name="<?= htmlspecialchars($setting->key) ?>" id="setting_<?= htmlspecialchars($setting->key) ?>" class="form-control" rows="4"><?= htmlspecialchars($setting->value ?? '') ?></textarea>
              <?php elseif (($setting->type ?? 'text') === 'image'): ?>
                <div style="display:flex;align-items:center;gap:12px;">
                  <?php if (!empty($setting->value)): ?>
                    <img src="/storage/uploads/<?= htmlspecialchars($setting->value) ?>" alt="" style="width:80px;height:80px;border-radius:6px;object-fit:cover;border:1px solid var(--border);">
                  <?php endif; ?>
                  <input type="file" name="<?= htmlspecialchars($setting->key) ?>" id="setting_<?= htmlspecialchars($setting->key) ?>" class="form-control">
                </div>
                <?php if (!empty($setting->value)): ?>
                  <input type="hidden" name="<?= htmlspecialchars($setting->key) ?>_existing" value="<?= htmlspecialchars($setting->value) ?>">
                <?php endif; ?>
              <?php else: ?>
                <input type="text" name="<?= htmlspecialchars($setting->key) ?>" id="setting_<?= htmlspecialchars($setting->key) ?>" class="form-control" value="<?= htmlspecialchars($setting->value ?? '') ?>">
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="card">
      <div class="card-body">
        <div class="empty-state">
          <i class="fas fa-cog"></i>
          <p>No settings found.</p>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div style="text-align:right;">
    <button type="submit" class="btn btn-gold btn-lg"><i class="fas fa-save"></i> Save Settings</button>
  </div>
</form>
