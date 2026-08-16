<div class="page-header">
    <h1>Blog Posts</h1>
    <a href="<?= adminRoute('blogs/create') ?>" class="btn btn-gold"><i class="fas fa-plus"></i> Add New Post</a>
</div>

<?php if ($flash = flash('success')): ?>
<div class="alert alert-success"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>
<?php if ($flash = flash('error')): ?>
<div class="alert alert-danger"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body" style="padding:0;">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pagination->data)): ?>
                    <tr><td colspan="6" class="text-muted">No blog posts found.</td></tr>
                    <?php else: ?>
                    <?php foreach ($pagination->data as $post): ?>
                    <tr>
                        <td><?= htmlspecialchars($post->title) ?></td>
                        <td><?= htmlspecialchars($post->category_name ?? 'Uncategorized') ?></td>
                        <td>
                            <?php if ($post->status === 'published'): ?>
                                <span class="badge badge-success">Published</span>
                            <?php else: ?>
                                <span class="badge badge-warning">Draft</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $post->is_featured ? '<i class="fas fa-star" style="color:#D4A843"></i>' : '-' ?></td>
                        <td><?= formatDate($post->published_at ?? $post->created_at) ?></td>
                        <td>
                            <a href="<?= adminRoute('blogs/edit/' . (int)$post->id) ?>" class="btn btn-sm btn-gold"><i class="fas fa-edit"></i></a>
                            <a href="<?= adminRoute('blogs/delete/' . (int)$post->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this post?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= paginateLinks($pagination, adminRoute('blogs')) ?>
