<div class="row">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['description']); ?></p>
                        <p class="card-text">
                            <strong>Price: $<?= htmlspecialchars($product['price']); ?></strong>
                        </p>
                        <div class="mt-auto">
                            <a href="<?= base_url('products/' . $product['id']); ?>" class="btn btn-primary mb-2">View Details</a>
                            <a href="<?= base_url('products/buy/' . $product['id']); ?>" class="btn btn-success mb-2">Add Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                No products found.
            </div>
        </div>
    <?php endif; ?>
</div>
