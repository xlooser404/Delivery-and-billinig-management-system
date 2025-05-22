<?php
// /dms/frontend/pages/customers.php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once '../../backend/config/db.php';

// Fetch customers
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
$customers = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}
?>

<?php include '../partials/header.php'; ?>
<?php include '../partials/sidebar.php'; ?>
<?php include '../partials/navbar.php'; ?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4 shadow-sm border-radius-lg">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <h6 class="mb-0 text-sm">Customers</h6>
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">Add Customer</button>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-3">
            <table class="table table-hover align-items-center mb-0 text-sm">
              <thead class="bg-light">
                <tr>
                  <th>Name</th>
                  <th>Store Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($customers as $customer): ?>
                  <tr>
                    <td><?= htmlspecialchars($customer['name']) ?></td>
                    <td><?= htmlspecialchars($customer['store_name']) ?></td>
                    <td><?= htmlspecialchars($customer['email']) ?></td>
                    <td><?= htmlspecialchars($customer['phone']) ?></td>
                    <td><?= htmlspecialchars($customer['address']) ?></td>
                    <td>
                      <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editCustomerModal<?= $customer['id'] ?>">Edit</button>
                      <form action="../../backend/controllers/customersController.php" method="POST" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?= $customer['id'] ?>">
                        <button type="submit" name="delete_customer" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</button>
                      </form>
                    </td>
                  </tr>

                  <!-- Edit Customer Modal -->
                  <div class="modal fade" id="editCustomerModal<?= $customer['id'] ?>" tabindex="-1" aria-labelledby="editCustomerModalLabel<?= $customer['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <form method="POST" action="../../backend/controllers/customersController.php">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $customer['id'] ?>">
                            <div class="mb-3">
                              <label>Name</label>
                              <input name="name" type="text" class="form-control" value="<?= htmlspecialchars($customer['name']) ?>" required />
                            </div>
                            <div class="mb-3">
                              <label>Store Name</label>
                              <input name="store_name" type="text" class="form-control" value="<?= htmlspecialchars($customer['store_name']) ?>" required />
                            </div>
                            <div class="mb-3">
                              <label>Email</label>
                              <input name="email" type="email" class="form-control" value="<?= htmlspecialchars($customer['email']) ?>" />
                            </div>
                            <div class="mb-3">
                              <label>Phone</label>
                              <input name="phone" type="text" class="form-control" value="<?= htmlspecialchars($customer['phone']) ?>" />
                            </div>
                            <div class="mb-3">
                              <label>Address</label>
                              <textarea name="address" class="form-control"><?= htmlspecialchars($customer['address']) ?></textarea>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="update_customer" class="btn btn-primary">Update Customer</button>
                          </div>
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
    </div>
  </div>
</div>

<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="../../backend/controllers/customersController.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Customer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Name</label>
            <input name="name" type="text" class="form-control" required />
          </div>
          <div class="mb-3">
            <label>Store Name</label>
            <input name="store_name" type="text" class="form-control" required />
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input name="email" type="email" class="form-control" />
          </div>
          <div class="mb-3">
            <label>Phone</label>
            <input name="phone" type="text" class="form-control" />
          </div>
          <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_customer" class="btn btn-primary">Save Customer</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Popper.js and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include '../partials/footer.php'; ?>
