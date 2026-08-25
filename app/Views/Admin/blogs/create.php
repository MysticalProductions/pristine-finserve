<div class="page-header">
    <h1>Create Blog Post</h1>
    <a href="<?= adminRoute('blogs') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<?php if ($flash = flash('error')): ?>
<div class="alert alert-danger"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form action="<?= adminRoute('blogs/store') ?>" method="POST" enctype="multipart/form-data">
            <?= csrfField() ?>
            <div class="form-row">
                <div class="form-group">
                    <label>Title *</label>
                    <input type="text" name="title" class="form-control" data-slug-source="title" required value="<?= htmlspecialchars(old('title')) ?>">
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" data-slug-target value="<?= htmlspecialchars(old('slug')) ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Excerpt</label>
                <textarea name="excerpt" class="form-control" rows="3"><?= htmlspecialchars(old('excerpt')) ?></textarea>
            </div>
            <div class="form-group">
                <label>Content *</label>
                <textarea name="content" class="form-control" rows="15" required><?= htmlspecialchars(old('content')) ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Uncategorized</option>
                        <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                        <option value="<?= (int)$cat->id ?>"><?= htmlspecialchars($cat->name) ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tags (comma-separated)</label>
                    <input type="text" name="tags" class="form-control" placeholder="loan, finance, home loan" value="<?= htmlspecialchars(old('tags')) ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="<?= htmlspecialchars(old('meta_title')) ?>">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2"><?= htmlspecialchars(old('meta_description')) ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Published At</label>
                    <input type="datetime-local" name="published_at" class="form-control" value="<?= htmlspecialchars(old('published_at')) ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Featured Image</label>
                    <input type="file" name="featured_image" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_featured" value="1"> Featured Post
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Create Post</button>
            </div>
        </form>
    </div>
</div>
