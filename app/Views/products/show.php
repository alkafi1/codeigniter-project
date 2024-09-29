<div class="container mt-5">
    <h1 class="text-center mb-4"><?= esc($title); ?></h1>

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title"><?= esc($product['name']); ?></h3>
                    <p class="card-text"><?= esc($product['description']); ?></p>
                    <h4 class="text-success mb-3">Price: $<?= esc($product['price']); ?></h4>

                    <!-- Add to Cart Form -->
                    <form action="" method="post" class="d-inline-block">
                        <input type="hidden" name="product_id" value="<?= esc($product['id']); ?>">
                        <button type="submit" class="btn btn-lg btn-success">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    
</div>
