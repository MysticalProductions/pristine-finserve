<div class="page-header">
    <h1>Edit Blog Post</h1>
    <a href="<?= adminRoute('blogs') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<?php if ($flash = flash('error')): ?>
<div class="alert alert-danger"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form action="<?= adminRoute('blogs/update/' . (int)$post->id) ?>" method="POST" enctype="multipart/form-data">
            <?= csrfField() ?>
            <div class="form-row">
                <div class="form-group">
                    <label>Title *</label>
                    <input type="text" name="title" class="form-control" data-slug-source="title" required value="<?= htmlspecialchars($post->title) ?>">
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" data-slug-target value="<?= htmlspecialchars($post->slug) ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Excerpt</label>
                <textarea name="excerpt" class="form-control" rows="3"><?= htmlspecialchars($post->excerpt ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label>Content *</label>
                <textarea name="content" class="form-control" rows="15" required><?= htmlspecialchars($post->content ?? '') ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Uncategorized</option>
                        <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                        <option value="<?= (int)$cat->id ?>" <?= ($post->category_id == $cat->id) ? 'selected' : '' ?>><?= htmlspecialchars($cat->name) ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tags (comma-separated)</label>
                    <?php $tagStr = is_array($post->tags ?? null) ? implode(', ', $post->tags) : ($post->tags ?? ''); ?>
                    <input type="text" name="tags" class="form-control" placeholder="loan, finance, home loan" value="<?= htmlspecialchars($tagStr) ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="<?= htmlspecialchars($post->meta_title ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2"><?= htmlspecialchars($post->meta_description ?? '') ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="draft" <?= $post->status === 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="published" <?= $post->status === 'published' ? 'selected' : '' ?>>Published</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Published At</label>
                    <input type="datetime-local" name="published_at" class="form-control" value="<?= $post->published_at ? date('Y-m-d\TH:i', strtotime($post->published_at)) : '' ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Featured Image</label>
                    <input type="file" name="featured_image" class="form-control" accept="image/*">
                    <?php if ($post->featured_image): ?>
                    <div style="margin-top:8px;"><img src="<?= uploadUrl($post->featured_image) ?>" alt="" style="max-width:200px;border-radius:8px;"></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_featured" value="1" <?= $post->is_featured ? 'checked' : '' ?>> Featured Post
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Post</button>
            </div>
        </form>
    </div>
</div>
