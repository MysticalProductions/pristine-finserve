<?php
$page = $page ?? null;
$title = $title ?? ($page->meta_title ?: ($page->title . ' – Pristine Finserve'));
$metaDescription = $metaDescription ?? ($page->meta_description ?: truncate(strip_tags($page->content ?? ''), 160));
$metaKeywords = $metaKeywords ?? ($page->meta_keywords ?? '');
$currentPage = 'legal';
ob_start();
?>

<section class="page-hero" style="padding-bottom:0;">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <span><?= htmlspecialchars($page->title ?? '') ?></span>
    </div>
  </div>
</section>

<section class="section" style="padding-top:var(--space-6);">
  <div class="container">
    <div class="legal-content" style="max-width:840px;margin:0 auto;">
      <h1 style="margin-bottom:var(--space-4);color:var(--color-deep-navy);"><?= htmlspecialchars($page->title ?? '') ?></h1>
      <p style="font-size:0.85rem;color:var(--color-text-muted);margin-bottom:var(--space-8);">
        Last updated: <?= formatDate($page->updated_at ?? date('Y-m-d H:i:s'), 'F d, Y') ?>
      </p>
      <div style="line-height:1.8;font-size:0.95rem;">
        <?= $page->content ?? '<p>No content available.</p>' ?>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
