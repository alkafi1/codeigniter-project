<div class="row">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['description']); ?></p>
                        <p class="card-text">
                            <strong>Price: $<?= htmlspecialchars($product['price']); ?></strong>
                        </p>
                        <a href="<?= base_url('products/' . $product['id']); ?>" class="btn btn-primary">View Details</a>
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
