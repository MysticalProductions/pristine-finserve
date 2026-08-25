<?php
$title = $title ?? 'Gallery – Pristine Finserve';
$metaDescription = $metaDescription ?? 'Photo and video gallery showcasing Pristine Finserve events, office, team, and customer success stories.';
$metaKeywords = $metaKeywords ?? 'gallery, photos, videos, events, pristine finserve, team, office';
$currentPage = 'gallery';
ob_start();
?>

<section class="page-hero page-hero-sm">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <span>Gallery</span>
    </div>
    <h1 data-aos="fade-up">Media Gallery</h1>
    <p data-aos="fade-up" data-aos-delay="100">Explore our events, office, team activities, and customer success stories.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <?php
    $tabTypes = ['photos', 'videos', 'events'];
    $tabLabels = ['Photos', 'Videos', 'Events'];
    $hasAny = false;
    foreach ($tabTypes as $t) {
      if (!empty($grouped[$t])) { $hasAny = true; break; }
    }
    ?>

    <div class="tabs" data-aos="fade-up">
      <?php if ($hasAny || empty($items)): ?>
        <?php foreach ($tabTypes as $i => $tab): ?>
          <?php if (!empty($grouped[$tab]) || !$hasAny): ?>
            <button class="tab <?= $i === 0 ? 'active' : '' ?>" data-tab="<?= $tab ?>" onclick="switchTab('<?= $tab ?>')"><?= $tabLabels[$i] ?></button>
          <?php endif; ?>
        <?php endforeach; ?>
        <?php if (!empty($categories)): ?>
          <?php foreach ($categories as $cat): ?>
            <button class="tab" data-tab="<?= sanitize($cat) ?>" onclick="switchTab('<?= sanitize($cat) ?>')"><?= htmlspecialchars(ucfirst($cat)) ?></button>
          <?php endforeach; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <?php if (!empty($grouped['photos'])): ?>
    <div id="photos" class="tab-content active">
      <div class="gallery-grid">
        <?php foreach ($grouped['photos'] as $i => $item): ?>
          <?php $delay = ($i % 4) * 50; ?>
          <div class="gallery-item" data-aos="fade-up" data-aos-delay="<?= $delay ?>" onclick="openLightbox('<?= htmlspecialchars(uploadUrl($item->image ?? $item->file ?? '')) ?>', '<?= htmlspecialchars($item->title ?? '', ENT_QUOTES) ?>')">
            <?php if (!empty($item->image) || !empty($item->file)): ?>
              <img src="<?= htmlspecialchars(uploadUrl($item->image ?? $item->file)) ?>" alt="<?= htmlspecialchars($item->title ?? 'Gallery image') ?>" loading="lazy">
            <?php else: ?>
              <img src="https://placehold.co/400x400/1B5AAE/FFFFFF?text=<?= urlencode($item->title ?? 'Image') ?>" alt="<?= htmlspecialchars($item->title ?? 'Gallery image') ?>" loading="lazy">
            <?php endif; ?>
            <div class="overlay"><span><i class="bi bi-arrows-fullscreen"></i></span></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php elseif (empty($items)): ?>
    <div id="photos" class="tab-content active">
      <div class="gallery-grid">
        <?php $placeholders = ['Office', 'Team', 'Event', 'Client Meeting', 'Award', 'Workshop', 'Celebration', 'Conference']; ?>
        <?php $colors = ['1B5AAE', 'D4A843', '10B981', '8B5CF6', 'EF4444', '1B5AAE', 'D4A843', '10B981']; ?>
        <?php foreach ($placeholders as $pi => $pl): ?>
          <?php $delay = ($pi % 4) * 50; ?>
          <div class="gallery-item" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
            <img src="https://placehold.co/400x400/<?= $colors[$pi] ?>/FFFFFF?text=<?= urlencode($pl) ?>" alt="<?= $pl ?>" loading="lazy">
            <div class="overlay"><span><i class="bi bi-arrows-fullscreen"></i></span></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($grouped['videos'])): ?>
    <div id="videos" class="tab-content">
      <div class="gallery-grid">
        <?php foreach ($grouped['videos'] as $i => $item): ?>
          <?php $delay = ($i % 4) * 50; ?>
          <div class="gallery-item" style="aspect-ratio:16/9;" data-aos="fade-up" data-aos-delay="<?= $delay ?>" onclick="<?= !empty($item->video_url) ? "window.open('" . htmlspecialchars($item->video_url, ENT_QUOTES) . "','_blank')" : '' ?>">
            <?php if (!empty($item->thumbnail) || !empty($item->image)): ?>
              <img src="<?= htmlspecialchars(uploadUrl($item->thumbnail ?? $item->image)) ?>" alt="<?= htmlspecialchars($item->title ?? 'Video') ?>" loading="lazy">
            <?php else: ?>
              <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='640' height='360' viewBox='0 0 640 360'%3E%3Crect width='640' height='360' fill='%230A1F44'/%3E%3Cpolygon points='280,110 280,250 420,180' fill='white'/%3E%3C/svg%3E" alt="Video" loading="lazy">
            <?php endif; ?>
            <div class="overlay"><span><i class="bi bi-play-circle"></i></span></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($grouped['events'])): ?>
    <div id="events" class="tab-content">
      <div class="gallery-grid">
        <?php foreach ($grouped['events'] as $i => $item): ?>
          <?php $delay = ($i % 4) * 50; ?>
          <div class="gallery-item" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
            <?php if (!empty($item->image) || !empty($item->file)): ?>
              <img src="<?= htmlspecialchars(uploadUrl($item->image ?? $item->file)) ?>" alt="<?= htmlspecialchars($item->title ?? 'Event') ?>" loading="lazy">
            <?php else: ?>
              <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 400 400'%3E%3Crect width='400' height='400' fill='%23D4A843'/%3E%3Ctext x='200' y='210' text-anchor='middle' fill='white' font-size='20' font-family='Arial'%3EEvent%3C/text%3E%3C/svg%3E" alt="Event" loading="lazy">
            <?php endif; ?>
            <div class="overlay"><span><i class="bi bi-arrows-fullscreen"></i></span></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php else: ?>
    <div id="events" class="tab-content">
      <div style="max-width:700px;margin:0 auto;text-align:center;padding:var(--space-10);color:var(--color-text-muted);">
        <div style="font-size:4rem;margin-bottom:var(--space-4);opacity:0.3;">📅</div>
        <h4>No events yet</h4>
        <p>Check back soon for upcoming events and webinars.</p>
      </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($categories)): ?>
      <?php foreach ($categories as $cat): ?>
        <div id="<?= sanitize($cat) ?>" class="tab-content">
          <div class="gallery-grid">
            <?php $catItems = array_filter($items ?? [], function($it) use ($cat) { return ($it->category ?? '') === $cat; }); ?>
            <?php if (!empty($catItems)): ?>
              <?php foreach ($catItems as $ci => $item): ?>
                <?php $delay = ($ci % 4) * 50; ?>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="<?= $delay ?>" onclick="openLightbox('<?= htmlspecialchars(uploadUrl($item->image ?? $item->file ?? '')) ?>', '<?= htmlspecialchars($item->title ?? '', ENT_QUOTES) ?>')">
                  <?php if (!empty($item->image) || !empty($item->file)): ?>
                    <img src="<?= htmlspecialchars(uploadUrl($item->image ?? $item->file)) ?>" alt="<?= htmlspecialchars($item->title ?? $cat) ?>" loading="lazy">
                  <?php endif; ?>
                  <div class="overlay"><span><i class="bi bi-arrows-fullscreen"></i></span></div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<div id="lightbox" class="lightbox-overlay" style="display:none;" onclick="closeLightbox()">
  <span class="lightbox-close">&times;</span>
  <img class="lightbox-image" id="lightboxImage" src="" alt="">
  <div class="lightbox-caption" id="lightboxCaption"></div>
</div>

<script>
function switchTab(tab) {
  document.querySelectorAll('.tab-content').forEach(function(t) { t.classList.remove('active'); });
  document.querySelectorAll('.tab').forEach(function(t) { t.classList.remove('active'); });
  var el = document.getElementById(tab);
  if (el) el.classList.add('active');
  var btn = document.querySelector('.tab[data-tab="' + tab + '"]');
  if (btn) btn.classList.add('active');
}

function openLightbox(src, caption) {
  var lb = document.getElementById('lightbox');
  document.getElementById('lightboxImage').src = src;
  document.getElementById('lightboxCaption').textContent = caption || '';
  lb.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}

function closeLightbox() {
  document.getElementById('lightbox').style.display = 'none';
  document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeLightbox();
});
</script>

<style>
.lightbox-overlay {
  position: fixed; top: 0; left: 0; width: 100%; height: 100%;
  background: rgba(0,0,0,0.92); z-index: 99999;
  display: flex; align-items: center; justify-content: center;
  flex-direction: column; cursor: pointer;
}
.lightbox-image {
  max-width: 90%; max-height: 80vh; object-fit: contain;
  border-radius: 8px; cursor: default;
}
.lightbox-caption {
  color: white; margin-top: var(--space-4);
  font-size: var(--text-lg); text-align: center;
}
.lightbox-close {
  position: absolute; top: 20px; right: 30px;
  font-size: 3rem; color: white; cursor: pointer;
  transition: opacity 0.2s;
}
.lightbox-close:hover { opacity: 0.7; }
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
