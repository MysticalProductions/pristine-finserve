<?php
$title = '404 - Page Not Found';
$currentPage = '404';
$metaDescription = 'The page you are looking for could not be found.';
ob_start();
?>
<section class="error-section" style="text-align:center;min-height:60vh;display:flex;align-items:center;">
    <div class="container">
        <div class="display-1" style="font-weight:800;color:var(--color-royal-blue);line-height:1;margin-bottom:var(--space-5);">404</div>
        <h1 style="margin-bottom:var(--space-4);color:var(--color-deep-navy);">Page Not Found</h1>
        <p style="color:var(--text-muted);max-width:500px;margin:0 auto var(--space-8);">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
        <div style="display:flex;gap:var(--space-4);justify-content:center;flex-wrap:wrap;">
            <a href="<?= route('') ?>" class="btn btn-primary">Go to Homepage</a>
            <a href="<?= route('contact') ?>" class="btn btn-outline">Contact Us</a>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/frontend.php';
?>
