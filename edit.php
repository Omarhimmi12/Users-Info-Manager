<?php
include "connect.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($con, $query);
    if (!$result || mysqli_num_rows($result) === 0) {
        header("Location: index.php");
        exit();
    }
    $user = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $birth_date = $_POST['birth_date'];
    $city = mysqli_real_escape_string($con, $_POST['city']);

    $photo = $user['photo']; 
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES['photo']['name']);
        $tmp_name = $_FILES['photo']['tmp_name'];
        $target_dir = "img/";
        $target_file = $target_dir . $filename;
        move_uploaded_file($tmp_name, $target_file);
        $photo = $target_file;
    }

    $update = "UPDATE users SET 
                last_name='$last_name', 
                first_name='$first_name', 
                birth_date='$birth_date', 
                city='$city', 
                photo='$photo'
               WHERE id = $id";
    mysqli_query($con, $update);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Update User</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <style>
        body {
            background-color: whitesmoke;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 30px;
            color: #343a40;
            font-weight: 700;
        }
        .form-control {
            margin-bottom: 15px;
            font-size: 1rem;
        }
        label.photo-label {
            display: block;
            margin-top: 20px;
            cursor: pointer;
            width: 140px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        }
        label.photo-label img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            display: block;
        }
        label.photo-label:hover {
            opacity: 0.8;
        }
        .btn-group {
            margin-top: 30px;
        }
        .btn-success {
            font-weight: 600;
            padding: 0.5rem 1.25rem;
        }
        .btn-secondary {
            margin-left: 10px;
            padding: 0.5rem 1.25rem;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Update User</h2>
        <form method="POST" enctype="multipart/form-data" novalidate>
            <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name']) ?>" required placeholder="Last Name" />
            <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name']) ?>" required placeholder="First Name" />
            <input type="date" name="birth_date" class="form-control" value="<?= htmlspecialchars($user['birth_date']) ?>" required />
            <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($user['city']) ?>" required placeholder="City" />

            <label for="photo" class="photo-label" title="Click to change photo">
                <img src="<?= htmlspecialchars($user['photo']) ?>" alt="Current Photo">
                <input type="file" name="photo" id="photo" hidden accept="image/*" />
            </label>

            <div class="btn-group">
                <button type="submit" class="btn btn-success">Confirm</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>