<h1>Edit Product</h1>
<form method="POST" action="/products/<?= $product['id'] ?>">
    <label>Name:</label>
    <input type="text" name="name" value="<?= $product['name'] ?>" required>
    <label>Price:</label>
    <input type="text" name="price" value="<?= $product['price'] ?>" required>
    <label>Description:</label>
    <textarea name="description"><?= $product['description'] ?></textarea>
    <button type="submit">Update</button>
</form>
<a href="/products">Back to List</a>
