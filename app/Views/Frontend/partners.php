<?php
$title = $title ?? 'Our Partners – Pristine Finserve';
$metaDescription = $metaDescription ?? 'Pristine Finserve is proud to be empaneled with 50+ leading banks and NBFCs including SBI, HDFC, ICICI, Axis, and more.';
$metaKeywords = $metaKeywords ?? 'bank partners, NBFC partners, financial partners, SBI, HDFC, ICICI, Axis, pristine finserve';
$currentPage = 'partners';
ob_start();
?>

<section class="page-hero page-hero-sm">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <span>Partners</span>
    </div>
    <h1 data-aos="fade-up">Our Banking Partners</h1>
    <p data-aos="fade-up" data-aos-delay="100">We are proud to be empaneled with 50+ leading banks and financial institutions.</p>
  </div>
</section>

<section class="section section-dark" style="padding:var(--space-12) 0;">
  <div class="container">
    <div class="stats-grid">
      <?php
      $bankCount = count($grouped['bank'] ?? $grouped['banks'] ?? []);
      $nbfcCount = count($grouped['nbfc'] ?? $grouped['nbfcs'] ?? []);
      $insuranceCount = count($grouped['insurance'] ?? []);
      $otherCount = count($grouped['other'] ?? []);
      $totalPartners = count($partners ?? []);
      ?>
      <div class="stat-item">
        <div class="stat-number"><?= $bankCount > 0 ? $bankCount . '+' : '50+' ?></div>
        <div class="stat-label">Bank Partners</div>
      </div>
      <div class="stat-item">
        <div class="stat-number"><?= $nbfcCount > 0 ? $nbfcCount . '+' : '25+' ?></div>
        <div class="stat-label">NBFC Partners</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">500+</div>
        <div class="stat-label">Branches Pan-India</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">98%</div>
        <div class="stat-label">Approval Rate</div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <?php
    $tabTypes = [
      'banks' => 'Banks',
      'nbfcs' => 'NBFCs',
      'insurance' => 'Insurance Partners',
      'other' => 'Other Partners',
    ];
    $typeKeys = ['banks' => ['bank', 'banks'], 'nbfcs' => ['nbfc', 'nbfcs'], 'insurance' => ['insurance'], 'other' => ['other', 'general']];

    $hasTabs = false;
    foreach ($typeKeys as $tk => $keys) {
      foreach ($keys as $k) {
        if (!empty($grouped[$k])) { $hasTabs = true; break; }
      }
    }

    $activeSet = false;
    ?>
    <?php if ($hasTabs || empty($partners)): ?>
    <div class="tabs" data-aos="fade-up">
      <?php foreach ($tabTypes as $tabId => $tabLabel): ?>
        <?php
        $hasItems = false;
        if (!empty($partners)) {
          foreach ($typeKeys[$tabId] as $k) {
            if (!empty($grouped[$k])) { $hasItems = true; break; }
          }
        }
        ?>
        <button class="tab <?= (!$activeSet && ($hasItems || empty($partners))) ? 'active' : '' ?> <?= $activeSet ? '' : '' ?>" data-tab="<?= $tabId ?>" onclick="switchTab('<?= $tabId ?>')">
          <?= $tabLabel ?>
        </button>
        <?php if (!$activeSet && ($hasItems || empty($partners))) $activeSet = true; ?>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php
    $tabContents = [
      'banks' => ['colors' => ['#820A1F', '#004C8E', '#F58220', '#8C2020', '#C8102E', '#003087', '#005A9C', '#0077B5'], 'key' => 'bank'],
      'nbfcs' => ['color' => 'var(--color-deep-navy)', 'key' => 'nbfc'],
      'insurance' => ['color' => 'var(--color-deep-navy)', 'key' => 'insurance'],
      'other' => ['color' => 'var(--color-deep-navy)', 'key' => 'other'],
    ];
    ?>

    <?php foreach ($tabContents as $tabId => $tabInfo): ?>
      <?php
      $tabGroup = null;
      foreach ($typeKeys[$tabId] as $k) {
        if (!empty($grouped[$k])) { $tabGroup = $grouped[$k]; break; }
      }
      ?>
      <div id="<?= $tabId ?>" class="tab-content <?= $tabId === 'banks' ? 'active' : '' ?>">
        <?php if (!empty($tabGroup)): ?>
          <div class="grid-4-col" style="gap:var(--space-6);">
            <?php foreach ($tabGroup as $pi => $partner): ?>
              <?php $brandColor = isset($tabInfo['colors']) ? $tabInfo['colors'][$pi % count($tabInfo['colors'])] : $tabInfo['color']; ?>
              <?php $delay = ($pi % 4) * 50; ?>
              <?php $partnerUrl = !empty($partner->website) ? $partner->website : (!empty($partner->url) ? $partner->url : ''); ?>
              <?php $tag = $partnerUrl ? 'a' : 'div'; ?>
              <<?= $tag ?> <?= $partnerUrl ? 'href="' . htmlspecialchars($partnerUrl) . '" target="_blank" rel="noopener"' : '' ?> style="padding:var(--space-8);border:1px solid var(--color-border);border-radius:var(--radius-lg);text-align:center;transition:all var(--transition-base);text-decoration:none;display:block;" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                <?php if (!empty($partner->logo)): ?>
                  <img src="<?= uploadUrl(htmlspecialchars($partner->logo)) ?>" alt="<?= htmlspecialchars($partner->name ?? '') ?>" style="max-height:60px;margin:0 auto var(--space-3);object-fit:contain;display:block;">
                <?php else: ?>
                  <div style="font-size:var(--text-3xl);font-weight:700;color:<?= $brandColor ?>;margin-bottom:var(--space-2);">
                    <?= htmlspecialchars($partner->short_name ?? $partner->name ?? '') ?>
                  </div>
                <?php endif; ?>
                <?php if (!empty($partner->name) && empty($partner->short_name)): ?>
                <?php endif; ?>
                <div style="font-size:var(--text-sm);color:var(--color-text-muted);">
                  <?= htmlspecialchars($partner->description ?? $partner->full_name ?? $partner->name ?? '') ?>
                </div>
                <?php if (!empty($partner->type) && $tabId === 'other'): ?>
                  <span style="display:inline-block;margin-top:var(--space-2);font-size:var(--text-xs);background:var(--color-off-white);padding:2px 8px;border-radius:var(--radius-sm);color:var(--color-text-muted);">
                    <?= htmlspecialchars(ucfirst($partner->type)) ?>
                  </span>
                <?php endif; ?>
              </<?= $tag ?>>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <?php if ($tabId === 'banks' && empty($partners)): ?>
          <div class="grid-4-col" style="gap:var(--space-6);">
            <?php $defaultBanks = [
              ['name' => 'SBI', 'full' => 'State Bank of India', 'color' => '#820A1F'],
              ['name' => 'HDFC', 'full' => 'HDFC Bank Ltd.', 'color' => '#004C8E'],
              ['name' => 'ICICI', 'full' => 'ICICI Bank', 'color' => '#F58220'],
              ['name' => 'AXIS', 'full' => 'Axis Bank', 'color' => '#8C2020'],
              ['name' => 'Kotak', 'full' => 'Kotak Mahindra Bank', 'color' => '#C8102E'],
              ['name' => 'Yes Bank', 'full' => 'Yes Bank Ltd.', 'color' => '#003087'],
              ['name' => 'PNB', 'full' => 'Punjab National Bank', 'color' => '#005A9C'],
              ['name' => 'BOB', 'full' => 'Bank of Baroda', 'color' => '#0077B5'],
            ]; ?>
            <?php foreach ($defaultBanks as $bi => $bank): ?>
              <?php $delay = ($bi % 4) * 50; ?>
              <div style="padding:var(--space-8);border:1px solid var(--color-border);border-radius:var(--radius-lg);text-align:center;transition:all var(--transition-base);" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                <div style="font-size:var(--text-3xl);font-weight:700;color:<?= $bank['color'] ?>;margin-bottom:var(--space-2);"><?= $bank['name'] ?></div>
                <div style="font-size:var(--text-sm);color:var(--color-text-muted);"><?= $bank['full'] ?></div>
              </div>
            <?php endforeach; ?>
          </div>
          <?php elseif ($tabId === 'nbfcs' && empty($partners)): ?>
          <div class="grid-4-col" style="gap:var(--space-6);">
            <?php $defaultNbfcs = [
              ['name' => 'Bajaj Finserv', 'desc' => 'Leading NBFC'],
              ['name' => 'Tata Capital', 'desc' => 'Tata Group NBFC'],
              ['name' => 'Aditya Birla', 'desc' => 'Aditya Birla Capital'],
              ['name' => 'LIC Housing', 'desc' => 'LIC Housing Finance'],
            ]; ?>
            <?php foreach ($defaultNbfcs as $ni => $nbfc): ?>
              <div style="padding:var(--space-8);border:1px solid var(--color-border);border-radius:var(--radius-lg);text-align:center;">
                <div style="font-size:var(--text-2xl);font-weight:700;color:var(--color-deep-navy);margin-bottom:var(--space-2);"><?= $nbfc['name'] ?></div>
                <div style="font-size:var(--text-sm);color:var(--color-text-muted);"><?= $nbfc['desc'] ?></div>
              </div>
            <?php endforeach; ?>
          </div>
          <?php elseif ($tabId === 'insurance' && empty($partners)): ?>
          <div class="grid-4-col" style="gap:var(--space-6);">
            <?php $defaultInsurance = [
              ['name' => 'LIC', 'desc' => 'Life Insurance Corp.'],
              ['name' => 'HDFC Life', 'desc' => 'HDFC Life Insurance'],
              ['name' => 'ICICI Prudential', 'desc' => 'ICICI Prudential Life'],
              ['name' => 'SBI Life', 'desc' => 'SBI Life Insurance'],
            ]; ?>
            <?php foreach ($defaultInsurance as $ii => $ins): ?>
              <div style="padding:var(--space-8);border:1px solid var(--color-border);border-radius:var(--radius-lg);text-align:center;">
                <div style="font-size:var(--text-2xl);font-weight:700;color:var(--color-deep-navy);margin-bottom:var(--space-2);"><?= $ins['name'] ?></div>
                <div style="font-size:var(--text-sm);color:var(--color-text-muted);"><?= $ins['desc'] ?></div>
              </div>
            <?php endforeach; ?>
          </div>
          <?php else: ?>
          <div style="text-align:center;padding:var(--space-10);color:var(--color-text-muted);">
            <p>No partners listed in this category yet.</p>
          </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<script>
function switchTab(tab) {
  document.querySelectorAll('.tab-content').forEach(function(t) { t.classList.remove('active'); });
  document.querySelectorAll('.tab').forEach(function(t) { t.classList.remove('active'); });
  var el = document.getElementById(tab);
  if (el) el.classList.add('active');
  var btn = document.querySelector('.tab[data-tab="' + tab + '"]');
  if (btn) btn.classList.add('active');
}
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
