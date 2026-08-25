<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Dashboard') ?> — Pristine Finserve</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32.png">
  <link rel="icon" type="image/png" sizes="64x64" href="/assets/images/favicon-64.png">
  <style>:root{--navy:#0A1F44;--navy-light:#152d5e;--gold:#D4A843;--gold-dark:#c49632;--white:#FFFFFF;--off-white:#F8FAFC;--light-gray:#F1F5F9;--border:#E2E8F0;--text-primary:#0F172A;--text-secondary:#475569;--text-muted:#94A3B8;--success:#10B981;--warning:#F59E0B;--error:#EF4444;--info:#3B82F6;--sidebar-width:260px;--sidebar-collapsed:0px;--header-height:64px;--radius:8px;--font:'Nunito',-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;--shadow:0 1px 3px rgba(0,0,0,0.06),0 1px 2px rgba(0,0,0,0.06);--shadow-lg:0 10px 15px -3px rgba(0,0,0,0.08),0 4px 6px -4px rgba(0,0,0,0.05)}</style>
</head>
<body>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <img src="<?= asset('images/logo.png') ?>" alt="Pristine Finserve" style="height:36px;width:auto;">
      <span class="logo-text">Pristine<span>Finserve</span></span>
      <button class="collapse-btn" id="sidebarClose" aria-label="Close sidebar">&times;</button>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-label">Main</div>
      <a href="/admin/dashboard" class="<?= ($activeMenu ?? '') === 'dashboard' ? 'active' : '' ?>">
        <i class="fas fa-tachometer-alt"></i> Dashboard
      </a>

      <div class="nav-label">Content</div>
      <a href="/admin/pages" class="<?= ($activeMenu ?? '') === 'pages' ? 'active' : '' ?>">
        <i class="fas fa-file"></i> Pages
      </a>
      <a href="/admin/services" class="<?= ($activeMenu ?? '') === 'services' ? 'active' : '' ?>">
        <i class="fas fa-concierge-biscuit"></i> Services
      </a>
      <a href="/admin/loans" class="<?= ($activeMenu ?? '') === 'loans' ? 'active' : '' ?>">
        <i class="fas fa-hand-holding-usd"></i> Loans
      </a>
      <a href="/admin/calculators" class="<?= ($activeMenu ?? '') === 'calculators' ? 'active' : '' ?>">
        <i class="fas fa-calculator"></i> Calculators
      </a>
      <a href="/admin/blog" class="<?= ($activeMenu ?? '') === 'blog' ? 'active' : '' ?>">
        <i class="fas fa-newspaper"></i> Blog
      </a>
      <a href="/admin/testimonials" class="<?= ($activeMenu ?? '') === 'testimonials' ? 'active' : '' ?>">
        <i class="fas fa-star"></i> Testimonials
      </a>
      <a href="/admin/partners" class="<?= ($activeMenu ?? '') === 'partners' ? 'active' : '' ?>">
        <i class="fas fa-handshake"></i> Partners
      </a>
      <a href="/admin/gallery" class="<?= ($activeMenu ?? '') === 'gallery' ? 'active' : '' ?>">
        <i class="fas fa-images"></i> Gallery
      </a>
      <a href="/admin/team" class="<?= ($activeMenu ?? '') === 'team' ? 'active' : '' ?>">
        <i class="fas fa-users"></i> Promoter
      </a>

      <div class="nav-label">Leads</div>
      <a href="/admin/leads" class="<?= ($activeMenu ?? '') === 'leads' ? 'active' : '' ?>">
        <i class="fas fa-user-clock"></i> Leads
      </a>

      <div class="nav-label">Media</div>
      <a href="/admin/media" class="<?= ($activeMenu ?? '') === 'media' ? 'active' : '' ?>">
        <i class="fas fa-photo-video"></i> Media Library
      </a>

      <div class="nav-label">Home Page</div>
      <a href="/admin/statistics" class="<?= ($activeMenu ?? '') === 'statistics' ? 'active' : '' ?>">
        <i class="fas fa-chart-bar"></i> Statistics
      </a>
      <div class="nav-label">System</div>
      <a href="/admin/settings" class="<?= ($activeMenu ?? '') === 'settings' ? 'active' : '' ?>">
        <i class="fas fa-cog"></i> Settings
      </a>
      <a href="/admin/seo" class="<?= ($activeMenu ?? '') === 'seo' ? 'active' : '' ?>">
        <i class="fas fa-search"></i> SEO
      </a>
      <a href="/admin/users" class="<?= ($activeMenu ?? '') === 'users' ? 'active' : '' ?>">
        <i class="fas fa-user-shield"></i> Users
      </a>
      <a href="/admin/activity-logs" class="<?= ($activeMenu ?? '') === 'activity-logs' ? 'active' : '' ?>">
        <i class="fas fa-history"></i> Activity Logs
      </a>
      <a href="/admin/notifications" class="<?= ($activeMenu ?? '') === 'notifications' ? 'active' : '' ?>">
        <i class="fas fa-bell"></i> Notifications
        <?php if (!empty($unreadNotifications) && $unreadNotifications > 0): ?>
          <span class="badge"><?= (int)$unreadNotifications ?></span>
        <?php endif; ?>
      </a>
    </nav>
    <div class="sidebar-footer">
      <div class="user-toggle" id="sidebarUserToggle">
        <div class="user-avatar"><?= strtoupper(substr($currentUser['name'] ?? 'A', 0, 2)) ?></div>
        <div>
          <div class="user-name"><?= htmlspecialchars($currentUser['name'] ?? 'Admin') ?></div>
          <div class="user-role"><?= htmlspecialchars($currentUser['role'] ?? 'Administrator') ?></div>
        </div>
      </div>
      <div class="user-menu" id="sidebarUserMenu">
        <a href="/admin/profile"><i class="fas fa-user-circle"></i> Profile</a>
        <a href="/admin/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
    </div>
  </aside>

  <!-- Main Wrapper -->
  <div class="main-wrapper">
    <!-- Header -->
    <header class="header">
      <div class="header-left">
        <button class="hamburger" id="sidebarToggle" aria-label="Toggle sidebar">
          <i class="fas fa-bars"></i>
        </button>
        <h1 class="page-title"><?= htmlspecialchars($title ?? 'Dashboard') ?></h1>
      </div>
      <div class="header-right">
        <a href="/admin/notifications" class="notif-btn">
          <i class="fas fa-bell"></i>
          <?php if (!empty($unreadNotifications) && $unreadNotifications > 0): ?>
            <span class="badge"><?= (int)$unreadNotifications ?></span>
          <?php endif; ?>
        </a>
        <div class="header-user" id="headerUserToggle">
          <div class="avatar"><?= strtoupper(substr($currentUser['name'] ?? 'A', 0, 1)) ?></div>
          <span class="name"><?= htmlspecialchars($currentUser['name'] ?? 'Admin') ?></span>
          <i class="fas fa-chevron-down" style="font-size:0.7rem;color:var(--text-muted);"></i>
          <div class="header-user-dropdown" id="headerUserDropdown">
            <a href="/admin/profile"><i class="fas fa-user-circle"></i> Profile</a>
            <div class="divider"></div>
            <a href="/admin/logout" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Content -->
    <main class="content">
      <?php if ($flash = flash('success')): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($flash) ?></div>
      <?php endif; ?>
      <?php if ($flash = flash('error')): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($flash) ?></div>
      <?php endif; ?>
      <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="admin-footer">
      &copy; 2025 Pristine Finserve. All rights reserved.
    </footer>
  </div>

  <script>
    // Sidebar Toggle
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
      sidebar.classList.add('open');
    }
    function closeSidebar() {
      sidebar.classList.remove('open');
    }

    if (sidebarToggle) sidebarToggle.addEventListener('click', openSidebar);
    if (sidebarClose) sidebarClose.addEventListener('click', closeSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

    // Header user dropdown
    const headerUserToggle = document.getElementById('headerUserToggle');
    const headerUserDropdown = document.getElementById('headerUserDropdown');
    if (headerUserToggle && headerUserDropdown) {
      headerUserToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        headerUserDropdown.classList.toggle('open');
      });
      document.addEventListener('click', function() {
        headerUserDropdown.classList.remove('open');
      });
    }

    // Sidebar user dropdown
    const sidebarUserToggle = document.getElementById('sidebarUserToggle');
    const sidebarUserMenu = document.getElementById('sidebarUserMenu');
    if (sidebarUserToggle && sidebarUserMenu) {
      sidebarUserToggle.addEventListener('click', function() {
        sidebarUserMenu.classList.toggle('open');
      });
    }

    // Auto-generate slug from title
    function generateSlug(text) {
      return text.toLowerCase()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_]+/g, '-')
        .replace(/^-+|-+$/g, '');
    }

    document.addEventListener('input', function(e) {
      if (e.target.dataset.slugSource && e.target.dataset.slugTarget) {
        const target = document.querySelector(e.target.dataset.slugTarget);
        if (target && !target.dataset.slugManuallyEdited) {
          target.value = generateSlug(e.target.value);
        }
      }
    });
    document.addEventListener('focus', function(e) {
      if (e.target.dataset.slugTarget) {
        e.target.dataset.slugManuallyEdited = '1';
      }
    });
  </script>
</body>
</html>
