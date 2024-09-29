<h1>Product Details</h1>
<p>Name: <?= $product['name'] ?></p>
<p>Price: <?= $product['price'] ?></p>
<p>Description: <?= $product['description'] ?></p>
<a href="/products">Back to List</a>
<a href="/products/<?= $product['id'] ?>/edit">Edit</a>
<a href="/products/<?= $product['id'] ?>/delete">Delete</a>
