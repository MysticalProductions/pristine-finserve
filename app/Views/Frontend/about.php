<?php
$title = $title ?? 'About Us – Pristine Finserve';
$metaDescription = $metaDescription ?? 'Learn about Pristine Finserve\'s 15+ year journey, our mission, vision, leadership team, and why thousands trust us for financial solutions.';
$metaKeywords = $metaKeywords ?? 'about pristine finserve, financial consultants, team, mission, vision';
$currentPage = 'about';
ob_start();
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <span>About Us</span>
    </div>
    <h1 data-aos="fade-up">About Pristine Finserve</h1>
    <p data-aos="fade-up" data-aos-delay="100">
      India's trusted financial partner with 15+ years of expertise in delivering
      tailored loan and investment solutions.
    </p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="row grid-2-col-align-center" style="gap:var(--space-12);">
      <div data-aos="fade-right">
        <span class="section-label">Who We Are</span>
        <h2 class="section-title">Your Trusted Financial<br>Partner Since 2011</h2>
        <p style="margin-bottom:var(--space-4);">
          Pristine Finserve was founded with a singular vision — to democratize access to
          financial services and make quality financial advice accessible to everyone.
          Over the past 15 years, we have grown from a small consultancy to one of India's
          most trusted financial service providers.
        </p>
        <p style="margin-bottom:var(--space-4);">
          We have served over
          10,000 happy customers and facilitated loans worth ₹500+ Crores. Our team of
          200+ certified financial experts works tirelessly to ensure every client gets
          personalized attention and the best possible financial outcomes.
        </p>
        <p>
          We are proud to be empaneled with 50+ banks and NBFCs including SBI, HDFC,
          ICICI, Axis, Kotak, and Bajaj Finserv, allowing us to offer you the most
          competitive rates in the market.
        </p>
      </div>
      <div data-aos="fade-left" class="grid-2-col" style="gap:var(--space-4);">
        <?php if (!empty($statistics)): ?>
          <?php foreach (array_slice($statistics, 0, 4) as $i => $stat): ?>
            <?php $gradient = $i % 2 === 0 ? 'linear-gradient(135deg, var(--color-gold), #A8812A)' : 'var(--color-off-white)'; ?>
            <?php $textColor = $i % 2 === 0 ? 'rgba(255,255,255,0.8)' : 'var(--color-text-muted)'; ?>
            <div style="background:<?= $gradient ?>;border-radius:var(--radius-xl);padding:var(--space-8);text-align:center;<?= $i % 2 === 0 ? 'color:var(--color-white);' : 'border:1px solid var(--color-border);' ?>">
              <div style="font-size:var(--text-5xl);font-weight:700;font-family:var(--font-mono);<?= $i % 2 === 0 ? 'color:var(--color-white);' : 'color:var(--color-deep-navy);' ?>"><?= htmlspecialchars($stat->value ?? '') ?><?= htmlspecialchars($stat->suffix ?? '') ?></div>
              <div style="font-size:var(--text-sm);color:<?= $textColor ?>;"><?= htmlspecialchars($stat->label ?? '') ?></div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div style="background:linear-gradient(135deg, var(--color-gold), #A8812A);border-radius:var(--radius-xl);padding:var(--space-8);text-align:center;color:var(--color-white);">
            <div style="font-size:var(--text-5xl);font-weight:700;font-family:var(--font-mono);color:var(--color-white);">15+</div>
            <div style="font-size:var(--text-sm);color:rgba(255,255,255,0.8);">Years of Excellence</div>
          </div>
          <div style="background:var(--color-off-white);border-radius:var(--radius-xl);padding:var(--space-8);text-align:center;border:1px solid var(--color-border);">
            <div style="font-size:var(--text-5xl);font-weight:700;font-family:var(--font-mono);color:var(--color-deep-navy);">200+</div>
            <div style="font-size:var(--text-sm);color:var(--color-text-muted);">Expert Promoter</div>
          </div>
          <div style="background:var(--color-off-white);border-radius:var(--radius-xl);padding:var(--space-8);text-align:center;border:1px solid var(--color-border);">
            <div style="font-size:var(--text-5xl);font-weight:700;font-family:var(--font-mono);color:var(--color-deep-navy);">50+</div>
            <div style="font-size:var(--text-sm);color:var(--color-text-muted);">Bank Partners</div>
          </div>
          <div style="background:linear-gradient(135deg, var(--color-gold), #A8812A);border-radius:var(--radius-xl);padding:var(--space-8);text-align:center;color:var(--color-white);">
            <div style="font-size:var(--text-5xl);font-weight:700;font-family:var(--font-mono);">10K+</div>
            <div style="font-size:var(--text-sm);color:rgba(255,255,255,0.8);">Happy Customers</div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<section class="section section-light">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Our Purpose</span>
      <h2 class="section-title">Mission & Vision</h2>
    </div>
    <div class="mission-vision-grid">
      <?php
      $missionValues = [];
      $visionValues = [];
      if (!empty($values)) {
        foreach ($values as $val) {
          if (isset($val->type) && $val->type === 'mission') $missionValues[] = $val;
          elseif (isset($val->type) && $val->type === 'vision') $visionValues[] = $val;
        }
      }
      ?>
      <?php if (!empty($missionValues)): ?>
        <?php foreach ($missionValues as $mv): ?>
          <div class="mv-card" data-aos="fade-right">
            <div class="icon"><?= htmlspecialchars($mv->icon ?? '🎯') ?></div>
            <h4 style="margin-bottom:var(--space-3);"><?= htmlspecialchars($mv->title ?? 'Our Mission') ?></h4>
            <p><?= htmlspecialchars($mv->description ?? '') ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="mv-card" data-aos="fade-right">
          <div class="icon">🎯</div>
          <h4 style="margin-bottom:var(--space-3);">Our Mission</h4>
          <p>
            To empower individuals and businesses with accessible, transparent, and
            personalized financial solutions that help them achieve their goals and
            build lasting prosperity. We are committed to simplifying finance and
            making expert guidance available to all.
          </p>
        </div>
      <?php endif; ?>
      <?php if (!empty($visionValues)): ?>
        <?php foreach ($visionValues as $vv): ?>
          <div class="mv-card" data-aos="fade-left">
            <div class="icon"><?= htmlspecialchars($vv->icon ?? '🔭') ?></div>
            <h4 style="margin-bottom:var(--space-3);"><?= htmlspecialchars($vv->title ?? 'Our Vision') ?></h4>
            <p><?= htmlspecialchars($vv->description ?? '') ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="mv-card" data-aos="fade-left">
          <div class="icon">🔭</div>
          <h4 style="margin-bottom:var(--space-3);">Our Vision</h4>
          <p>
            To be India's most trusted financial services platform, recognized for
            innovation, integrity, and impact. We envision a future where every
            Indian has access to fair, transparent, and expert financial guidance
            tailored to their unique needs.
          </p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Our Values</span>
      <h2 class="section-title">What Drives Us</h2>
    </div>
    <div class="grid-4-col" style="gap:var(--space-6);">
      <?php
      $companyValues = [];
      if (!empty($values)) {
        foreach ($values as $val) {
          if (!isset($val->type) || ($val->type !== 'mission' && $val->type !== 'vision')) {
            $companyValues[] = $val;
          }
        }
      }
      ?>
      <?php if (!empty($companyValues)): ?>
        <?php foreach ($companyValues as $i => $val): ?>
          <div class="card" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>" style="text-align:center;">
            <div class="card-icon <?= ['blue', 'gold', 'green', 'purple'][$i % 4] ?>" style="margin:0 auto var(--space-4);">
              <i class="bi bi-<?= htmlspecialchars($val->icon ?? 'shield-check') ?>"></i>
            </div>
            <h5><?= htmlspecialchars($val->title ?? '') ?></h5>
            <p><?= htmlspecialchars($val->description ?? '') ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="card" data-aos="fade-up" style="text-align:center;">
          <div class="card-icon blue" style="margin:0 auto var(--space-4);"><i class="bi bi-shield-check"></i></div>
          <h5>Integrity</h5>
          <p>We uphold the highest ethical standards in every interaction, ensuring complete transparency.</p>
        </div>
        <div class="card" data-aos="fade-up" data-aos-delay="100" style="text-align:center;">
          <div class="card-icon gold" style="margin:0 auto var(--space-4);"><i class="bi bi-people"></i></div>
          <h5>Customer First</h5>
          <p>Every decision we make starts with what's best for our customers and their financial well-being.</p>
        </div>
        <div class="card" data-aos="fade-up" data-aos-delay="200" style="text-align:center;">
          <div class="card-icon green" style="margin:0 auto var(--space-4);"><i class="bi bi-lightbulb"></i></div>
          <h5>Innovation</h5>
          <p>We leverage technology to simplify finance and deliver faster, smarter solutions.</p>
        </div>
        <div class="card" data-aos="fade-up" data-aos-delay="300" style="text-align:center;">
          <div class="card-icon purple" style="margin:0 auto var(--space-4);"><i class="bi bi-graph-up-arrow"></i></div>
          <h5>Excellence</h5>
          <p>We strive for excellence in everything we do, continuously raising the bar.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section section-light" id="team">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Our Promoter</span>
      <h2 class="section-title">Meet Our Promoter</h2>
      <p class="section-subtitle" style="margin:0 auto;">Experienced leader driving financial excellence</p>
    </div>
    <div class="team-grid" style="grid-template-columns:repeat(auto-fit,minmax(280px,340px));justify-content:center;max-width:520px;margin:0 auto;">
      <?php if (!empty($teamMembers)): ?>
        <?php foreach ($teamMembers as $i => $member): ?>
          <div class="team-card" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
            <?php if (!empty($member->photo)): ?>
              <div class="team-image">
                <img src="<?= uploadUrl($member->photo) ?>" alt="<?= htmlspecialchars($member->name ?? '') ?>" style="width:100%;height:100%;object-fit:cover;">
              </div>
            <?php else: ?>
              <div class="team-image" style="background:linear-gradient(135deg, var(--color-deep-navy), #152d5e);display:flex;align-items:center;justify-content:center;color:white;font-size:3rem;font-weight:700;">
                <?= htmlspecialchars($member->initials ?? substr($member->name ?? 'TM', 0, 2)) ?>
              </div>
            <?php endif; ?>
            <div class="team-info">
              <h5><?= htmlspecialchars($member->name ?? '') ?></h5>
              <div class="designation"><?= htmlspecialchars($member->designation ?? '') ?></div>
              <p><?= htmlspecialchars(truncate($member->bio ?? '', 100)) ?></p>
              <?php if (!empty($member->linkedin)): ?>
                <a href="<?= htmlspecialchars($member->linkedin) ?>" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;gap:6px;color:#0A66C2;font-size:var(--text-sm);font-weight:600;text-decoration:none;">
                  <i class="bi bi-linkedin"></i> LinkedIn
                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="team-card" data-aos="fade-up">
          <div class="team-image" style="background:linear-gradient(135deg, var(--color-deep-navy), #152d5e);display:flex;align-items:center;justify-content:center;color:white;font-size:3rem;font-weight:700;">VG</div>
          <div class="team-info">
            <h5>Vikas Giri</h5>
            <div class="designation">Founder & Promoter</div>
            <p>21+ years in banking and financial services. Ex-Hero FinCorp, Indiabulls Housing Finance & Fullerton India.</p>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section section-light">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Achievements</span>
      <h2 class="section-title">Our Milestones</h2>
    </div>
    <div class="achievement-grid">
      <?php if (!empty($achievements)): ?>
        <?php foreach ($achievements as $i => $achievement): ?>
          <div class="achievement-card" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
            <div class="achievement-number"><?= htmlspecialchars($achievement->value ?? '') ?></div>
            <div class="achievement-label"><?= htmlspecialchars($achievement->label ?? '') ?></div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="achievement-card" data-aos="fade-up">
          <div class="achievement-number">500+</div>
          <div class="achievement-label">Crores Sanctioned</div>
        </div>
        <div class="achievement-card" data-aos="fade-up" data-aos-delay="100">
          <div class="achievement-number">10K+</div>
          <div class="achievement-label">Happy Customers</div>
        </div>
        <div class="achievement-card" data-aos="fade-up" data-aos-delay="200">
          <div class="achievement-number">50+</div>
          <div class="achievement-label">Bank Partners</div>
        </div>
        <div class="achievement-card" data-aos="fade-up" data-aos-delay="300">
          <div class="achievement-number">4.9★</div>
          <div class="achievement-label">Customer Rating</div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section cta-section">
  <div class="container">
    <div class="cta-content" data-aos="fade-up">
      <span class="section-label" style="color:var(--color-gold);">Join 10,000+ Happy Customers</span>
      <h2 class="display-2" style="color:var(--color-deep-navy);">Start Your Financial Journey Today</h2>
      <p>Let our experts guide you towards the best financial solutions tailored to your needs.</p>
      <div class="cta-actions">
        <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-lg">Get Started <i class="bi bi-arrow-right"></i></a>
        <a href="tel:<?= htmlspecialchars(setting('phone', '+919899360744')) ?>" class="btn btn-outline btn-lg"><i class="bi bi-telephone"></i> Call Us</a>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
