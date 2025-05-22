<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../backend/config/db.php';

// Fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$products = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<?php include '../partials/header.php'; ?>
<?php include '../partials/sidebar.php'; ?>
<?php include '../partials/navbar.php'; ?>

<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Product Management</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">+ Add Product</button>
  </div>

  <div class="card">
    <div class="table-responsive p-3">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th>Product Code</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product): ?>
            <tr>
              <td><?= htmlspecialchars($product['product_code']) ?></td>
              <td><?= htmlspecialchars($product['name']) ?></td>
              <td><?= htmlspecialchars($product['description']) ?></td>
              <td><?= htmlspecialchars($product['price']) ?></td>
              <td><?= htmlspecialchars($product['stock_quantity']) ?></td>
              <td><?= htmlspecialchars($product['category']) ?></td>
              <td>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $product['id'] ?>">Edit</button>

                <form action="../../backend/controllers/productsController.php" method="POST" class="d-inline">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $product['id'] ?>">
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
              </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?= $product['id'] ?>" tabindex="-1">
              <div class="modal-dialog">
                <form action="../../backend/controllers/productsController.php" method="POST" class="modal-content">
                  <input type="hidden" name="action" value="edit">
                  <input type="hidden" name="id" value="<?= $product['id'] ?>">
                  <div class="modal-header">
                    <h5>Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <input type="text" name="product_code" value="<?= $product['product_code'] ?>" class="form-control mb-2" placeholder="Product Code" required>
                    <input type="text" name="name" value="<?= $product['name'] ?>" class="form-control mb-2" placeholder="Product Name" required>
                    <textarea name="description" class="form-control mb-2" placeholder="Description" required><?= $product['description'] ?></textarea>
                    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" class="form-control mb-2" placeholder="Price" required>
                    <input type="number" name="stock_quantity" value="<?= $product['stock_quantity'] ?>" class="form-control mb-2" placeholder="Stock Quantity" required>
                    <select name="category" class="form-control" required>
                      <option value="Electronics" <?= $product['category'] == 'Electronics' ? 'selected' : '' ?>>Electronics</option>
                      <option value="Clothing" <?= $product['category'] == 'Clothing' ? 'selected' : '' ?>>Clothing</option>
                      <option value="Food" <?= $product['category'] == 'Food' ? 'selected' : '' ?>>Food</option>
                      <option value="Other" <?= $product['category'] == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success">Save Changes</button>
                  </div>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="../../backend/controllers/productsController.php" method="POST" class="modal-content">
      <input type="hidden" name="action" value="add">
      <div class="modal-header">
        <h5>Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="text" name="product_code" class="form-control mb-2" placeholder="Product Code" required>
        <input type="text" name="name" class="form-control mb-2" placeholder="Product Name" required>
        <textarea name="description" class="form-control mb-2" placeholder="Description" required></textarea>
        <input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price" required>
        <input type="number" name="stock_quantity" class="form-control mb-2" placeholder="Stock Quantity" required>
        <select name="category" class="form-control" required>
          <option value="">Select Category</option>
          <option value="Electronics">Electronics</option>
          <option value="Clothing">Clothing</option>
          <option value="Food">Food</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary">Add Product</button>
      </div>
    </form>
  </div>
</div>

<?php include '../partials/footer.php'; ?>