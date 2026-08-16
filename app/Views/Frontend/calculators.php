<?php
$title = $title ?? 'Financial Calculators – Pristine Finserve';
$metaDescription = $metaDescription ?? 'Use our interactive financial calculators: EMI Calculator, Home Loan Calculator, SIP Calculator, Eligibility Calculator, and more.';
$metaKeywords = $metaKeywords ?? 'financial calculators, emi calculator, sip calculator, loan eligibility, home loan calculator, India';
$currentPage = 'calculators';
ob_start();
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <span>Calculators</span>
    </div>
    <h1 data-aos="fade-up">Financial Calculators</h1>
    <p data-aos="fade-up" data-aos-delay="100">Plan your finances with our interactive calculators and make informed decisions.</p>
  </div>
</section>

<section class="section section-light">
  <div class="container">
    <?php if (!empty($calculators)): ?>
      <div class="calculator-grid">
        <?php foreach ($calculators as $i => $calc): ?>
          <?php
          $delay = ($i % 3) * 100;
          $icons = ['📊', '🏠', '📈', '✅', '💰', '📊'];
          $calcTitle = strtolower($calc->title ?? $calc->name ?? '');
          $calcSlug = strtolower($calc->type ?? $calc->slug ?? '');
          $iconByTitle = [
              'car' => '🚗',
              'home' => '🏠',
              'personal' => '💳',
              'emi vs sip' => '⚖️',
              'sip' => '📈',
              'lumpsum' => '💰',
              'affordability' => '✅',
          ];
          $calcIcon = $calc->icon ?? null;
          foreach ($iconByTitle as $key => $icon) {
              if (str_contains($calcTitle, $key) || str_contains($calcSlug, $key)) {
                  $calcIcon = $icon;
                  break;
              }
          }
          $calcIcon = $calcIcon ?? ($icons[$i % count($icons)] ?? '📊');
          $calcSlug = $calc->type ?? $calc->slug ?? '';
          ?>
          <a href="<?= route('calculators/' . sanitize($calcSlug)) ?>" class="calc-card" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
            <div class="icon"><?= sanitize($calcIcon) ?></div>
            <h5><?= htmlspecialchars($calc->title ?? $calc->name ?? '') ?></h5>
            <p><?= htmlspecialchars($calc->description ?? $calc->short_description ?? '') ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="calculator-grid">
        <a href="<?= route('calculators/emi') ?>" class="calc-card active" data-aos="fade-up">
          <div class="icon">📊</div>
          <h5>EMI Calculator</h5>
          <p>Calculate monthly installments</p>
        </a>
        <a href="<?= route('calculators/home-loan') ?>" class="calc-card" data-aos="fade-up" data-aos-delay="100">
          <div class="icon">🏠</div>
          <h5>Home Loan Calculator</h5>
          <p>Plan your dream home budget</p>
        </a>
        <a href="<?= route('calculators/sip') ?>" class="calc-card" data-aos="fade-up" data-aos-delay="200">
          <div class="icon">📈</div>
          <h5>SIP Calculator</h5>
          <p>Estimate investment returns</p>
        </a>
        <a href="<?= route('calculators/eligibility') ?>" class="calc-card" data-aos="fade-up">
          <div class="icon">✅</div>
          <h5>Affordability/Eligibility Calculator</h5>
          <p>Check your loan eligibility</p>
        </a>
        <a href="<?= route('calculators/interest') ?>" class="calc-card" data-aos="fade-up" data-aos-delay="100">
          <div class="icon">💰</div>
          <h5>Interest Calculator</h5>
          <p>Compare interest scenarios</p>
        </a>
        <a href="<?= route('calculators/lumpsum') ?>" class="calc-card" data-aos="fade-up" data-aos-delay="200">
          <div class="icon">📊</div>
          <h5>Returns Calculator</h5>
          <p>Project investment growth</p>
        </a>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="section cta-section">
  <div class="container">
    <div class="cta-content" data-aos="fade-up">
      <span class="section-label" style="color:var(--color-gold);">Ready to Apply?</span>
      <h2 class="display-2">Get the Best Rates Today</h2>
      <p>Use our calculators to plan your finances, then apply with confidence.</p>
      <div class="cta-actions">
        <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-lg">Apply Now <i class="bi bi-arrow-right"></i></a>
        <a href="tel:<?= htmlspecialchars(setting('phone', '+919899360744')) ?>" class="btn btn-outline btn-lg"><i class="bi bi-telephone"></i> Call Now</a>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
