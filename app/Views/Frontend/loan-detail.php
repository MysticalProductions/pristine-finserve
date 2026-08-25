<?php
$title = $title ?? ($loanProduct->name ?? 'Loan') . ' – Pristine Finserve';
$metaDescription = $metaDescription ?? ($loanProduct->meta_description ?? truncate(strip_tags($loanProduct->short_description ?? $loanProduct->description ?? ''), 160));
$metaKeywords = $metaKeywords ?? ($loanProduct->meta_keywords ?? '');
$currentPage = 'loan-detail';
ob_start();

$features = is_string($loanProduct->features ?? '') ? json_decode($loanProduct->features, true) : ($loanProduct->features ?? []);
$eligibility = is_string($loanProduct->eligibility ?? '') ? json_decode($loanProduct->eligibility, true) : ($loanProduct->eligibility ?? []);
$documents = is_string($loanProduct->documents ?? '') ? json_decode($loanProduct->documents, true) : ($loanProduct->documents ?? []);
$process = is_string($loanProduct->process ?? '') ? json_decode($loanProduct->process, true) : ($loanProduct->process ?? []);
$faqs = is_string($loanProduct->faq ?? '') ? json_decode($loanProduct->faq, true) : ($loanProduct->faq ?? []);
$rates = is_string($loanProduct->rates ?? '') ? json_decode($loanProduct->rates, true) : ($loanProduct->rates ?? []);
?>

<section class="page-hero" style="padding-bottom:calc(var(--space-20) + var(--space-8));">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <a href="<?= route('loans') ?>">Loans</a>
      <span class="sep">/</span>
      <span><?= htmlspecialchars($loanProduct->name ?? '') ?></span>
    </div>
    <div class="loan-intro-grid" style="margin-top:var(--space-12);">
      <div data-aos="fade-right">
        <span class="section-label"><?= htmlspecialchars($loanProduct->name ?? '') ?></span>
        <h2 class="section-title" style="color:var(--color-deep-navy);"><?= htmlspecialchars($loanProduct->name ?? '') ?></h2>
        <?php if (!empty($loanProduct->min_rate)):
          $detailRate = $loanProduct->min_rate . '%';
          if (!empty($loanProduct->max_rate) && $loanProduct->max_rate != $loanProduct->min_rate) {
            $detailRate = $loanProduct->min_rate . '% - ' . $loanProduct->max_rate . '%';
          }
        ?>
          <div class="loan-rate-display">
            <span class="rate-value"><?= htmlspecialchars($detailRate) ?></span>
            <span class="rate-unit" style="color:var(--color-text-muted);">p.a.</span>
          </div>
        <?php endif; ?>
        <?php if (!empty($loanProduct->featured_image)): ?>
          <div style="margin-bottom:var(--space-4);border-radius:var(--radius-lg);overflow:hidden;">
            <img src="<?= uploadUrl($loanProduct->featured_image) ?>" alt="<?= htmlspecialchars($loanProduct->name ?? '') ?>" style="width:100%;max-height:220px;object-fit:cover;display:block;">
          </div>
        <?php endif; ?>
        <p style="margin-bottom:var(--space-6);color:var(--color-text-secondary);"><?= htmlspecialchars($loanProduct->short_description ?? $loanProduct->description ?? '') ?></p>
        <div style="display:flex;gap:var(--space-4);flex-wrap:wrap;">
          <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-lg">Apply Now <i class="bi bi-arrow-right"></i></a>
          <?php if (!empty($loanProduct->brochure)): ?>
            <a href="<?= uploadUrl($loanProduct->brochure) ?>" class="btn btn-outline btn-lg" download><i class="bi bi-download"></i> Download Brochure</a>
          <?php endif; ?>
        </div>
      </div>
      <div class="hero-form-card" data-aos="fade-left">
        <h4>Quick Inquiry</h4>
        <p>Get a callback within 30 minutes</p>
        <form action="<?= route('lead/submit') ?>" method="POST">
          <?= csrfField() ?>
          <input type="hidden" name="loan_type" value="<?= htmlspecialchars($loanProduct->name ?? '') ?>">
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control dark-input" placeholder="Enter your name" required>
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" name="phone" class="form-control dark-input" placeholder="Enter your phone" required>
          </div>
          <div class="form-group">
            <label>Loan Amount (₹)</label>
            <input type="number" name="amount" class="form-control dark-input" placeholder="Enter amount" required>
          </div>
          <button type="submit" class="btn btn-gold btn-lg" style="width:100%;">
            Get Expert Callback <i class="bi bi-telephone"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php if (!empty($features) && is_array($features)): ?>
<section class="section section-light">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Features</span>
      <h2 class="section-title">Why Choose This Loan</h2>
    </div>
    <div class="loan-features-grid">
      <?php foreach ($features as $i => $feature): ?>
        <?php $fTitle = is_string($feature) ? $feature : ($feature->title ?? $feature['title'] ?? ''); ?>
        <?php $fDesc = is_string($feature) ? '' : ($feature->description ?? $feature['description'] ?? ''); ?>
        <div class="card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>">
          <div class="card-icon <?= ['blue', 'gold', 'green', 'purple', 'red'][$i % 5] ?>">
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

<?php if (!empty($eligibility) && is_array($eligibility)): ?>
<section class="section">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Eligibility</span>
      <h2 class="section-title">Eligibility Criteria</h2>
    </div>
    <div style="overflow-x:auto;" data-aos="fade-up">
      <table class="eligibility-table">
        <thead>
          <tr>
            <th>Parameter</th>
            <th>Requirement</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($eligibility as $item): ?>
            <?php $param = is_string($item) ? $item : ($item->parameter ?? $item['parameter'] ?? $item->label ?? $item['label'] ?? ''); ?>
            <?php $req = is_string($item) ? '' : ($item->requirement ?? $item['requirement'] ?? $item->value ?? $item['value'] ?? ''); ?>
            <tr>
              <td><strong><?= htmlspecialchars($param) ?></strong></td>
              <td><?= htmlspecialchars($req) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($documents) && is_array($documents)): ?>
<section class="section section-light">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Documents</span>
      <h2 class="section-title">Required Documents</h2>
    </div>
    <div class="loan-docs-grid" data-aos="fade-up">
      <?php foreach ($documents as $item): ?>
        <?php $doc = is_string($item) ? $item : ($item->name ?? $item['name'] ?? $item->title ?? $item['title'] ?? ''); ?>
        <div class="loan-doc-item">
          <i class="bi bi-file-earmark-text"></i>
          <span><?= htmlspecialchars($doc) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($process) && is_array($process)): ?>
<section class="section">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Process</span>
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

<?php if (!empty($rates) && is_array($rates)): ?>
<section class="section section-light">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Interest Rates</span>
      <h2 class="section-title">Interest Rate & EMI Examples</h2>
    </div>
    <div style="overflow-x:auto;" data-aos="fade-up">
      <table class="eligibility-table">
        <thead>
          <tr>
            <th>Loan Amount</th>
            <th>Tenure</th>
            <th>Interest Rate</th>
            <th>Monthly EMI</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rates as $rate): ?>
            <tr>
              <td><?= htmlspecialchars(is_string($rate) ? $rate : ($rate->amount ?? $rate['amount'] ?? '')) ?></td>
              <td><?= htmlspecialchars(is_string($rate) ? '' : ($rate->tenure ?? $rate['tenure'] ?? '')) ?></td>
              <td><?= htmlspecialchars(is_string($rate) ? '' : ($rate->rate ?? $rate['rate'] ?? $rate->interest_rate ?? $rate['interest_rate'] ?? '')) ?></td>
              <td><?= htmlspecialchars(is_string($rate) ? '' : ($rate->emi ?? $rate['emi'] ?? '')) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($faqs) && is_array($faqs)): ?>
<section class="section">
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
      <span class="section-label" style="color:var(--color-gold);">Best Rates Guaranteed</span>
      <h2 class="display-2" style="color:var(--color-deep-navy);">Ready to Get Started?</h2>
      <p>Apply now and get the best deal with minimal documentation.</p>
      <div class="cta-actions">
        <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-lg">Apply Now <i class="bi bi-arrow-right"></i></a>
        <a href="<?= route('calculators') ?>" class="btn btn-outline btn-lg"><i class="bi bi-calculator"></i> Calculate EMI</a>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
