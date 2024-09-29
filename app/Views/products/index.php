<div class="container mt-4">
    <h2><?= esc($title) ?></h2>

    <!-- Search Form -->
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search products" value="<?= esc($search) ?>">
            <select name="sort" class="form-select">
                <option value="created_at" <?= ($sort == 'created_at') ? 'selected' : '' ?>>Created At</option>
                <option value="name" <?= ($sort == 'name') ? 'selected' : '' ?>>Product Name</option>
                <option value="price" <?= ($sort == 'price') ? 'selected' : '' ?>>Price</option>
            </select>
            <select name="order" class="form-select">
                <option value="ASC" <?= ($order == 'ASC') ? 'selected' : '' ?>>Ascending</option>
                <option value="DESC" <?= ($order == 'DESC') ? 'selected' : '' ?>>Descending</option>
            </select>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= esc($product['name']) ?></td>
                        <td><?= esc($product['description']) ?></td>
                        <td>$<?= esc($product['price']) ?></td>
                        <td>
                            <a href="<?= base_url('products/' . $product['id']); ?>" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <?= $pagination ?>
    </div>
</div>
