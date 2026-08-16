<div class="page-header">
  <h1>Promoter Profile</h1>
  <a href="/admin/team/create" class="btn btn-gold btn-sm"><i class="fas fa-plus"></i> Add New Promoter</a>
</div>

<div class="card">
  <div class="card-body" style="padding:0;">
    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Order</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($team) && is_array($team)): ?>
            <?php foreach ($team as $m): ?>
              <tr>
                <td>
                  <?php if (!empty($m['photo'])): ?>
                    <img src="<?= uploadUrl(htmlspecialchars($m['photo'])) ?>" alt="<?= htmlspecialchars($m['name'] ?? '') ?>" style="width:40px;height:40px;object-fit:cover;border-radius:50%;border:1px solid var(--border);">
                  <?php else: ?>
                    <span style="display:inline-flex;width:40px;height:40px;border-radius:50%;background:var(--light-gray);align-items:center;justify-content:center;color:var(--text-muted);font-size:0.75rem;">
                      <i class="fas fa-user"></i>
                    </span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="/admin/team/edit/<?= (int)($m['id'] ?? 0) ?>" style="color:#1B5AAE;font-weight:500;">
                    <?= htmlspecialchars($m['name'] ?? '') ?>
                  </a>
                </td>
                <td><?= htmlspecialchars($m['designation'] ?? '') ?></td>
                <td><?= htmlspecialchars($m['email'] ?? '') ?></td>
                <td><?= htmlspecialchars($m['phone'] ?? '') ?></td>
                <td>
                  <?php if (($m['status'] ?? '') === 'active'): ?>
                    <span class="badge badge-success">Active</span>
                  <?php else: ?>
                    <span class="badge badge-warning">Inactive</span>
                  <?php endif; ?>
                </td>
                <td><?= (int)($m['order'] ?? 0) ?></td>
                <td style="text-align:right;">
                  <div class="btn-group">
                    <a href="/admin/team/edit/<?= (int)($m['id'] ?? 0) ?>" class="btn btn-navy btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                    <a href="/admin/team/delete/<?= (int)($m['id'] ?? 0) ?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this team member?')"><i class="fas fa-trash"></i></a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8">
                <div class="empty-state">
                  <i class="fas fa-users"></i>
                  <p>No team members found. Add your first member!</p>
                  <a href="/admin/team/create" class="btn btn-gold btn-sm" style="margin-top:12px;"><i class="fas fa-plus"></i> Add New Promoter</a>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
