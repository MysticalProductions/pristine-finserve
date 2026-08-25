<div class="page-header">
  <h1><i class="fas fa-search"></i> <?= !empty($seo) ? 'Edit SEO Entry' : 'Add SEO Entry' ?></h1>
  <a href="<?= adminRoute('seo') ?>" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back to SEO</a>
</div>

<div class="card">
  <div class="card-body">
    <form method="POST" action="<?= adminRoute('seo/' . (!empty($seo) ? 'update/' . $seo->id : 'store')) ?>">
      <?= csrfField() ?>

      <div class="form-row">
        <div class="form-group">
          <label for="page_url">Page URL <span class="required">*</span></label>
          <input type="text" name="page_url" id="page_url" class="form-control" value="<?= htmlspecialchars($seo->page_url ?? old('page_url')) ?>" placeholder="e.g., about-us" required>
        </div>
        <div class="form-group">
          <label for="meta_title">Meta Title</label>
          <input type="text" name="meta_title" id="meta_title" class="form-control" value="<?= htmlspecialchars($seo->title ?? old('meta_title')) ?>" placeholder="SEO title for this page">
        </div>
      </div>

      <div class="form-group">
        <label for="meta_description">Meta Description</label>
        <textarea name="meta_description" id="meta_description" class="form-control" rows="3" placeholder="Brief page description for search results"><?= htmlspecialchars($seo->description ?? old('meta_description')) ?></textarea>
      </div>

      <div class="form-group">
        <label for="meta_keywords">Meta Keywords</label>
        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" value="<?= htmlspecialchars($seo->keywords ?? old('meta_keywords')) ?>" placeholder="keyword1, keyword2, keyword3">
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="og_title">OG Title</label>
          <input type="text" name="og_title" id="og_title" class="form-control" value="<?= htmlspecialchars($seo->og_title ?? old('og_title')) ?>" placeholder="Social sharing title">
        </div>
        <div class="form-group">
          <label for="og_description">OG Description</label>
          <textarea name="og_description" id="og_description" class="form-control" rows="2" placeholder="Social sharing description"><?= htmlspecialchars($seo->og_description ?? old('og_description')) ?></textarea>
        </div>
      </div>

      <div class="form-group">
        <label for="og_image">OG Image URL</label>
        <input type="text" name="og_image" id="og_image" class="form-control" value="<?= htmlspecialchars($seo->og_image ?? old('og_image')) ?>" placeholder="/storage/uploads/og-image.jpg">
      </div>

      <div class="form-group">
        <label for="schema_markup">Schema Markup (JSON-LD)</label>
        <textarea name="schema_markup" id="schema_markup" class="form-control" rows="6" placeholder='{"@context": "https://schema.org", ...}'><?= htmlspecialchars($seo->schema_markup ?? old('schema_markup')) ?></textarea>
        <p class="form-hint">Enter valid JSON-LD structured data.</p>
      </div>

      <div style="display:flex;gap:8px;">
        <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> <?= !empty($seo) ? 'Update' : 'Create' ?> SEO Entry</button>
        <a href="<?= adminRoute('seo') ?>" class="btn btn-outline"><i class="fas fa-times"></i> Cancel</a>
      </div>
    </form>
  </div>
</div>
