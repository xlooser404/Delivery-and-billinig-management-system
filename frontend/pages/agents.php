<!--
=========================================================
* Online Delivery & Billing Management System - v1.0
=========================================================

* Product Page: https://www.softworxstudios.com
* Copyright 2025 SoftWorx Studios (https://www.softworxstudios.com)
* Licensed under MIT (https://www.softworxstudios.com/license)
* Coded by SoftWorx Studios

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../backend/config/db.php';

// Fetch customers
$sql = "SELECT * FROM agents";
$result = $conn->query($sql);
$agents = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $agents[] = $row;
    }
}
?>

<?php include '../partials/header.php'; ?>
<?php include '../partials/sidebar.php'; ?>
<?php include '../partials/navbar.php'; ?>

<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Delivery Agents</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAgentModal">+ Add Agent</button>
  </div>

  <div class="card">
    <div class="table-responsive p-3">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($agents as $agent): ?>
            <tr>
              <td><?= htmlspecialchars($agent['name']) ?></td>
              <td><?= htmlspecialchars($agent['phone']) ?></td>
              <td><?= htmlspecialchars($agent['email']) ?></td>
              <td><?= htmlspecialchars($agent['address']) ?></td>
              <td>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $agent['id'] ?>">Edit</button>

                <form action="../../backend/controllers/agentsController.php" method="POST" class="d-inline">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $agent['id'] ?>">
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
              </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?= $agent['id'] ?>" tabindex="-1">
              <div class="modal-dialog">
                <form action="../../backend/controllers/agentsController.php" method="POST" class="modal-content">
                  <input type="hidden" name="action" value="edit">
                  <input type="hidden" name="id" value="<?= $agent['id'] ?>">
                  <div class="modal-header">
                    <h5>Edit Agent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <input type="text" name="name" value="<?= $agent['name'] ?>" class="form-control mb-2" required>
                    <input type="text" name="phone" value="<?= $agent['phone'] ?>" class="form-control mb-2" required>
                    <input type="email" name="email" value="<?= $agent['email'] ?>" class="form-control mb-2" required>
                    <textarea name="address" class="form-control" required><?= $agent['address'] ?></textarea>
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

<!-- Add Agent Modal -->
<div class="modal fade" id="addAgentModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="../../backend/controllers/agentsController.php" method="POST" class="modal-content">
      <input type="hidden" name="action" value="add">
      <div class="modal-header">
        <h5>Add Agent</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="text" name="name" placeholder="Name" class="form-control mb-2" required>
        <input type="text" name="phone" placeholder="Phone" class="form-control mb-2" required>
        <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
        <textarea name="address" placeholder="Address" class="form-control" required></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary">Add Agent</button>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include '../partials/footer.php'; ?>
