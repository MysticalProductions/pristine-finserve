<?php
$title = $title ?? 'Blog – Pristine Finserve';
$metaDescription = $metaDescription ?? 'Expert financial advice, market updates, and tips to help you make smarter financial decisions.';
$metaKeywords = $metaKeywords ?? 'financial blog, loan tips, investment advice, personal finance, CIBIL score';
$currentPage = 'blog';
ob_start();

$posts = $pagination->items ?? [];
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <span>Blog</span>
    </div>
    <h1 data-aos="fade-up">Our Blog</h1>
    <p data-aos="fade-up" data-aos-delay="100">Expert financial advice, market updates, and tips to help you make smarter decisions.</p>
  </div>
</section>

<?php if (!empty($featuredPost)): ?>
<section class="section" style="padding-top:0;">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Featured Post</span>
      <h2 class="section-title">Editor's Pick</h2>
    </div>
    <div class="featured-post" data-aos="fade-up">
      <article class="grid-2-col-align-center" style="gap:var(--space-8);background:var(--color-white);border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-lg);">
        <div style="height:350px;background:var(--color-off-white);">
          <?php if (!empty($featuredPost->featured_image)): ?>
            <img src="<?= uploadUrl($featuredPost->featured_image) ?>" alt="<?= htmlspecialchars($featuredPost->title ?? '') ?>" style="width:100%;height:100%;object-fit:cover;">
          <?php endif; ?>
        </div>
        <div style="padding:var(--space-8);">
          <span style="display:inline-block;padding:4px 12px;background:var(--color-gold);color:var(--color-white);border-radius:50px;font-size:0.75rem;font-weight:600;margin-bottom:var(--space-4);">
            <?= htmlspecialchars($featuredPost->category_name ?? ($featuredPost->category ?? 'Featured')) ?>
          </span>
          <h3 style="font-size:1.5rem;margin-bottom:var(--space-3);"><?= htmlspecialchars($featuredPost->title ?? '') ?></h3>
          <p style="color:var(--color-text-muted);margin-bottom:var(--space-4);"><?= htmlspecialchars(truncate($featuredPost->excerpt ?? $featuredPost->content ?? '', 200)) ?></p>
          <div style="display:flex;align-items:center;gap:var(--space-4);margin-bottom:var(--space-4);font-size:0.85rem;color:var(--color-text-muted);">
            <span><i class="bi bi-calendar3"></i> <?= formatDate($featuredPost->published_at ?? $featuredPost->created_at ?? date('Y-m-d')) ?></span>
            <span><i class="bi bi-clock"></i> <?= (int)($featuredPost->reading_time ?? 5) ?> min read</span>
          </div>
          <a href="<?= route('blog/' . sanitize($featuredPost->slug ?? '')) ?>" class="btn btn-gold">Read Full Article <i class="bi bi-arrow-right"></i></a>
        </div>
      </article>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="section <?= empty($featuredPost) ? '' : 'section-light' ?>">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">All Articles</span>
      <h2 class="section-title">Latest Financial Insights</h2>
    </div>

    <div class="grid-sidebar-layout">
      <div>
        <?php if (!empty($posts)): ?>
          <div class="blog-grid">
            <?php foreach ($posts as $post): ?>
              <article class="blog-card" data-aos="fade-up">
                <div class="blog-card-image" style="background-image: linear-gradient(135deg, var(--color-off-white), var(--color-light-gray));<?php if (!empty($post->featured_image)): ?>background-image:url('<?= uploadUrl($post->featured_image) ?>');background-size:cover;background-position:center;<?php endif; ?>">
                  <span class="blog-card-category"><?= htmlspecialchars($post->category_name ?? ($post->category ?? 'General')) ?></span>
                </div>
                <div class="blog-card-body">
                  <div class="blog-card-meta">
                    <span><i class="bi bi-calendar3"></i> <?= formatDate($post->published_at ?? $post->created_at ?? date('Y-m-d')) ?></span>
                    <span><i class="bi bi-clock"></i> <?= (int)($post->reading_time ?? 5) ?> min read</span>
                  </div>
                  <h5><?= htmlspecialchars($post->title ?? '') ?></h5>
                  <p><?= htmlspecialchars(truncate($post->excerpt ?? $post->content ?? '', 120)) ?></p>
                  <a href="<?= route('blog/' . sanitize($post->slug ?? '')) ?>" class="card-link">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="empty-state" style="text-align:center;padding:var(--space-12);">
            <i class="bi bi-newspaper" style="font-size:3rem;color:var(--color-text-muted);"></i>
            <p style="color:var(--color-text-muted);margin-top:var(--space-4);">No blog posts published yet. Check back soon!</p>
          </div>
        <?php endif; ?>

        <?php if (($pagination->lastPage ?? 0) > 1): ?>
          <div style="margin-top:var(--space-8);">
            <?= paginateLinks($pagination, route('blog')) ?>
          </div>
        <?php endif; ?>
      </div>

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
            <h5 style="color:var(--color-deep-navy);margin-bottom:var(--space-3);">Subscribe to Our Newsletter</h5>
            <p style="font-size:0.85rem;color:var(--color-text-muted);margin-bottom:var(--space-4);">Get the latest financial tips and updates delivered to your inbox.</p>
            <form action="<?= route('newsletter/subscribe') ?>" method="POST">
              <?= csrfField() ?>
              <input type="email" name="email" class="form-control" placeholder="Your email address" required style="margin-bottom:var(--space-3);">
              <button type="submit" class="btn btn-gold" style="width:100%;">Subscribe</button>
            </form>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
