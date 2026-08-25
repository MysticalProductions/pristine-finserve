<?php
$title = $title ?? 'Financial Services – Pristine Finserve';
$metaDescription = $metaDescription ?? 'Comprehensive financial services including home loans, personal loans, business loans, investment advisory, insurance, and credit consulting.';
$metaKeywords = $metaKeywords ?? 'financial services, home loan, personal loan, business loan, investment advisory, insurance';
$currentPage = 'services';
ob_start();
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <span>Services</span>
    </div>
    <h1 data-aos="fade-up">Our Financial Services</h1>
    <p data-aos="fade-up" data-aos-delay="100">End-to-end financial solutions tailored to your personal and business needs.</p>
  </div>
</section>

<section class="section" id="consulting">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">What We Offer</span>
      <h2 class="section-title">Complete Financial Solutions</h2>
      <p class="section-subtitle" style="margin:0 auto;">From consultation to disbursal, we handle everything.</p>
    </div>

    <div class="services-grid">
      <?php if (!empty($services)): ?>
        <?php foreach ($services as $i => $service): ?>
          <?php $iconColors = ['blue', 'green', 'gold', 'purple', 'red', 'blue', 'gold', 'green', 'purple']; ?>
          <?php if (!empty($service->featured_image)): ?>
          <div class="card service-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>" style="padding:0;overflow:hidden;">
            <img src="<?= uploadUrl($service->featured_image) ?>" alt="<?= htmlspecialchars($service->title ?? '') ?>" style="width:100%;height:180px;object-fit:cover;display:block;">
            <div style="padding:var(--space-6);">
              <h4><?= htmlspecialchars($service->title ?? $service->name ?? '') ?></h4>
              <p><?= htmlspecialchars(truncate($service->short_description ?? $service->description ?? '', 150)) ?></p>
              <a href="<?= route('services/' . sanitize($service->slug ?? '')) ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <?php else: ?>
          <div class="card service-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>">
            <div class="card-icon <?= $iconColors[$i % count($iconColors)] ?>"><i class="bi bi-<?= htmlspecialchars($service->icon ?? 'house') ?>"></i></div>
            <h4><?= htmlspecialchars($service->title ?? $service->name ?? '') ?></h4>
            <p><?= htmlspecialchars(truncate($service->short_description ?? $service->description ?? '', 150)) ?></p>
            <a href="<?= route('services/' . sanitize($service->slug ?? '')) ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
          </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="card service-card" data-aos="fade-up">
          <div class="card-icon blue"><i class="bi bi-house"></i></div>
          <h4>Home Loans</h4>
          <p>Purchase, construction, or renovation loans with attractive rates starting 8.40% p.a. Up to ₹10 Cr sanction.</p>
          <a href="<?= route('services/home-loan') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up" data-aos-delay="100">
          <div class="card-icon green"><i class="bi bi-person"></i></div>
          <h4>Personal Loans</h4>
          <p>Instant unsecured loans up to ₹25 Lakhs with minimal documentation and 24-hour disbursal.</p>
          <a href="<?= route('services/personal-loan') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up" data-aos-delay="200">
          <div class="card-icon gold"><i class="bi bi-briefcase"></i></div>
          <h4>Business Loans</h4>
          <p>Working capital, expansion, and equipment financing up to ₹50 Cr with flexible repayment.</p>
          <a href="<?= route('services/business-loan') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up">
          <div class="card-icon purple"><i class="bi bi-book"></i></div>
          <h4>Education Loans</h4>
          <p>Fund your education dreams with loans up to ₹1 Cr and flexible repayment after course completion.</p>
          <a href="<?= route('services/education-loan') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up" data-aos-delay="100">
          <div class="card-icon red"><i class="bi bi-car-front"></i></div>
          <h4>Vehicle Loans</h4>
          <p>New and used car loans, two-wheeler loans with quick approval and competitive interest rates.</p>
          <a href="<?= route('services/vehicle-loan') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up" data-aos-delay="200">
          <div class="card-icon blue"><i class="bi bi-building"></i></div>
          <h4>Loan Against Property</h4>
          <p>Unlock your property's value with loans up to ₹10 Cr at attractive interest rates.</p>
          <a href="<?= route('services/loan-against-property') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up">
          <div class="card-icon gold"><i class="bi bi-graph-up-arrow"></i></div>
          <h4 id="advisory">Investment Advisory</h4>
          <p>Expert portfolio management, mutual funds, stocks, and wealth planning for long-term growth.</p>
          <a href="<?= route('contact') ?>" class="card-link">Get Advice <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up" data-aos-delay="100">
          <div class="card-icon green"><i class="bi bi-shield-check"></i></div>
          <h4 id="insurance">Insurance Assistance</h4>
          <p>Life, health, motor, and business insurance plans from top providers to protect what matters.</p>
          <a href="<?= route('contact') ?>" class="card-link">Get Covered <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up" data-aos-delay="200">
          <div class="card-icon purple"><i class="bi bi-credit-card"></i></div>
          <h4>Credit Advisory</h4>
          <p>Credit score improvement, debt consolidation, and financial restructuring for better financial health.</p>
          <a href="<?= route('contact') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section section-light">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">How It Works</span>
      <h2 class="section-title">Simple 4-Step Process</h2>
    </div>
    <div class="process-steps">
      <div class="process-step" data-aos="fade-up">
        <div class="step-number">1</div>
        <h6>Submit Inquiry</h6>
        <p>Fill our quick form with your requirements. Takes just 2 minutes.</p>
      </div>
      <div class="process-step" data-aos="fade-up" data-aos-delay="100">
        <div class="step-number">2</div>
        <h6>Get Expert Callback</h6>
        <p>Our advisor contacts you within 30 minutes to understand your needs.</p>
      </div>
      <div class="process-step" data-aos="fade-up" data-aos-delay="200">
        <div class="step-number">3</div>
        <h6>Documentation</h6>
        <p>Upload basic documents. We handle the rest of the paperwork.</p>
      </div>
      <div class="process-step" data-aos="fade-up" data-aos-delay="300">
        <div class="step-number">4</div>
        <h6>Approval & Disbursal</h6>
        <p>Loan approved and disbursed to your account. Quick and hassle-free.</p>
      </div>
    </div>
  </div>
</section>

<section class="section cta-section">
  <div class="container">
    <div class="cta-content" data-aos="fade-up">
      <span class="section-label" style="color:var(--color-gold);">Need Help?</span>
      <h2 class="display-2" style="color:var(--color-deep-navy);">Not Sure Which Service?<br>We'll Guide You</h2>
      <p>Our experts will analyze your requirements and recommend the best solution.</p>
      <div class="cta-actions">
        <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-lg">Get Free Consultation <i class="bi bi-arrow-right"></i></a>
        <a href="tel:<?= htmlspecialchars(setting('phone', '+919899360744')) ?>" class="btn btn-outline btn-lg"><i class="bi bi-telephone"></i> Call Now</a>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
