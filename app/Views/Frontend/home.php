<?php
$title = $title ?? 'Pristine Finserve – Trusted Financial Solutions & Loan Consultancy';
$metaDescription = $metaDescription ?? 'Pristine Finserve offers expert financial consultancy, home loans, personal loans, business loans, and investment advisory. Trusted by 10,000+ happy customers.';
$metaKeywords = $metaKeywords ?? 'financial services, loan consultancy, home loan, personal loan, business loan, investment advisory, India';
$currentPage = 'home';
ob_start();
?>

<section class="hero" id="home">
  <div class="container grid-2-col-align-center hero-container" style="gap: var(--space-12);">
    <div class="hero-content" data-aos="fade-up" data-aos-duration="800">
      <div class="hero-badge">
        <i class="bi bi-shield-check"></i> Trusted by 10,000+ Customers
      </div>
      <h1 class="hero-title">
        Your Gateway to<br>
        <span class="highlight">Financial Freedom</span>
      </h1>
      <p class="hero-description">
        Expert financial consultancy and tailored loan solutions to help you achieve your dreams.
        We partner with 50+ banks and NBFCs to bring you the best rates.
      </p>
      <div class="hero-actions">
        <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-lg">
          Apply Now <i class="bi bi-arrow-right"></i>
        </a>
        <a href="<?= route('calculators') ?>" class="btn btn-outline btn-lg">
          <i class="bi bi-calculator"></i> Check Eligibility
        </a>
      </div>
      <div class="hero-stats">
        <?php if (!empty($statistics)): ?>
          <?php foreach (array_slice($statistics, 0, 4) as $stat): ?>
            <div class="hero-stat-item">
              <h3><span class="counter" data-target="<?= (int)($stat->value ?? 0) ?>">0</span><?= htmlspecialchars($stat->suffix ?? '+') ?></h3>
              <p><?= htmlspecialchars($stat->label ?? '') ?></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="hero-stat-item">
            <h3><span class="counter" data-target="50">0</span>+</h3>
            <p>Bank Partners</p>
          </div>
          <div class="hero-stat-item">
            <h3><span class="counter" data-target="10000">0</span>+</h3>
            <p>Happy Customers</p>
          </div>
          <div class="hero-stat-item">
            <h3><span class="counter" data-target="500">0</span>Cr+</h3>
            <p>Loans Sanctioned</p>
          </div>
          <div class="hero-stat-item">
            <h3><span class="counter" data-target="98">0</span>%</h3>
            <p>Approval Rate</p>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="hero-form-card" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
      <h4>Quick Loan Inquiry</h4>
      <p>Get a callback within 30 minutes</p>
      <form action="<?= route('lead/submit') ?>" method="POST">
        <?= csrfField() ?>
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" name="name" class="form-control dark-input" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
          <label>Phone Number</label>
          <input type="tel" name="phone" class="form-control dark-input" placeholder="Enter your phone" required>
        </div>
        <div class="form-group">
          <label>Email ID</label>
          <input type="email" name="email" class="form-control dark-input" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
          <label>Loan Type</label>
          <select name="loan_type" class="form-control dark-input" required>
            <option value="">Select loan type</option>
            <?php if (!empty($loanProducts)): ?>
              <?php foreach ($loanProducts as $lp): ?>
                <option value="<?= htmlspecialchars($lp->name ?? $lp->title ?? '') ?>"><?= htmlspecialchars($lp->name ?? $lp->title ?? '') ?></option>
              <?php endforeach; ?>
            <?php else: ?>
              <option>Home Loan</option>
              <option>Personal Loan</option>
              <option>Business Loan</option>
              <option>Education Loan</option>
              <option>Vehicle Loan</option>
              <option>Loan Against Property</option>
            <?php endif; ?>
          </select>
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
</section>

<section class="section" id="services">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Our Services</span>
      <h2 class="section-title">Comprehensive Financial Solutions</h2>
      <p class="section-subtitle" style="margin:0 auto;">
        From personal loans to investment advisory, we offer end-to-end financial solutions
        tailored to your needs.
      </p>
    </div>

    <div class="services-grid">
      <?php if (!empty($services)): ?>
        <?php foreach ($services as $i => $service): ?>
          <?php if (!empty($service->featured_image)): ?>
          <div class="card service-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>" style="padding:0;overflow:hidden;">
            <img src="<?= uploadUrl($service->featured_image) ?>" alt="<?= htmlspecialchars($service->title ?? '') ?>" style="width:100%;height:180px;object-fit:cover;display:block;">
            <div style="padding:var(--space-6);">
              <h4><?= htmlspecialchars($service->title ?? $service->name ?? '') ?></h4>
              <p><?= htmlspecialchars(truncate($service->short_description ?? $service->description ?? '', 120)) ?></p>
              <a href="<?= route('services/' . sanitize($service->slug ?? '')) ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <?php else: ?>
          <div class="card service-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>">
            <div class="card-icon blue"><i class="bi bi-<?= htmlspecialchars($service->icon ?? 'house') ?>"></i></div>
            <h4><?= htmlspecialchars($service->title ?? $service->name ?? '') ?></h4>
            <p><?= htmlspecialchars(truncate($service->short_description ?? $service->description ?? '', 120)) ?></p>
            <a href="<?= route('services/' . sanitize($service->slug ?? '')) ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
          </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="card service-card" data-aos="fade-up">
          <div class="card-icon blue"><i class="bi bi-house"></i></div>
          <h4>Home Loans</h4>
          <p>Dream home with affordable EMIs and attractive interest rates starting from 8.40% p.a.</p>
          <a href="<?= route('services/home-loan') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up" data-aos-delay="100">
          <div class="card-icon green"><i class="bi bi-person"></i></div>
          <h4>Personal Loans</h4>
          <p>Instant personal loans with minimal documentation and quick disbursal within 24 hours.</p>
          <a href="<?= route('services/personal-loan') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up" data-aos-delay="200">
          <div class="card-icon gold"><i class="bi bi-briefcase"></i></div>
          <h4>Business Loans</h4>
          <p>Funding solutions for your business growth with flexible repayment options.</p>
          <a href="<?= route('services/business-loan') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up">
          <div class="card-icon purple"><i class="bi bi-graph-up-arrow"></i></div>
          <h4>Investment Advisory</h4>
          <p>Strategic investment guidance to grow your wealth with expert portfolio management.</p>
          <a href="<?= route('services/investment-advisory') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up" data-aos-delay="100">
          <div class="card-icon red"><i class="bi bi-shield-check"></i></div>
          <h4>Insurance Assistance</h4>
          <p>Comprehensive insurance plans to protect what matters most to you and your family.</p>
          <a href="<?= route('services/insurance-assistance') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card service-card" data-aos="fade-up" data-aos-delay="200">
          <div class="card-icon blue"><i class="bi bi-bank"></i></div>
          <h4>Loan Against Property</h4>
          <p>Unlock the value of your property with high-value loans at competitive interest rates.</p>
          <a href="<?= route('services/loan-against-property') ?>" class="card-link">Learn More <i class="bi bi-arrow-right"></i></a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section section-light" id="loan-products">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Loan Products</span>
      <h2 class="section-title">Loans Designed for Every Need</h2>
      <p class="section-subtitle" style="margin:0 auto;">
        Choose from our wide range of loan products with competitive rates and flexible tenures.
      </p>
    </div>

    <div class="services-grid">
      <?php if (!empty($loanProducts)): ?>
        <?php foreach ($loanProducts as $i => $loan): ?>
          <div class="card loan-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>">
            <div class="loan-image" style="background-image: linear-gradient(135deg, var(--color-off-white), var(--color-light-gray));<?php if (!empty($loan->featured_image)): ?>background-image:url('<?= uploadUrl($loan->featured_image) ?>');background-size:cover;background-position:center;<?php endif; ?>"></div>
            <?php
              $homeRateDisplay = '';
              if (!empty($loan->min_rate)) {
                $homeRateDisplay = $loan->min_rate;
                if (!empty($loan->max_rate) && $loan->max_rate != $loan->min_rate) {
                  $homeRateDisplay .= '% - ' . $loan->max_rate;
                }
                $homeRateDisplay .= '% p.a.';
              }
              $badge = $loan->badge_text ?? ($homeRateDisplay ? 'Starting ' . $homeRateDisplay : '');
            ?>
            <?php if ($badge): ?>
              <span class="loan-badge"><?= htmlspecialchars($badge) ?></span>
            <?php endif; ?>
            <h4><?= htmlspecialchars($loan->name ?? '') ?></h4>
            <?php if ($homeRateDisplay): ?>
              <div class="loan-rate"><?= htmlspecialchars($homeRateDisplay) ?></div>
            <?php endif; ?>
            <ul class="loan-features">
              <?php $features = is_string($loan->features ?? '') ? json_decode($loan->features, true) : ($loan->features ?? []); ?>
              <?php if (!empty($features) && is_array($features)): ?>
                <?php foreach (array_slice($features, 0, 3) as $feature): ?>
                  <li><?= htmlspecialchars(is_string($feature) ? $feature : ($feature->text ?? $feature['text'] ?? '')) ?></li>
                <?php endforeach; ?>
              <?php else: ?>
                <li>Competitive interest rates</li>
                <li>Flexible repayment options</li>
                <li>Quick processing</li>
              <?php endif; ?>
            </ul>
            <div style="display:flex;gap:var(--space-3);">
              <a href="<?= route('loans/' . sanitize($loan->slug ?? '')) ?>" class="btn btn-outline-primary btn-sm" style="flex:1;">Details</a>
              <a href="<?= route('contact') ?>#inquiry" class="btn btn-primary btn-sm" style="flex:1;">Apply Now</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="card loan-card" data-aos="fade-up">
          <div class="loan-image" style="background-image: linear-gradient(135deg, var(--color-off-white), var(--color-light-gray));"></div>
          <span class="loan-badge">Starting 8.40% p.a.</span>
          <h4>Home Loan</h4>
          <div class="loan-rate">8.40% <span>p.a.</span></div>
          <ul class="loan-features">
            <li>Up to ₹10 Cr sanctioned</li>
            <li>Up to 30 years tenure</li>
            <li>Minimal documentation</li>
          </ul>
          <div style="display:flex;gap:var(--space-3);">
            <a href="<?= route('loans/home-loan') ?>" class="btn btn-outline-primary btn-sm" style="flex:1;">Details</a>
            <a href="<?= route('contact') ?>#inquiry" class="btn btn-primary btn-sm" style="flex:1;">Apply Now</a>
          </div>
        </div>
        <div class="card loan-card" data-aos="fade-up" data-aos-delay="100">
          <div class="loan-image" style="background-image: linear-gradient(135deg, #10B981, #065F46);"></div>
          <span class="loan-badge">Starting 10.50% p.a.</span>
          <h4>Personal Loan</h4>
          <div class="loan-rate">10.50% <span>p.a.</span></div>
          <ul class="loan-features">
            <li>Up to ₹25 Lakhs</li>
            <li>Instant approval</li>
            <li>No collateral needed</li>
          </ul>
          <div style="display:flex;gap:var(--space-3);">
            <a href="<?= route('loans/personal-loan') ?>" class="btn btn-outline-primary btn-sm" style="flex:1;">Details</a>
            <a href="<?= route('contact') ?>#inquiry" class="btn btn-primary btn-sm" style="flex:1;">Apply Now</a>
          </div>
        </div>
        <div class="card loan-card" data-aos="fade-up" data-aos-delay="200">
          <div class="loan-image" style="background-image: linear-gradient(135deg, #D4A843, #A8812A);"></div>
          <span class="loan-badge">Starting 9.00% p.a.</span>
          <h4>Business Loan</h4>
          <div class="loan-rate">9.00% <span>p.a.</span></div>
          <ul class="loan-features">
            <li>Up to ₹50 Cr funding</li>
            <li>Flexible repayment</li>
            <li>Minimal paperwork</li>
          </ul>
          <div style="display:flex;gap:var(--space-3);">
            <a href="<?= route('loans/business-loan') ?>" class="btn btn-outline-primary btn-sm" style="flex:1;">Details</a>
            <a href="<?= route('contact') ?>#inquiry" class="btn btn-primary btn-sm" style="flex:1;">Apply Now</a>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div style="text-align:center;margin-top:var(--space-10);" data-aos="fade-up">
      <a href="<?= route('loans') ?>" class="btn btn-outline-primary btn-lg">
        View All Loan Products <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<section class="section" id="why-us">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Why Pristine Finserve</span>
      <h2 class="section-title">Why Thousands Trust Us</h2>
      <p class="section-subtitle" style="margin:0 auto;">
        We combine expertise, transparency, and personalized service to deliver
        the best financial outcomes.
      </p>
    </div>

    <div class="why-grid">
      <div class="why-item" data-aos="fade-up">
        <div class="why-icon"><i class="bi bi-currency-exchange"></i></div>
        <div class="why-content">
          <h5>Best Interest Rates</h5>
          <p>We compare 50+ banks and NBFCs to get you the most competitive interest rates available.</p>
        </div>
      </div>
      <div class="why-item" data-aos="fade-up" data-aos-delay="50">
        <div class="why-icon"><i class="bi bi-lightning"></i></div>
        <div class="why-content">
          <h5>Quick Processing</h5>
          <p>Streamlined digital application process with approvals in as little as 24 hours.</p>
        </div>
      </div>
      <div class="why-item" data-aos="fade-up" data-aos-delay="100">
        <div class="why-icon"><i class="bi bi-file-earmark-text"></i></div>
        <div class="why-content">
          <h5>Minimal Documentation</h5>
          <p>We handle the paperwork. Just upload basic documents and we take care of the rest.</p>
        </div>
      </div>
      <div class="why-item" data-aos="fade-up">
        <div class="why-icon"><i class="bi bi-shield-check"></i></div>
        <div class="why-content">
          <h5>100% Transparency</h5>
          <p>No hidden charges, no surprises. Complete fee disclosure before you sign anything.</p>
        </div>
      </div>
      <div class="why-item" data-aos="fade-up" data-aos-delay="50">
        <div class="why-icon"><i class="bi bi-headset"></i></div>
        <div class="why-content">
          <h5>Dedicated Support</h5>
          <p>Personal relationship manager assigned to every customer for end-to-end assistance.</p>
        </div>
      </div>
      <div class="why-item" data-aos="fade-up" data-aos-delay="100">
        <div class="why-icon"><i class="bi bi-graph-up-arrow"></i></div>
        <div class="why-content">
          <h5>Expert Guidance</h5>
          <p>15+ years of financial expertise with certified advisors guiding you at every step.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section-light" id="calculators">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Financial Calculators</span>
      <h2 class="section-title">Plan Your Finances Smartly</h2>
      <p class="section-subtitle" style="margin:0 auto;">
        Use our interactive calculators to plan your loans, investments, and EMIs with real-time results.
      </p>
    </div>

    <div class="calculator-grid">
      <a href="<?= route('calculators') ?>#emi" class="calc-card" data-aos="fade-up">
        <div class="icon">📊</div>
        <h5>EMI Calculator</h5>
        <p>Calculate monthly installments instantly</p>
      </a>
      <a href="<?= route('calculators') ?>#home" class="calc-card" data-aos="fade-up" data-aos-delay="100">
        <div class="icon">🏠</div>
        <h5>Home Loan Calculator</h5>
        <p>Plan your dream home budget</p>
      </a>
      <a href="<?= route('calculators') ?>#sip" class="calc-card" data-aos="fade-up" data-aos-delay="200">
        <div class="icon">📈</div>
        <h5>SIP Calculator</h5>
        <p>Estimate your investment returns</p>
      </a>
      <a href="<?= route('calculators') ?>#eligibility" class="calc-card" data-aos="fade-up">
        <div class="icon">✅</div>
        <h5>Affordability/Eligibility Calculator</h5>
        <p>Check your loan eligibility</p>
      </a>
      <a href="<?= route('calculators') ?>#interest" class="calc-card" data-aos="fade-up" data-aos-delay="100">
        <div class="icon">💰</div>
        <h5>Interest Calculator</h5>
        <p>Compare interest scenarios</p>
      </a>
      <a href="<?= route('calculators') ?>#investment" class="calc-card" data-aos="fade-up" data-aos-delay="200">
        <div class="icon">📊</div>
        <h5>Returns Calculator</h5>
        <p>Project investment growth</p>
      </a>
    </div>
  </div>
</section>

<section class="section-sm" id="partners">
  <div class="container">
    <div class="section-header" data-aos="fade-up" style="margin-bottom:var(--space-8);">
      <span class="section-label">Our Partners</span>
      <h2 class="section-title">Trusted by Leading Banks & NBFCs</h2>
    </div>
  </div>
  <div class="partners-wrapper" data-aos="fade-up">
    <div class="partners-track" id="partnersTrack">
      <?php if (!empty($partners)): ?>
        <?php foreach ($partners as $partner): ?>
          <div class="partner-logo">
            <?php if (!empty($partner->logo)): ?>
              <img src="<?= uploadUrl($partner->logo) ?>" alt="<?= htmlspecialchars($partner->name ?? 'Partner') ?>">
            <?php else: ?>
              <img src="https://via.placeholder.com/160x60/E8F0FE/1B5AAE?text=<?= urlencode(substr($partner->name ?? 'P', 0, 8)) ?>" alt="<?= htmlspecialchars($partner->name ?? 'Partner') ?>">
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
        <?php foreach ($partners as $partner): ?>
          <div class="partner-logo">
            <?php if (!empty($partner->logo)): ?>
              <img src="<?= uploadUrl($partner->logo) ?>" alt="<?= htmlspecialchars($partner->name ?? 'Partner') ?>">
            <?php else: ?>
              <img src="https://via.placeholder.com/160x60/E8F0FE/1B5AAE?text=<?= urlencode(substr($partner->name ?? 'P', 0, 8)) ?>" alt="<?= htmlspecialchars($partner->name ?? 'Partner') ?>">
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/E8F0FE/1B5AAE?text=SBI" alt="SBI"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/FEF3E8/D4A843?text=HDFC" alt="HDFC"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/E8F0FE/1B5AAE?text=ICICI" alt="ICICI"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/F0FDF4/10B981?text=AXIS" alt="AXIS"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/FEF3E8/D4A843?text=Kotak" alt="Kotak"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/E8F0FE/1B5AAE?text=Yes+Bank" alt="Yes Bank"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/F0FDF4/10B981?text=BAJAJ" alt="BAJAJ"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/E8F0FE/1B5AAE?text=PNB" alt="PNB"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/E8F0FE/1B5AAE?text=SBI" alt="SBI"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/FEF3E8/D4A843?text=HDFC" alt="HDFC"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/E8F0FE/1B5AAE?text=ICICI" alt="ICICI"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/F0FDF4/10B981?text=AXIS" alt="AXIS"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/FEF3E8/D4A843?text=Kotak" alt="Kotak"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/E8F0FE/1B5AAE?text=Yes+Bank" alt="Yes Bank"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/F0FDF4/10B981?text=BAJAJ" alt="BAJAJ"></div>
        <div class="partner-logo"><img src="https://via.placeholder.com/160x60/E8F0FE/1B5AAE?text=PNB" alt="PNB"></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section section-light" id="testimonials">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Testimonials</span>
      <h2 class="section-title">What Our Customers Say</h2>
      <p class="section-subtitle" style="margin:0 auto;">
        Real stories from real customers who achieved their financial goals with us.
      </p>
    </div>

    <div class="grid-3-col" style="gap:var(--space-6);">
      <?php if (!empty($testimonials)): ?>
        <?php foreach ($testimonials as $i => $testimonial): ?>
          <div class="testimonial-card" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
            <div class="testimonial-stars">
              <?php $rating = (int)($testimonial->rating ?? 5); ?>
              <?php for ($s = 0; $s < 5; $s++): ?>
                <i class="bi bi-star<?= $s < $rating ? '-fill' : '' ?>"></i>
              <?php endfor; ?>
            </div>
            <p class="testimonial-text">"<?= htmlspecialchars($testimonial->content ?? '') ?>"</p>
            <div class="testimonial-author">
              <?php if (!empty($testimonial->client_photo)): ?>
                <img src="<?= uploadUrl($testimonial->client_photo) ?>" alt="<?= htmlspecialchars($testimonial->name ?? '') ?>" class="testimonial-avatar" loading="lazy">
              <?php else: ?>
                <img src="https://i.pravatar.cc/100?img=<?= ($i + 1) * 11 % 70 ?>" alt="<?= htmlspecialchars($testimonial->name ?? '') ?>" class="testimonial-avatar" loading="lazy">
              <?php endif; ?>
              <div class="testimonial-info">
                <h6><?= htmlspecialchars($testimonial->name ?? '') ?></h6>
                <span><?= htmlspecialchars(($testimonial->loan_type ?? '') . (!empty($testimonial->location) ? ', ' . $testimonial->location : '')) ?></span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="testimonial-card" data-aos="fade-up">
          <div class="testimonial-stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p class="testimonial-text">
            "Pristine Finserve made my home loan process incredibly smooth. They found me the best rate
            and handled all the paperwork. I saved over ₹2.5 lakhs compared to other lenders!"
          </p>
          <div class="testimonial-author">
            <img src="https://i.pravatar.cc/100?img=11" alt="Rahul Sharma" class="testimonial-avatar" loading="lazy">
            <div class="testimonial-info">
              <h6>Rahul Sharma</h6>
              <span>Home Loan, Noida</span>
            </div>
          </div>
        </div>
        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p class="testimonial-text">
            "As a startup founder, getting a business loan was challenging. The team at Pristine Finserve
            understood my vision and secured funding within a week. Highly recommended!"
          </p>
          <div class="testimonial-author">
            <img src="https://i.pravatar.cc/100?img=32" alt="Priya Patel" class="testimonial-avatar" loading="lazy">
            <div class="testimonial-info">
              <h6>Priya Patel</h6>
              <span>Business Loan, Delhi</span>
            </div>
          </div>
        </div>
        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
          <div class="testimonial-stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p class="testimonial-text">
            "Their investment advisory service transformed my portfolio. Professional, transparent,
            and always available. My wealth has grown 35% in just one year with their guidance."
          </p>
          <div class="testimonial-author">
            <img src="https://i.pravatar.cc/100?img=45" alt="Amit Verma" class="testimonial-avatar" loading="lazy">
            <div class="testimonial-info">
              <h6>Amit Verma</h6>
              <span>Investment Client, Bangalore</span>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div style="text-align:center;margin-top:var(--space-10);" data-aos="fade-up">
      <a href="<?= route('testimonials') ?>" class="btn btn-outline-primary btn-lg">
        View All Reviews <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<section class="section" id="blog">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Our Blog</span>
      <h2 class="section-title">Latest Financial Insights</h2>
      <p class="section-subtitle" style="margin:0 auto;">
        Expert advice, market updates, and tips to help you make smarter financial decisions.
      </p>
    </div>

    <div class="blog-grid">
      <?php if (!empty($blogPosts)): ?>
        <?php foreach ($blogPosts as $i => $post): ?>
          <article class="blog-card" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
            <div class="blog-card-image" style="background-image: linear-gradient(135deg, var(--color-off-white), var(--color-light-gray));<?php if (!empty($post->featured_image)): ?>background-image:url('<?= uploadUrl($post->featured_image) ?>');background-size:cover;background-position:center;<?php endif; ?>">
              <span class="blog-card-category"><?= htmlspecialchars($post->category_name ?? ($post->category ?? 'General')) ?></span>
            </div>
            <div class="blog-card-body">
              <div class="blog-card-meta">
                <span><i class="bi bi-calendar3"></i> <?= formatDate($post->published_at ?? $post->created_at ?? date('Y-m-d')) ?></span>
                <span><i class="bi bi-clock"></i> <?= (int)($post->reading_time ?? 5) ?> min read</span>
              </div>
              <h5><?= htmlspecialchars($post->title ?? '') ?></h5>
              <p><?= htmlspecialchars(truncate($post->excerpt ?? $post->content ?? '', 100)) ?></p>
              <a href="<?= route('blog/' . sanitize($post->slug ?? '')) ?>" class="card-link">Read More <i class="bi bi-arrow-right"></i></a>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <article class="blog-card" data-aos="fade-up">
          <div class="blog-card-image" style="background-image: linear-gradient(135deg, var(--color-off-white), var(--color-light-gray));">
            <span class="blog-card-category">Home Loan</span>
          </div>
          <div class="blog-card-body">
            <div class="blog-card-meta">
              <span><i class="bi bi-calendar3"></i> Jun 15, 2026</span>
              <span><i class="bi bi-clock"></i> 5 min read</span>
            </div>
            <h5>Top 10 Tips to Get Your Home Loan Approved Faster</h5>
            <p>Discover proven strategies to improve your home loan approval chances with expert tips...</p>
            <a href="<?= route('blog/tips-home-loan-approval') ?>" class="card-link">Read More <i class="bi bi-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card" data-aos="fade-up" data-aos-delay="100">
          <div class="blog-card-image" style="background-image: linear-gradient(135deg, #D4A843, #A8812A);">
            <span class="blog-card-category">Investment</span>
          </div>
          <div class="blog-card-body">
            <div class="blog-card-meta">
              <span><i class="bi bi-calendar3"></i> Jun 10, 2026</span>
              <span><i class="bi bi-clock"></i> 7 min read</span>
            </div>
            <h5>Smart Investment Strategies for 2026: A Complete Guide</h5>
            <p>Navigate the 2026 market with confidence. Expert analysis and actionable investment strategies...</p>
            <a href="<?= route('blog/investment-strategies-2026') ?>" class="card-link">Read More <i class="bi bi-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card" data-aos="fade-up" data-aos-delay="200">
          <div class="blog-card-image" style="background-image: linear-gradient(135deg, #10B981, #065F46);">
            <span class="blog-card-category">Personal Finance</span>
          </div>
          <div class="blog-card-body">
            <div class="blog-card-meta">
              <span><i class="bi bi-calendar3"></i> Jun 5, 2026</span>
              <span><i class="bi bi-clock"></i> 4 min read</span>
            </div>
            <h5>How to Improve Your CIBIL Score for Better Loan Rates</h5>
            <p>Simple daily habits that can boost your credit score and help you qualify for lower interest rates...</p>
            <a href="<?= route('blog/improve-cibil-score') ?>" class="card-link">Read More <i class="bi bi-arrow-right"></i></a>
          </div>
        </article>
      <?php endif; ?>
    </div>

    <div style="text-align:center;margin-top:var(--space-10);" data-aos="fade-up">
      <a href="<?= route('blog') ?>" class="btn btn-outline-primary btn-lg">
        View All Articles <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<section class="section section-light" id="instagram">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label"><i class="bi bi-instagram" style="color:#E4405F;"></i> Follow Us</span>
      <h2 class="section-title">@<?= htmlspecialchars(setting('instagram_username', 'pristinefinserve')) ?></h2>
      <p class="section-subtitle" style="margin:0 auto;">
        Stay connected with us on Instagram for the latest updates, financial tips, and success stories.
      </p>
    </div>

    <div class="grid-3-col" style="gap:var(--space-4);">
      <?php if (!empty($instagramPosts)): ?>
        <?php foreach ($instagramPosts as $post): ?>
          <a href="<?= htmlspecialchars($post->post_link ?? '#') ?>" target="_blank" rel="noopener" class="instagram-card" data-aos="fade-up" style="display:block;border-radius:var(--radius);overflow:hidden;position:relative;">
            <img src="<?= htmlspecialchars($post->image_url) ?>" alt="<?= htmlspecialchars($post->caption ?? 'Instagram post') ?>" style="width:100%;aspect-ratio:1;object-fit:cover;display:block;" loading="lazy">
            <?php if (!empty($post->caption)): ?>
              <div style="position:absolute;bottom:0;left:0;right:0;padding:var(--space-4);background:linear-gradient(transparent,rgba(0,0,0,0.7));color:#fff;font-size:var(--text-sm);">
                <?= htmlspecialchars(truncate($post->caption, 80)) ?>
              </div>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="instagram-card" data-aos="fade-up" style="border-radius:var(--radius);overflow:hidden;background:linear-gradient(135deg,#833AB4,#FD1D1D,#F77737);aspect-ratio:1;display:flex;align-items:center;justify-content:center;flex-direction:column;color:#fff;padding:var(--space-6);text-align:center;">
          <i class="bi bi-instagram" style="font-size:3rem;margin-bottom:var(--space-3);"></i>
          <p style="font-weight:600;margin-bottom:var(--space-2);">Follow us on Instagram</p>
          <a href="https://instagram.com/<?= htmlspecialchars(setting('instagram_username', 'pristinefinserve')) ?>" target="_blank" style="color:#fff;text-decoration:underline;font-size:var(--text-sm);">@<?= htmlspecialchars(setting('instagram_username', 'pristinefinserve')) ?></a>
        </div>
        <div class="instagram-card" data-aos="fade-up" data-aos-delay="100" style="border-radius:var(--radius);overflow:hidden;background:linear-gradient(135deg,#405DE6,#5851DB);aspect-ratio:1;display:flex;align-items:center;justify-content:center;flex-direction:column;color:#fff;padding:var(--space-6);text-align:center;">
          <i class="bi bi-camera" style="font-size:2.5rem;margin-bottom:var(--space-3);"></i>
          <p style="font-weight:600;">Behind the Scenes</p>
          <p style="font-size:var(--text-xs);opacity:0.8;">Get a glimpse of our team and culture</p>
        </div>
        <div class="instagram-card" data-aos="fade-up" data-aos-delay="200" style="border-radius:var(--radius);overflow:hidden;background:linear-gradient(135deg,#F77737,#FCAF45);aspect-ratio:1;display:flex;align-items:center;justify-content:center;flex-direction:column;color:#fff;padding:var(--space-6);text-align:center;">
          <i class="bi bi-star" style="font-size:2.5rem;margin-bottom:var(--space-3);"></i>
          <p style="font-weight:600;">Customer Stories</p>
          <p style="font-size:var(--text-xs);opacity:0.8;">Real success stories from our clients</p>
        </div>
      <?php endif; ?>
    </div>

    <div style="text-align:center;margin-top:var(--space-8);" data-aos="fade-up">
      <a href="https://instagram.com/<?= htmlspecialchars(setting('instagram_username', 'pristinefinserve')) ?>" target="_blank" class="btn btn-outline-primary btn-lg">
        <i class="bi bi-instagram"></i> Follow Us on Instagram
      </a>
    </div>
  </div>
</section>

<section class="section cta-section" id="cta">
  <div class="container">
    <div class="cta-content" data-aos="fade-up">
      <span class="section-label" style="color:var(--color-gold);">Get Started Today</span>
      <h2 class="display-2" style="color:var(--color-deep-navy);">
        Ready to Achieve Your<br>Financial Goals?
      </h2>
      <p>
        Take the first step towards financial freedom. Our experts are ready to help you
        find the perfect loan or investment solution tailored to your needs.
      </p>
      <div class="cta-actions">
        <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-lg">
          Apply Now <i class="bi bi-arrow-right"></i>
        </a>
        <a href="tel:<?= htmlspecialchars(setting('phone', '+919899360744')) ?>" class="btn btn-outline btn-lg">
          <i class="bi bi-telephone"></i> Call Us Now
        </a>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
