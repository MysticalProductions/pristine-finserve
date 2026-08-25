<?php
$title = '500 - Server Error';
$currentPage = '500';
$metaDescription = 'An unexpected error occurred.';
ob_start();
?>
<section class="error-section" style="text-align:center;min-height:60vh;display:flex;align-items:center;">
    <div class="container">
        <div class="display-1" style="font-weight:800;color:var(--color-gold);line-height:1;margin-bottom:var(--space-5);">500</div>
        <h1 style="margin-bottom:var(--space-4);color:var(--color-deep-navy);">Server Error</h1>
        <p style="color:var(--text-muted);max-width:500px;margin:0 auto var(--space-8);">Something went wrong on our end. Please try again later or contact us if the problem persists.</p>
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
