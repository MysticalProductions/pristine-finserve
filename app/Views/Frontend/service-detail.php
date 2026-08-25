<?php
$title = $title ?? ($service->title ?? $service->name ?? 'Service') . ' – Pristine Finserve';
$metaDescription = $metaDescription ?? ($service->meta_description ?? truncate(strip_tags($service->short_description ?? $service->description ?? ''), 160));
$metaKeywords = $metaKeywords ?? ($service->meta_keywords ?? '');
$currentPage = 'service-detail';
ob_start();

$features = is_string($service->features ?? '') ? (json_decode($service->features, true) ?? explode("\n", str_replace("\r", "", $service->features))) : ($service->features ?? []);
$process = is_string($service->process ?? '') ? (json_decode($service->process, true) ?? explode("\n", str_replace("\r", "", $service->process))) : ($service->process ?? []);
$benefits = is_string($service->benefits ?? '') ? (json_decode($service->benefits, true) ?? explode("\n", str_replace("\r", "", $service->benefits))) : ($service->benefits ?? []);
$faqs = is_string($service->faq ?? '') ? (json_decode($service->faq, true) ?? explode("\n", str_replace("\r", "", $service->faq))) : ($service->faq ?? []);
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <a href="<?= route('services') ?>">Services</a>
      <span class="sep">/</span>
      <span><?= htmlspecialchars($service->title ?? $service->name ?? '') ?></span>
    </div>
    <h1 data-aos="fade-up"><?= htmlspecialchars($service->title ?? $service->name ?? '') ?></h1>
    <p data-aos="fade-up" data-aos-delay="100"><?= htmlspecialchars($service->short_description ?? $service->description ?? '') ?></p>
    <?php if (!empty($service->featured_image)): ?>
      <div style="margin-top:var(--space-6);border-radius:var(--radius-xl);overflow:hidden;" data-aos="fade-up" data-aos-delay="200">
        <img src="<?= uploadUrl($service->featured_image) ?>" alt="<?= htmlspecialchars($service->title ?? '') ?>" style="width:100%;max-height:400px;object-fit:cover;display:block;">
      </div>
    <?php endif; ?>
  </div>
</section>

<?php if (!empty($features) && is_array($features)): ?>
<section class="section">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Key Features</span>
      <h2 class="section-title">What We Offer</h2>
    </div>
    <div class="grid-3-col" style="gap:var(--space-6);">
      <?php foreach ($features as $i => $feature): ?>
        <?php $fTitle = is_string($feature) ? $feature : ($feature->title ?? $feature['title'] ?? ''); ?>
        <?php $fDesc = is_string($feature) ? '' : ($feature->description ?? $feature['description'] ?? ''); ?>
        <div class="card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>" style="text-align:center;padding:var(--space-8);">
          <div class="card-icon <?= ['blue', 'gold', 'green', 'purple', 'red'][$i % 5] ?>" style="margin:0 auto var(--space-4);">
            <i class="bi bi-<?= htmlspecialchars(is_string($feature) ? 'check-circle' : ($feature->icon ?? $feature['icon'] ?? 'check-circle')) ?>"></i>
          </div>
          <h5><?= htmlspecialchars($fTitle) ?></h5>
          <?php if ($fDesc): ?>
            <p style="margin-bottom:0;"><?= htmlspecialchars($fDesc) ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($process) && is_array($process)): ?>
<section class="section section-light">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Our Process</span>
      <h2 class="section-title">How It Works</h2>
    </div>
    <div class="process-steps">
      <?php foreach ($process as $i => $step): ?>
        <?php $sTitle = is_string($step) ? $step : ($step->title ?? $step['title'] ?? 'Step'); ?>
        <?php $sDesc = is_string($step) ? '' : ($step->description ?? $step['description'] ?? ''); ?>
        <div class="process-step" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
          <div class="step-number"><?= $i + 1 ?></div>
          <h6><?= htmlspecialchars($sTitle) ?></h6>
          <?php if ($sDesc): ?><p><?= htmlspecialchars($sDesc) ?></p><?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($benefits) && is_array($benefits)): ?>
<section class="section">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Benefits</span>
      <h2 class="section-title">Why Choose This Service</h2>
    </div>
    <div class="grid-2-col" style="gap:var(--space-6);">
      <?php foreach ($benefits as $i => $benefit): ?>
        <?php $bTitle = is_string($benefit) ? $benefit : ($benefit->title ?? $benefit['title'] ?? ''); ?>
        <?php $bDesc = is_string($benefit) ? '' : ($benefit->description ?? $benefit['description'] ?? ''); ?>
        <div class="why-item" data-aos="fade-up" data-aos-delay="<?= ($i % 2) * 50 ?>">
          <div class="why-icon"><i class="bi bi-check-circle-fill" style="color:var(--color-success);"></i></div>
          <div class="why-content">
            <h5><?= htmlspecialchars($bTitle) ?></h5>
            <?php if ($bDesc): ?><p><?= htmlspecialchars($bDesc) ?></p><?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($faqs) && is_array($faqs)): ?>
<section class="section section-light">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">FAQ</span>
      <h2 class="section-title">Frequently Asked Questions</h2>
    </div>
    <div style="max-width:800px;margin:0 auto;">
      <?php foreach ($faqs as $i => $faq): ?>
        <?php $q = is_string($faq) ? $faq : ($faq->question ?? $faq['question'] ?? $faq->q ?? $faq['q'] ?? ''); ?>
        <?php $a = is_string($faq) ? '' : ($faq->answer ?? $faq['answer'] ?? $faq->a ?? $faq['a'] ?? ''); ?>
        <div class="faq-item" data-aos="fade-up" data-aos-delay="<?= $i * 50 ?>">
          <div class="faq-question" onclick="this.parentElement.classList.toggle('active')">
            <span><?= htmlspecialchars($q) ?></span>
            <i class="bi bi-chevron-down"></i>
          </div>
          <?php if ($a): ?>
            <div class="faq-answer"><p><?= htmlspecialchars($a) ?></p></div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="section cta-section">
  <div class="container">
    <div class="cta-content" data-aos="fade-up">
      <span class="section-label" style="color:var(--color-gold);">Ready to Get Started?</span>
      <h2 class="display-2" style="color:var(--color-deep-navy);">Get Expert Guidance Today</h2>
      <p>Let our team help you find the perfect financial solution.</p>
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
