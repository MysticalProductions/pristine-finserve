<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Pristine Finserve') ?> — Pristine Finserve</title>
  <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'Pristine Finserve offers expert financial consultancy, home loans, personal loans, business loans, and investment advisory. Trusted by 10,000+ happy customers.') ?>">
  <meta name="keywords" content="<?= htmlspecialchars($metaKeywords ?? 'financial services, loan consultancy, home loan, personal loan, business loan, investment advisory, India') ?>">
  <meta property="og:title" content="<?= htmlspecialchars($title ?? 'Pristine Finserve') ?>">
  <meta property="og:description" content="<?= htmlspecialchars($metaDescription ?? 'Expert financial consultancy and loan services. Get the best rates and personalized solutions.') ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= route('') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <link rel="stylesheet" href="<?= asset('css/header.css') ?>">
  <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32.png">
  <link rel="icon" type="image/png" sizes="64x64" href="/assets/images/favicon-64.png">
  <style>
    .hero { animation: heroFade 0.8s ease 0.2s forwards; }
    @keyframes heroFade { from { opacity: 0; } to { opacity: 1; } }
    .toast-notification {
      position: fixed; top: 20px; right: 20px; z-index: 99999;
      padding: 16px 24px; border-radius: 8px; font-size: 14px; font-weight: 500;
      box-shadow: 0 4px 20px rgba(0,0,0,.15); max-width: 400px;
      animation: slideInRight .3s ease-out;
      cursor: pointer;
    }
    .toast-notification.success { background: #059669; color: #fff; }
    .toast-notification.error { background: #dc2626; color: #fff; }
    .toast-notification.info { background: #2563eb; color: #fff; }
    @keyframes slideInRight {
      from { transform: translateX(100%); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
  </style>
</head>
<body>

  <?php if ($msg = flash('success')): ?>
  <div class="toast-notification success"><?= htmlspecialchars($msg) ?></div>
  <?php elseif ($msg = flash('error')): ?>
  <div class="toast-notification error"><?= htmlspecialchars($msg) ?></div>
  <?php elseif ($msg = flash('info')): ?>
  <div class="toast-notification info"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>

  <nav class="navbar" id="navbar">
    <div class="container">
      <a href="<?= route('') ?>" class="navbar-brand">
        <img src="<?= asset('images/logo.png') ?>" alt="Pristine Finserve">
        <span class="logo-text">Pristine<span>Finserve</span></span>
      </a>

      <div class="nav-menu" id="navMenu">
        <a href="<?= route('') ?>" class="nav-link <?= ($currentPage ?? '') === 'home' ? 'active' : '' ?>">Home</a>

        <div class="nav-dropdown">
          <a href="#" class="nav-link <?= ($currentPage ?? '') === 'about' ? 'active' : '' ?>">About <i class="bi bi-chevron-down"></i></a>
          <div class="nav-dropdown-menu">
            <a href="<?= route('about') ?>" class="nav-dropdown-link"><i class="bi bi-building"></i> About Us</a>
            <a href="<?= route('about') ?>#team" class="nav-dropdown-link"><i class="bi bi-people"></i> Our Promoter</a>
          </div>
        </div>

          <div class="nav-dropdown">
            <a href="#" class="nav-link <?= in_array($currentPage ?? '', ['services', 'service-detail']) ? 'active' : '' ?>">Services <i class="bi bi-chevron-down"></i></a>
            <div class="nav-dropdown-menu">
              <a href="<?= route('services') ?>" class="nav-dropdown-link"><i class="bi bi-grid"></i> All Services</a>
              <?php $navServices = allServices(); ?>
              <?php if (!empty($navServices)): ?>
                <?php foreach ($navServices as $ns): ?>
                  <a href="<?= route('services/' . sanitize($ns->slug)) ?>" class="nav-dropdown-link">
                    <i class="bi bi-arrow-right"></i> <?= htmlspecialchars($ns->title) ?>
                  </a>
                <?php endforeach; ?>
              <?php else: ?>
                <a href="<?= route('services') ?>#consulting" class="nav-dropdown-link"><i class="bi bi-chat-dots"></i> Financial Consulting</a>
                <a href="<?= route('services') ?>#advisory" class="nav-dropdown-link"><i class="bi bi-graph-up-arrow"></i> Investment Advisory</a>
                <a href="<?= route('services') ?>#insurance" class="nav-dropdown-link"><i class="bi bi-shield-check"></i> Insurance Assistance</a>
              <?php endif; ?>
            </div>
          </div>

        <div class="nav-dropdown">
          <a href="#" class="nav-link <?= in_array($currentPage ?? '', ['loans', 'loan-detail']) ? 'active' : '' ?>">Loans <i class="bi bi-chevron-down"></i></a>
          <div class="nav-dropdown-menu">
            <a href="<?= route('loans') ?>" class="nav-dropdown-link"><i class="bi bi-bank"></i> All Loan Products</a>
            <?php if (!empty($loanProducts) && ($currentPage ?? '') === 'home'): ?>
              <?php foreach ($loanProducts as $lp): ?>
                <a href="<?= route('loans/' . sanitize($lp->slug)) ?>" class="nav-dropdown-link"><i class="bi bi-arrow-right"></i> <?= htmlspecialchars($lp->name) ?></a>
              <?php endforeach; ?>
            <?php else: ?>
              <a href="<?= route('loans/home-loan') ?>" class="nav-dropdown-link"><i class="bi bi-house"></i> Home Loan</a>
              <a href="<?= route('loans/personal-loan') ?>" class="nav-dropdown-link"><i class="bi bi-person"></i> Personal Loan</a>
              <a href="<?= route('loans/business-loan') ?>" class="nav-dropdown-link"><i class="bi bi-briefcase"></i> Business Loan</a>
              <a href="<?= route('loans/education-loan') ?>" class="nav-dropdown-link"><i class="bi bi-book"></i> Education Loan</a>
              <a href="<?= route('loans/vehicle-loan') ?>" class="nav-dropdown-link"><i class="bi bi-car-front"></i> Vehicle Loan</a>
              <a href="<?= route('loans/loan-against-property') ?>" class="nav-dropdown-link"><i class="bi bi-building"></i> Loan Against Property</a>
            <?php endif; ?>
          </div>
        </div>

        <a href="<?= route('calculators') ?>" class="nav-link <?= ($currentPage ?? '') === 'calculators' ? 'active' : '' ?>">Calculators</a>
        <a href="<?= route('blog') ?>" class="nav-link <?= ($currentPage ?? '') === 'blog' ? 'active' : '' ?>">Blog</a>
        <a href="<?= route('partners') ?>" class="nav-link <?= ($currentPage ?? '') === 'partners' ? 'active' : '' ?>">Partners</a>
        <a href="<?= route('testimonials') ?>" class="nav-link <?= ($currentPage ?? '') === 'testimonials' ? 'active' : '' ?>">Testimonials</a>
        <a href="<?= route('contact') ?>" class="nav-link <?= ($currentPage ?? '') === 'contact' ? 'active' : '' ?>">Contact</a>

        <div class="nav-cta">
          <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-sm">Get Started</a>
        </div>
      </div>

      <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </nav>

  <main>
    <?= $content ?? '' ?>
  </main>

  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <h4>Pristine<span>Finserve</span></h4>
          <p>Your trusted partner in financial solutions. With 15+ years of expertise and 50+ banking partnerships, we deliver the best financial outcomes for individuals and businesses.</p>
          <div class="footer-social">
            <?php $fb = setting('facebook_url'); if ($fb): ?><a href="<?= htmlspecialchars($fb) ?>" aria-label="Facebook"><i class="bi bi-facebook"></i></a><?php endif; ?>
            <?php $tw = setting('twitter_url'); if ($tw): ?><a href="<?= htmlspecialchars($tw) ?>" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a><?php endif; ?>
            <?php $li = setting('linkedin_url'); if ($li): ?><a href="<?= htmlspecialchars($li) ?>" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a><?php endif; ?>
            <?php $ig = setting('instagram_url'); if ($ig): ?><a href="<?= htmlspecialchars($ig) ?>" aria-label="Instagram"><i class="bi bi-instagram"></i></a><?php endif; ?>
            <?php $yt = setting('youtube_url'); if ($yt): ?><a href="<?= htmlspecialchars($yt) ?>" aria-label="YouTube"><i class="bi bi-youtube"></i></a><?php endif; ?>
          </div>
        </div>

        <div>
          <h5>Quick Links</h5>
          <ul class="footer-links">
            <li><a href="<?= route('') ?>">Home</a></li>
            <li><a href="<?= route('about') ?>">About Us</a></li>
            <li><a href="<?= route('services') ?>">Services</a></li>
            <li><a href="<?= route('loans') ?>">Loan Products</a></li>
            <li><a href="<?= route('calculators') ?>">Calculators</a></li>
            <li><a href="<?= route('blog') ?>">Blog</a></li>
            <li><a href="<?= route('contact') ?>">Contact</a></li>
          </ul>
        </div>

        <div>
          <h5>Loan Products</h5>
          <ul class="footer-links">
            <li><a href="<?= route('loans/home-loan') ?>">Home Loan</a></li>
            <li><a href="<?= route('loans/personal-loan') ?>">Personal Loan</a></li>
            <li><a href="<?= route('loans/business-loan') ?>">Business Loan</a></li>
            <li><a href="<?= route('loans/education-loan') ?>">Education Loan</a></li>
            <li><a href="<?= route('loans/vehicle-loan') ?>">Vehicle Loan</a></li>
            <li><a href="<?= route('loans/loan-against-property') ?>">Loan Against Property</a></li>
          </ul>
        </div>

        <div>
          <h5>Contact Info</h5>
          <ul class="footer-contact">
            <li>
              <i class="bi bi-geo-alt"></i>
              <?= htmlspecialchars(setting('address', 'RT-89 & 104, Tower C, Urbtech Trade Center, B Block, Sector 132, Noida, Uttar Pradesh-201304')) ?>
            </li>
            <li>
              <i class="bi bi-telephone"></i>
              <a href="tel:<?= htmlspecialchars(setting('phone', '+919899360744')) ?>"><?= htmlspecialchars(setting('phone', '+91 9899360744')) ?></a>
            </li>
            <li>
              <i class="bi bi-envelope"></i>
              <a href="mailto:<?= htmlspecialchars(setting('email', 'info@pristinefinserve.com')) ?>"><?= htmlspecialchars(setting('email', 'info@pristinefinserve.com')) ?></a>
            </li>
            <li>
              <i class="bi bi-clock"></i>
              <?= htmlspecialchars(setting('working_hours', 'Mon - Sat: 9:30 AM - 7:00 PM')) ?>
            </li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> Pristine Finserve. All rights reserved.</p>
        <div class="footer-bottom-links">
          <a href="<?= route('privacy-policy') ?>">Privacy Policy</a>
          <a href="<?= route('terms-of-service') ?>">Terms of Service</a>
          <a href="<?= route('disclaimer') ?>">Disclaimer</a>
          <a href="<?= route('sitemap') ?>">Sitemap</a>
          <a href="/admin/login">Admin</a>
        </div>
      </div>
    </div>
  </footer>

  <?php $whatsapp = setting('whatsapp', '919899360744'); ?>
  <a href="https://wa.me/<?= htmlspecialchars($whatsapp) ?>" class="whatsapp-float" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>

  <button class="back-to-top" id="backToTop" aria-label="Back to top">
    <i class="bi bi-chevron-up"></i>
  </button>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="<?= asset('js/main.js') ?>"></script>
  <script>
    AOS.init({
      duration: 600,
      once: true,
      offset: 100,
      easing: 'ease-out-cubic'
    });
  </script>
  <script>
    (function() {
      var toast = document.querySelector('.toast-notification');
      if (toast) {
        setTimeout(function() {
          toast.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
          toast.style.opacity = '0';
          toast.style.transform = 'translateX(100%)';
          setTimeout(function() { toast.remove(); }, 300);
        }, 4000);
        toast.addEventListener('click', function() { toast.remove(); });
      }
    })();
  </script>
</body>
</html>
