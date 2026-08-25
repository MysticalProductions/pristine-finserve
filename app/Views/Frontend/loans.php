<?php
$title = $title ?? 'Loan Products – Pristine Finserve';
$metaDescription = $metaDescription ?? 'Explore our wide range of loan products: Home Loan, Personal Loan, Business Loan, Education Loan, Vehicle Loan, and Loan Against Property at best rates.';
$metaKeywords = $metaKeywords ?? 'loan products, home loan, personal loan, business loan, education loan, vehicle loan, loan against property';
$currentPage = 'loans';
ob_start();
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <span>Loan Products</span>
    </div>
    <h1 data-aos="fade-up">Loan Products</h1>
    <p data-aos="fade-up" data-aos-delay="100">Choose from our comprehensive range of loan products tailored to every need.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="services-grid">
      <?php if (!empty($loanProducts)): ?>
        <?php foreach ($loanProducts as $i => $loan): ?>
          <?php $gradients = [
            'linear-gradient(135deg,var(--color-off-white),var(--color-light-gray))',
            'linear-gradient(135deg,#10B981,#065F46)',
            'linear-gradient(135deg,#D4A843,#A8812A)',
            'linear-gradient(135deg,#8B5CF6,#5B21B6)',
            'linear-gradient(135deg,#EF4444,#991B1B)',
            'linear-gradient(135deg,var(--color-off-white),var(--color-light-gray))',
          ]; ?>
          <div class="card loan-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>">
            <div class="loan-image" style="background:<?= $gradients[$i % count($gradients)] ?>;<?php if (!empty($loan->featured_image)): ?>background-image:url('<?= uploadUrl($loan->featured_image) ?>');background-size:cover;background-position:center;<?php endif; ?>"></div>
            <?php
              $rateDisplay = '';
              if (!empty($loan->min_rate)) {
                $rateDisplay = $loan->min_rate;
                if (!empty($loan->max_rate) && $loan->max_rate != $loan->min_rate) {
                  $rateDisplay .= '% - ' . $loan->max_rate;
                }
                $rateDisplay .= '% p.a.';
              }
              $badge = $loan->badge_text ?? ($rateDisplay ? 'Starting ' . $rateDisplay : '');
            ?>
            <?php if ($badge): ?>
              <span class="loan-badge"><?= htmlspecialchars($badge) ?></span>
            <?php endif; ?>
            <h4><?= htmlspecialchars($loan->name ?? '') ?></h4>
            <?php if ($rateDisplay): ?>
              <div class="loan-rate"><?= htmlspecialchars($rateDisplay) ?></div>
            <?php endif; ?>
            <ul class="loan-features">
              <?php $features = is_string($loan->features ?? '') ? json_decode($loan->features, true) : ($loan->features ?? []); ?>
              <?php if (!empty($features) && is_array($features)): ?>
                <?php foreach ($features as $feature): ?>
                  <li><?= htmlspecialchars(is_string($feature) ? $feature : ($feature->text ?? $feature['text'] ?? '')) ?></li>
                <?php endforeach; ?>
              <?php else: ?>
                <li>Competitive interest rates</li>
                <li>Flexible repayment</li>
                <li>Quick processing</li>
              <?php endif; ?>
            </ul>
            <div style="display:flex;gap:var(--space-3);">
              <a href="<?= route('loans/' . sanitize($loan->slug ?? '')) ?>" class="btn btn-outline-primary btn-sm" style="flex:1;">Details</a>
              <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-sm" style="flex:1;">Apply</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="card loan-card" data-aos="fade-up">
          <div class="loan-image" style="background:linear-gradient(135deg,var(--color-off-white),var(--color-light-gray));"></div>
          <span class="loan-badge">Starting 8.40% p.a.</span>
          <h4>Home Loan</h4>
          <div class="loan-rate">8.40% <span>p.a.</span></div>
          <ul class="loan-features">
            <li>Up to ₹10 Cr sanctioned</li>
            <li>Up to 30 years tenure</li>
            <li>Minimal documentation</li>
            <li>Balance transfer facility</li>
          </ul>
          <div style="display:flex;gap:var(--space-3);">
            <a href="<?= route('loans/home-loan') ?>" class="btn btn-outline-primary btn-sm" style="flex:1;">Details</a>
            <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-sm" style="flex:1;">Apply</a>
          </div>
        </div>
        <div class="card loan-card" data-aos="fade-up" data-aos-delay="100">
          <div class="loan-image" style="background:linear-gradient(135deg,#10B981,#065F46);"></div>
          <span class="loan-badge">Starting 10.50% p.a.</span>
          <h4>Personal Loan</h4>
          <div class="loan-rate">10.50% <span>p.a.</span></div>
          <ul class="loan-features">
            <li>Up to ₹25 Lakhs</li>
            <li>24-hour disbursal</li>
            <li>No collateral needed</li>
            <li>Minimal paperwork</li>
          </ul>
          <div style="display:flex;gap:var(--space-3);">
            <a href="<?= route('loans/personal-loan') ?>" class="btn btn-outline-primary btn-sm" style="flex:1;">Details</a>
            <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-sm" style="flex:1;">Apply</a>
          </div>
        </div>
        <div class="card loan-card" data-aos="fade-up" data-aos-delay="200">
          <div class="loan-image" style="background:linear-gradient(135deg,#D4A843,#A8812A);"></div>
          <span class="loan-badge">Starting 9.00% p.a.</span>
          <h4>Business Loan</h4>
          <div class="loan-rate">9.00% <span>p.a.</span></div>
          <ul class="loan-features">
            <li>Up to ₹50 Cr funding</li>
            <li>Flexible repayment</li>
            <li>Working capital options</li>
            <li>Minimal collateral</li>
          </ul>
          <div style="display:flex;gap:var(--space-3);">
            <a href="<?= route('loans/business-loan') ?>" class="btn btn-outline-primary btn-sm" style="flex:1;">Details</a>
            <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-sm" style="flex:1;">Apply</a>
          </div>
        </div>
        <div class="card loan-card" data-aos="fade-up">
          <div class="loan-image" style="background:linear-gradient(135deg,#8B5CF6,#5B21B6);"></div>
          <span class="loan-badge">Starting 11.00% p.a.</span>
          <h4>Education Loan</h4>
          <div class="loan-rate">11.00% <span>p.a.</span></div>
          <ul class="loan-features">
            <li>Up to ₹1 Cr funding</li>
            <li>Study in India & abroad</li>
            <li>Moratorium period</li>
            <li>Quick approval</li>
          </ul>
          <div style="display:flex;gap:var(--space-3);">
            <a href="<?= route('loans/education-loan') ?>" class="btn btn-outline-primary btn-sm" style="flex:1;">Details</a>
            <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-sm" style="flex:1;">Apply</a>
          </div>
        </div>
        <div class="card loan-card" data-aos="fade-up" data-aos-delay="100">
          <div class="loan-image" style="background:linear-gradient(135deg,#EF4444,#991B1B);"></div>
          <span class="loan-badge">Starting 7.50% p.a.</span>
          <h4>Vehicle Loan</h4>
          <div class="loan-rate">7.50% <span>p.a.</span></div>
          <ul class="loan-features">
            <li>New & used vehicles</li>
            <li>Up to 100% financing</li>
            <li>7 years tenure</li>
            <li>Quick disbursal</li>
          </ul>
          <div style="display:flex;gap:var(--space-3);">
            <a href="<?= route('loans/vehicle-loan') ?>" class="btn btn-outline-primary btn-sm" style="flex:1;">Details</a>
            <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-sm" style="flex:1;">Apply</a>
          </div>
        </div>
        <div class="card loan-card" data-aos="fade-up" data-aos-delay="200">
          <div class="loan-image" style="background:linear-gradient(135deg,var(--color-off-white),var(--color-light-gray));"></div>
          <span class="loan-badge">Starting 8.50% p.a.</span>
          <h4>Loan Against Property</h4>
          <div class="loan-rate">8.50% <span>p.a.</span></div>
          <ul class="loan-features">
            <li>Up to ₹10 Cr funding</li>
            <li>Up to 20 years tenure</li>
            <li>High loan-to-value ratio</li>
            <li>Flexible end-use</li>
          </ul>
          <div style="display:flex;gap:var(--space-3);">
            <a href="<?= route('loans/loan-against-property') ?>" class="btn btn-outline-primary btn-sm" style="flex:1;">Details</a>
            <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-sm" style="flex:1;">Apply</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section section-light">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Quick Compare</span>
      <h2 class="section-title">Compare Loan Products</h2>
    </div>
    <div style="overflow-x:auto;" data-aos="fade-up">
      <table class="eligibility-table">
        <thead>
          <tr>
            <th>Loan Type</th>
            <th>Interest Rate</th>
            <th>Max Amount</th>
            <th>Max Tenure</th>
            <th>Processing Fee</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($loanProducts)): ?>
            <?php foreach ($loanProducts as $loan):
              $tblRate = '';
              if (!empty($loan->min_rate)) {
                $tblRate = $loan->min_rate . '%';
                if (!empty($loan->max_rate) && $loan->max_rate != $loan->min_rate) {
                  $tblRate = $loan->min_rate . '% - ' . $loan->max_rate . '%';
                }
              }
            ?>
              <tr>
                <td><?= htmlspecialchars($loan->name ?? '') ?></td>
                <td><?= htmlspecialchars($tblRate ?: '-') ?></td>
                <td><?= htmlspecialchars($loan->max_amount ?? '-') ?></td>
                <td><?= htmlspecialchars($loan->max_tenure ?? '-') ?></td>
                <td><?= htmlspecialchars($loan->processing_fee ?? '-') ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td>Home Loan</td><td>8.40% p.a.</td><td>₹10 Cr</td><td>30 Years</td><td>0.50%</td></tr>
            <tr><td>Personal Loan</td><td>10.50% p.a.</td><td>₹25 Lakhs</td><td>5 Years</td><td>1.00%</td></tr>
            <tr><td>Business Loan</td><td>9.00% p.a.</td><td>₹50 Cr</td><td>15 Years</td><td>0.75%</td></tr>
            <tr><td>Education Loan</td><td>11.00% p.a.</td><td>₹1 Cr</td><td>15 Years</td><td>0.50%</td></tr>
            <tr><td>Vehicle Loan</td><td>7.50% p.a.</td><td>₹2 Cr</td><td>7 Years</td><td>0.50%</td></tr>
            <tr><td>Loan Against Property</td><td>8.50% p.a.</td><td>₹10 Cr</td><td>20 Years</td><td>0.75%</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="section cta-section">
  <div class="container">
    <div class="cta-content" data-aos="fade-up">
      <span class="section-label" style="color:var(--color-gold);">Best Rates Guaranteed</span>
      <h2 class="display-2" style="color:var(--color-deep-navy);">Get the Best Loan Offer Today</h2>
      <p>Compare rates from 50+ banks and get the best deal with minimal documentation.</p>
      <div class="cta-actions">
        <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-lg">Apply Now <i class="bi bi-arrow-right"></i></a>
        <a href="<?= route('calculators') ?>" class="btn btn-outline btn-lg"><i class="bi bi-calculator"></i> Check EMI</a>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
