<?php 
    include "connect.php";

    // Fetch all users and calculate age based on birth_date
    $query = "SELECT *, TIMESTAMPDIFF(YEAR, birth_date, CURRENT_DATE()) AS age FROM users;";
    $result = mysqli_query($con, $query);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">    
    <title>Users List</title>
    <style>
        body {
            background-color: whitesmoke;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            vertical-align: middle;
            font-size: 20px;
        }

        .table td img {
            border-radius: 8px;
        }

        .btn + .btn {
            margin-left: 5px;
        }

        .btn-lg {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg- text-dark">
                <h2>Users List</h2>
                <a href="create.php" class="btn btn-success btn-lg">+ Add User</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Photo</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Age</th>
                            <th>City</th>
                            <th>Actions</th>                
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="align-middle"><img src="<?= $user['photo'] ?>" width="50" height="50" alt="User photo"></td>
                            <td class="align-middle"><?= htmlspecialchars($user['last_name']) ?></td>
                            <td class="align-middle"><?= htmlspecialchars($user['first_name']) ?></td>
                            <td class="align-middle"><?= $user['age'] ?> yrs</td>
                            <td class="align-middle"><?= htmlspecialchars($user['city']) ?></td>
                            <td class="align-middle">
                                <a href="view.php?id=<?= $user['id'] ?>" class="btn btn-success btn-sm">View</a>
                                <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger
                                btn-sm delete-btn" data-id="<?= $user['id'] ?>" 
                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this user?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <a href="#" id="deleteConfirmBtn" class="btn btn-danger">Delete</a>
        </div>
        </div>
    </div>
    </div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteConfirmBtn = document.getElementById('deleteConfirmBtn');

    deleteButtons.forEach(button => {
      button.addEventListener('click', function () {
        const userId = this.getAttribute('data-id');
        deleteConfirmBtn.href = `delete.php?id=${userId}`;
      });
    });
  });
</script>

<script src="bootstrap/bootstrap.bundle.min.js"></script>

</body>
</html>