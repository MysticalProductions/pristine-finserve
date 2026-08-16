<?php
$title = $title ?? 'Contact Us – Pristine Finserve';
$metaDescription = $metaDescription ?? 'Get in touch with Pristine Finserve. Call us, visit our office, or fill the inquiry form for quick assistance on loans and financial services.';
$metaKeywords = $metaKeywords ?? 'contact, financial services, loan inquiry, pristine finserve, Noida, customer support';
$currentPage = 'contact';
ob_start();
?>

<section class="page-hero page-hero-sm">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <span>Contact</span>
    </div>
    <h1 data-aos="fade-up">Get In Touch</h1>
    <p data-aos="fade-up" data-aos-delay="100">We're here to help. Reach out to us anytime for financial assistance.</p>
  </div>
</section>

<?php $flashSuccess = session('flash_success') ?? flash('success') ?? null; ?>
<?php $flashError = session('flash_error') ?? flash('error') ?? null; ?>
<?php if ($flashSuccess || $flashError): ?>
  <?php $flashVal = $flashSuccess ?: $flashError; ?>
  <?php $flashType = $flashSuccess ? 'success' : 'error'; ?>
  <section class="section" style="padding-bottom:0;">
    <div class="container">
      <div style="padding:var(--space-4);border-radius:var(--radius-md);background:<?= $flashSuccess ? 'var(--color-success-light, #d1fae5)' : 'var(--color-error-light, #fee2e2)' ?>;color:<?= $flashSuccess ? 'var(--color-success, #065f46)' : 'var(--color-error, #991b1b)' ?>;border:1px solid <?= $flashSuccess ? 'var(--color-success, #10b981)' : 'var(--color-error, #ef4444)' ?>;">
        <?= htmlspecialchars(is_string($flashVal) ? $flashVal : '') ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<section class="section" id="inquiry">
  <div class="container">
    <div class="contact-grid">
      <div class="contact-form-wrapper" data-aos="fade-right">
        <h3 style="margin-bottom:var(--space-2);">Send Us a Message</h3>
        <p style="color:var(--color-text-muted);margin-bottom:var(--space-6);">Fill the form below and we'll get back to you within 30 minutes.</p>
        <form id="contactForm" action="<?= route('contact/submit') ?>" method="POST">
          <?= csrfField() ?>
          <div class="grid-2-col" style="gap:var(--space-4);">
            <div class="form-group">
              <label>Full Name *</label>
              <input type="text" name="name" class="form-control" placeholder="Your name" required value="<?= htmlspecialchars(old('name')) ?>">
            </div>
            <div class="form-group">
              <label>Phone Number *</label>
              <input type="tel" name="phone" class="form-control" placeholder="Your phone" required value="<?= htmlspecialchars(old('phone')) ?>">
            </div>
          </div>
          <div class="grid-2-col" style="gap:var(--space-4);">
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" placeholder="Your email" value="<?= htmlspecialchars(old('email')) ?>">
            </div>
            <div class="form-group">
              <label>Service Required *</label>
              <select name="subject" class="form-control" required>
                <option value="">Select service</option>
                <?php $selectedSubject = old('subject'); ?>
                <?php $subjects = ['Home Loan', 'Personal Loan', 'Business Loan', 'Education Loan', 'Vehicle Loan', 'Loan Against Property', 'Investment Advisory', 'Insurance', 'Other']; ?>
                <?php foreach ($subjects as $sub): ?>
                  <option value="<?= $sub ?>" <?= $selectedSubject === $sub ? 'selected' : '' ?>><?= $sub ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea name="message" class="form-control" rows="2" placeholder="Tell us about your requirements..." style="resize:vertical;"><?= htmlspecialchars(old('message')) ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-lg" style="width:100%;">
            Submit Inquiry <i class="bi bi-send"></i>
          </button>
        </form>
      </div>

      <div data-aos="fade-left">
        <div class="section-header-left" style="margin-bottom:var(--space-8);">
          <span class="section-label">Contact Info</span>
          <h2 class="section-title">Let's Discuss Your<br>Financial Goals</h2>
        </div>

        <div class="contact-info-grid">
          <div class="contact-card">
            <div class="icon"><i class="bi bi-telephone"></i></div>
            <h6>Phone</h6>
            <p>
              <?= htmlspecialchars(setting('contact_phone', setting('site_phone', '+91 9899360744'))) ?><br>
              <?php if (setting('contact_phone_alt', '') !== ''): ?><?= htmlspecialchars(setting('contact_phone_alt')) ?><?php endif; ?>
            </p>
          </div>
          <div class="contact-card">
            <div class="icon"><i class="bi bi-envelope"></i></div>
            <h6>Email</h6>
            <p>
              <?= htmlspecialchars(setting('contact_email', setting('site_email', 'info@pristinefinserve.com'))) ?><br>
              <?php if (setting('contact_email_alt', '') !== ''): ?><?= htmlspecialchars(setting('contact_email_alt')) ?><?php endif; ?>
            </p>
          </div>
          <div class="contact-card">
            <div class="icon"><i class="bi bi-geo-alt"></i></div>
            <h6>Head Office</h6>
            <p>
              <?= htmlspecialchars(setting('contact_address', setting('site_address', 'RT-89 & 104, Tower C, Urbtech Trade Center, B Block, Sector 132, Noida, Uttar Pradesh-201304'))) ?>
            </p>
          </div>
          <div class="contact-card">
            <div class="icon"><i class="bi bi-clock"></i></div>
            <h6>Working Hours</h6>
            <p>
              <?= htmlspecialchars(setting('contact_hours', setting('working_hours', 'Mon - Sat: 9:30 AM - 7:00 PM'))) ?><br>
              <?= htmlspecialchars(setting('contact_hours_alt', 'Sunday: Closed')) ?>
            </p>
          </div>
        </div>


      </div>
    </div>
  </div>
</section>

<?php $mapsKey = setting('google_maps_api_key', ''); ?>
<section class="section section-light" style="padding:var(--space-12) 0;">
  <div class="container">
    <div class="map-wrapper" data-aos="fade-up">
      <?php if (!empty($mapsKey)): ?>
        <iframe
          src="https://www.google.com/maps/embed/v1/place?key=<?= htmlspecialchars($mapsKey) ?>&q=Urbtech+Trade+Center+Sector+132+Noida&center=28.5170,77.4100&zoom=15"
          allowfullscreen
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          style="width:100%;height:400px;border:0;border-radius:var(--radius-lg);">
        </iframe>
      <?php else: ?>
        <iframe
          src="https://www.google.com/maps?q=Urbtech+Trade+Center,+Sector+132,+Noida,+Uttar+Pradesh+201304&output=embed&z=15"
          allowfullscreen
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          style="width:100%;height:400px;border:0;border-radius:var(--radius-lg);">
        </iframe>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section cta-section">
  <div class="container">
    <div class="cta-content" data-aos="fade-up">
      <span class="section-label" style="color:var(--color-gold);">Need Immediate Help?</span>
      <h2 class="display-2" style="color:var(--color-deep-navy);">Call Us Right Now</h2>
      <p>Our experts are available Monday to Saturday to assist you with your financial needs.</p>
      <div class="cta-actions">
        <a href="tel:<?= htmlspecialchars(setting('contact_phone', setting('site_phone', '+919899360744'))) ?>" class="btn btn-gold btn-lg"><i class="bi bi-telephone"></i> <?= htmlspecialchars(setting('contact_phone', setting('site_phone', '+91 9899360744'))) ?></a>
        <a href="https://wa.me/<?= htmlspecialchars(setting('whatsapp', '919899360744')) ?>" class="btn btn-outline btn-lg" target="_blank"><i class="bi bi-whatsapp"></i> Chat on WhatsApp</a>
      </div>
    </div>
  </div>
</section>

<script>
document.getElementById('contactForm') && document.getElementById('contactForm').addEventListener('submit', function(e) {
  var btn = this.querySelector('button[type="submit"]');
  if (btn) {
    btn.disabled = true;
    if (!btn.getAttribute('data-original-text')) {
      btn.setAttribute('data-original-text', btn.innerHTML);
    }
    btn.innerHTML = 'Submitting... <i class="bi bi-hourglass-split"></i>';
  }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
