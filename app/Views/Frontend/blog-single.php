<?php
$title = $title ?? ($post->title ?? 'Blog Post') . ' – Pristine Finserve';
$metaDescription = $metaDescription ?? truncate(strip_tags($post->excerpt ?? $post->content ?? ''), 160);
$metaKeywords = $metaKeywords ?? ($post->meta_keywords ?? '');
$currentPage = 'blog';
ob_start();
?>

<section class="page-hero" style="padding-bottom:0;">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <a href="<?= route('blog') ?>">Blog</a>
      <span class="sep">/</span>
      <span><?= htmlspecialchars($post->title ?? '') ?></span>
    </div>
  </div>
</section>

<section class="section" style="padding-top:var(--space-6);">
  <div class="container">
    <div class="grid-sidebar-layout">
      <article>
        <div style="margin-bottom:var(--space-6);">
          <span style="display:inline-block;padding:4px 12px;background:var(--color-gold);color:var(--color-white);border-radius:50px;font-size:0.75rem;font-weight:600;margin-bottom:var(--space-4);">
            <?= htmlspecialchars($post->category_name ?? ($post->category ?? 'General')) ?>
          </span>
          <h1 style="font-size:2rem;line-height:1.3;margin-bottom:var(--space-3);"><?= htmlspecialchars($post->title ?? '') ?></h1>
          <div style="display:flex;align-items:center;gap:var(--space-4);font-size:0.85rem;color:var(--color-text-muted);flex-wrap:wrap;">
            <span><i class="bi bi-person"></i> <?= htmlspecialchars($post->author_name ?? 'Pristine Finserve') ?></span>
            <span><i class="bi bi-calendar3"></i> <?= formatDate($post->published_at ?? $post->created_at ?? date('Y-m-d')) ?></span>
            <span><i class="bi bi-clock"></i> <?= (int)($post->reading_time ?? 5) ?> min read</span>
          </div>
        </div>

        <?php if (!empty($post->featured_image)): ?>
          <div style="border-radius:var(--radius-xl);overflow:hidden;margin-bottom:var(--space-8);">
            <img src="<?= uploadUrl($post->featured_image) ?>" alt="<?= htmlspecialchars($post->title ?? '') ?>" style="width:100%;height:auto;display:block;">
          </div>
        <?php endif; ?>

        <div style="line-height:1.8;font-size:1rem;">
          <?= $post->content ?? '<p>No content available.</p>' ?>
        </div>

        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:var(--space-8);padding-top:var(--space-6);border-top:1px solid var(--color-border);flex-wrap:wrap;gap:var(--space-4);">
          <div style="display:flex;align-items:center;gap:var(--space-3);">
            <span style="font-weight:600;">Share:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(route('blog/' . sanitize($post->slug ?? ''))) ?>" target="_blank" rel="noopener" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:#1877F2;color:white;text-decoration:none;"><i class="bi bi-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?text=<?= urlencode(htmlspecialchars($post->title ?? '')) ?>&url=<?= urlencode(route('blog/' . sanitize($post->slug ?? ''))) ?>" target="_blank" rel="noopener" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:#1DA1F2;color:white;text-decoration:none;"><i class="bi bi-twitter-x"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode(route('blog/' . sanitize($post->slug ?? ''))) ?>&title=<?= urlencode(htmlspecialchars($post->title ?? '')) ?>" target="_blank" rel="noopener" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:#0A66C2;color:white;text-decoration:none;"><i class="bi bi-linkedin"></i></a>
            <a href="https://api.whatsapp.com/send?text=<?= urlencode(htmlspecialchars($post->title ?? '') . ' ' . route('blog/' . sanitize($post->slug ?? ''))) ?>" target="_blank" rel="noopener" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:#25D366;color:white;text-decoration:none;"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>

        <?php if (!empty($post->author_bio ?? $post->author_name ?? '')): ?>
          <div style="margin-top:var(--space-8);padding:var(--space-6);background:var(--color-off-white);border-radius:var(--radius-lg);display:flex;align-items:center;gap:var(--space-4);">
            <div style="width:60px;height:60px;border-radius:50%;background:linear-gradient(135deg, var(--color-gold), #A8812A);display:flex;align-items:center;justify-content:center;color:var(--color-white);font-weight:700;font-size:1.25rem;flex-shrink:0;">
              <?= strtoupper(substr($post->author_name ?? 'PF', 0, 2)) ?>
            </div>
            <div>
              <h6 style="margin-bottom:2px;"><?= htmlspecialchars($post->author_name ?? 'Pristine Finserve') ?></h6>
              <p style="font-size:0.85rem;color:var(--color-text-muted);margin-bottom:0;"><?= htmlspecialchars($post->author_bio ?? 'Financial expert at Pristine Finserve') ?></p>
            </div>
          </div>
        <?php endif; ?>
      </article>

      <aside>
        <div style="position:sticky;top:calc(var(--navbar-height) + var(--space-6));">
          <div class="card" style="padding:var(--space-6);margin-bottom:var(--space-6);">
            <h5 style="margin-bottom:var(--space-4);">Search</h5>
            <form action="<?= route('blog') ?>" method="GET">
              <div class="form-group" style="margin-bottom:0;">
                <div style="display:flex;">
                  <input type="text" name="search" class="form-control" placeholder="Search articles..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" style="border-radius:var(--radius-lg) 0 0 var(--radius-lg);">
                  <button type="submit" style="padding:10px 16px;background:var(--color-royal-blue);color:var(--color-white);border:none;border-radius:0 var(--radius-lg) var(--radius-lg) 0;cursor:pointer;">
                    <i class="bi bi-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>

          <div class="card" style="padding:var(--space-6);margin-bottom:var(--space-6);">
            <h5 style="margin-bottom:var(--space-4);">Categories</h5>
            <ul style="list-style:none;padding:0;">
              <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                  <li style="margin-bottom:var(--space-2);">
                    <a href="<?= route('blog?category=' . sanitize($cat->slug ?? $cat->id ?? '')) ?>" style="display:flex;justify-content:space-between;align-items:center;padding:var(--space-2) 0;color:var(--color-text-secondary);text-decoration:none;transition:color 0.15s;">
                      <span><?= htmlspecialchars($cat->name ?? '') ?></span>
                      <span style="font-size:0.8rem;color:var(--color-text-muted);">(<?= (int)($cat->post_count ?? 0) ?>)</span>
                    </a>
                  </li>
                <?php endforeach; ?>
              <?php else: ?>
                <li style="margin-bottom:var(--space-2);"><a href="#" style="color:var(--color-text-muted);">No categories yet</a></li>
              <?php endif; ?>
            </ul>
          </div>

          <div class="card" style="padding:var(--space-6);background:var(--color-white);border:1px solid var(--color-border);text-align:center;">
            <h5 style="color:var(--color-deep-navy);margin-bottom:var(--space-3);">Subscribe</h5>
            <p style="font-size:0.85rem;color:var(--color-text-muted);margin-bottom:var(--space-4);">Get the latest financial tips delivered to your inbox.</p>
            <form action="<?= route('newsletter/subscribe') ?>" method="POST">
              <?= csrfField() ?>
              <input type="email" name="email" class="form-control" placeholder="Your email" required style="margin-bottom:var(--space-3);">
              <button type="submit" class="btn btn-gold" style="width:100%;">Subscribe</button>
            </form>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php if (!empty($relatedPosts)): ?>
<section class="section section-light">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Related Articles</span>
      <h2 class="section-title">You May Also Like</h2>
    </div>
    <div class="blog-grid">
      <?php foreach ($relatedPosts as $i => $related): ?>
        <article class="blog-card" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
          <div class="blog-card-image" style="background-image: linear-gradient(135deg, var(--color-off-white), var(--color-light-gray));<?php if (!empty($related->featured_image)): ?>background-image:url('<?= uploadUrl($related->featured_image) ?>');background-size:cover;background-position:center;<?php endif; ?>">
            <span class="blog-card-category"><?= htmlspecialchars($related->category_name ?? ($related->category ?? 'General')) ?></span>
          </div>
          <div class="blog-card-body">
            <div class="blog-card-meta">
              <span><i class="bi bi-calendar3"></i> <?= formatDate($related->published_at ?? $related->created_at ?? date('Y-m-d')) ?></span>
              <span><i class="bi bi-clock"></i> <?= (int)($related->reading_time ?? 5) ?> min read</span>
            </div>
            <h5><?= htmlspecialchars($related->title ?? '') ?></h5>
            <p><?= htmlspecialchars(truncate($related->excerpt ?? $related->content ?? '', 100)) ?></p>
            <a href="<?= route('blog/' . sanitize($related->slug ?? '')) ?>" class="card-link">Read More <i class="bi bi-arrow-right"></i></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
