<?php
$title = $title ?? 'Testimonials – Pristine Finserve';
$metaDescription = $metaDescription ?? 'Read what our 10,000+ happy customers say about Pristine Finserve\'s financial services and loan solutions.';
$metaKeywords = $metaKeywords ?? 'testimonials, customer reviews, financial services, loans, pristine finserve, happy customers';
$currentPage = 'testimonials';

$avgRating = $stats['averageRating'] ?? 4.9;
$total = $stats['total'] ?? 0;
$byRating = $stats['byRating'] ?? [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
ob_start();
?>

<section class="page-hero page-hero-sm">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <span>Testimonials</span>
    </div>
    <h1 data-aos="fade-up">What Our Customers Say</h1>
    <p data-aos="fade-up" data-aos-delay="100">Real stories from real customers who achieved their financial goals with Pristine Finserve.</p>
  </div>
</section>

<section class="section section-light" style="padding:var(--space-12) 0;">
  <div class="container">
    <div style="display:flex;align-items:center;justify-content:center;gap:var(--space-12);flex-wrap:wrap;">
      <div style="text-align:center;">
        <div style="font-size:var(--text-6xl);font-weight:700;color:var(--color-gold);font-family:var(--font-mono);"><?= number_format($avgRating, 1) ?></div>
        <div style="color:var(--color-gold);font-size:var(--text-xl);margin-bottom:var(--space-2);">
          <?php $fullStars = floor($avgRating); ?>
          <?php for ($s = 0; $s < 5; $s++): ?>
            <i class="bi bi-star<?= $s < $fullStars ? '-fill' : ($s < $avgRating ? '-half' : '') ?>"></i>
          <?php endfor; ?>
        </div>
        <div style="color:var(--color-text-muted);font-size:var(--text-sm);">Average Rating</div>
      </div>
      <div style="text-align:center;">
        <div style="font-size:var(--text-6xl);font-weight:700;color:var(--color-deep-navy);font-family:var(--font-mono);"><?= $total > 0 ? $total : '10K+' ?></div>
        <div style="color:var(--color-text-muted);font-size:var(--text-sm);"><?= $total > 0 ? 'Reviews' : 'Happy Customers' ?></div>
      </div>
      <div style="text-align:center;">
        <div style="font-size:var(--text-6xl);font-weight:700;color:var(--color-success);font-family:var(--font-mono);">98%</div>
        <div style="color:var(--color-text-muted);font-size:var(--text-sm);">Satisfaction Rate</div>
      </div>
    </div>
  </div>
</section>

<?php if ($total > 0): ?>
<section class="section section-light" style="padding-top:0;">
  <div class="container" style="max-width:500px;">
    <div style="background:var(--color-white);border-radius:var(--radius-xl);padding:var(--space-6);box-shadow:var(--shadow-sm);">
      <?php for ($r = 5; $r >= 1; $r--): ?>
        <?php
        $count = $byRating[$r] ?? 0;
        $pct = $total > 0 ? round(($count / $total) * 100) : 0;
        ?>
        <div style="display:flex;align-items:center;gap:var(--space-3);margin-bottom:var(--space-2);">
          <span style="font-size:var(--text-sm);min-width:50px;"><?= $r ?> Star</span>
          <div style="flex:1;height:12px;background:var(--color-off-white);border-radius:var(--radius-full);overflow:hidden;">
            <div style="height:100%;background:var(--color-gold);border-radius:var(--radius-full);width:<?= $pct ?>%;transition:width 0.6s ease;"></div>
          </div>
          <span style="font-size:var(--text-xs);color:var(--color-text-muted);min-width:40px;text-align:right;"><?= $pct ?>%</span>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="section">
  <div class="container">
    <?php if (!empty($testimonials)): ?>
      <div class="grid-3-col" style="gap:var(--space-6);">
        <?php foreach ($testimonials as $ti => $testimonial): ?>
          <?php $delay = ($ti % 3) * 100; ?>
          <div class="testimonial-card" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
            <div class="testimonial-stars">
              <?php $rating = (int)($testimonial->rating ?? 5); ?>
              <?php for ($s = 0; $s < 5; $s++): ?>
                <i class="bi bi-star<?= $s < $rating ? '-fill' : '' ?>"></i>
              <?php endfor; ?>
            </div>
            <p class="testimonial-text">"<?= htmlspecialchars($testimonial->quote ?? $testimonial->content ?? $testimonial->message ?? '') ?>"</p>
            <div class="testimonial-author">
              <?php if (!empty($testimonial->client_photo)): ?>
                <img src="<?= uploadUrl(htmlspecialchars($testimonial->client_photo)) ?>" alt="<?= htmlspecialchars($testimonial->name ?? '') ?>" class="testimonial-avatar" loading="lazy">
              <?php else: ?>
                <div class="testimonial-avatar" style="background:linear-gradient(135deg, var(--color-gold), #A8812A);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:var(--text-lg);border-radius:50%;width:48px;height:48px;flex-shrink:0;">
                  <?= htmlspecialchars(!empty($testimonial->initials) ? $testimonial->initials : substr($testimonial->name ?? 'CU', 0, 2)) ?>
                </div>
              <?php endif; ?>
              <div class="testimonial-info">
                <h6><?= htmlspecialchars($testimonial->name ?? '') ?></h6>
                <span>
                  <?= htmlspecialchars($testimonial->loan_type ?? $testimonial->service ?? '') ?>
                  <?= !empty($testimonial->location) ? ', ' . htmlspecialchars($testimonial->location) : '' ?>
                </span>
                <?php if (!empty($testimonial->amount_sanctioned) || !empty($testimonial->amount)): ?>
                  <div style="font-size:var(--text-xs);color:var(--color-success);font-weight:600;margin-top:2px;">
                    <?= formatCurrency((float)($testimonial->amount_sanctioned ?? $testimonial->amount)) ?> Sanctioned
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="grid-3-col" style="gap:var(--space-6);">
        <?php $dummyTestimonials = [
          ['name' => 'Rahul Sharma', 'avatar' => 'RS', 'loan' => 'Home Loan, Noida', 'quote' => 'Pristine Finserve made my home loan process incredibly smooth. They found me the best rate and handled all the paperwork. I saved over ₹2.5 lakhs compared to other lenders!', 'amount' => '7500000'],
          ['name' => 'Priya Patel', 'avatar' => 'PP', 'loan' => 'Business Loan, Delhi', 'quote' => 'As a startup founder, getting a business loan was challenging. The team at Pristine Finserve understood my vision and secured funding within a week. Highly recommended!', 'amount' => '5000000'],
          ['name' => 'Amit Verma', 'avatar' => 'AV', 'loan' => 'Investment Client, Bangalore', 'quote' => 'Their investment advisory service transformed my portfolio. Professional, transparent, and always available. My wealth has grown 35% in just one year.', 'amount' => '0'],
          ['name' => 'Suresh Reddy', 'avatar' => 'SR', 'loan' => 'Education Loan, Hyderabad', 'quote' => 'The education loan process was seamless. My daughter got her visa and the loan was disbursed before her course started. Thank you Pristine Finserve!', 'amount' => '2500000'],
          ['name' => 'Neha Gupta', 'avatar' => 'NG', 'loan' => 'Personal Loan, Pune', 'quote' => 'I never thought getting a personal loan could be this easy. Applied online, got a call in 15 minutes, and money in my account the next day. Incredible service!', 'amount' => '800000'],
          ['name' => 'Vikram Singh', 'avatar' => 'VS', 'loan' => 'Loan Against Property, Jaipur', 'quote' => 'The team helped me with a loan against property at the lowest rate in the market. Their transparency and professionalism set them apart from other consultants.', 'amount' => '3000000'],
        ]; ?>
        <?php foreach ($dummyTestimonials as $ti => $dt): ?>
          <?php $delay = ($ti % 3) * 100; ?>
          <div class="testimonial-card" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
            <div class="testimonial-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
            <p class="testimonial-text">"<?= htmlspecialchars($dt['quote']) ?>"</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar" style="background:linear-gradient(135deg, var(--color-gold), #A8812A);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:var(--text-lg);border-radius:50%;width:48px;height:48px;flex-shrink:0;"><?= $dt['avatar'] ?></div>
              <div class="testimonial-info">
                <h6><?= $dt['name'] ?></h6>
                <span><?= $dt['loan'] ?></span>
                <?php if ($dt['amount'] > 0): ?>
                  <div style="font-size:var(--text-xs);color:var(--color-success);font-weight:600;margin-top:2px;"><?= formatCurrency((float)$dt['amount']) ?> Sanctioned</div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="section cta-section">
  <div class="container">
    <div class="cta-content" data-aos="fade-up">
      <span class="section-label" style="color:var(--color-gold);">Join 10,000+ Happy Customers</span>
      <h2 class="display-2" style="color:var(--color-deep-navy);">Start Your Success Story Today</h2>
      <p>Let us help you achieve your financial goals with expert guidance and personalized solutions.</p>
      <div class="cta-actions">
        <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-lg">Get Started <i class="bi bi-arrow-right"></i></a>
        <a href="tel:<?= htmlspecialchars(setting('phone', '+919899360744')) ?>" class="btn btn-outline btn-lg"><i class="bi bi-telephone"></i> Call Now</a>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
