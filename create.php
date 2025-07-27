<?php
include "connect.php";

if (isset($_POST['submit'])) {
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $birth_date = $_POST['birth_date'];
    $city = mysqli_real_escape_string($con, $_POST['city']);

    $photo = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES['photo']['name']);
        $tmp_name = $_FILES['photo']['tmp_name'];
        $target_dir = "img/";
        $target_file = $target_dir . $filename;

        // Optional: You can add checks for file type, size, overwrite etc.
        move_uploaded_file($tmp_name, $target_file);
        $photo = $target_file;
    }

    $query = "INSERT INTO users (last_name, first_name, birth_date, city, photo) VALUES ('$last_name', '$first_name', '$birth_date', '$city', '$photo')";
    mysqli_query($con, $query);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Create New User</title>
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
            border-radius: 10px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
        }
        h2 {
            margin-bottom: 30px;
            color: #343a40;
            font-weight: 700;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-secondary {
            margin-left: 10px;
        }
        label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Create New User</h2>
        <form method="POST" enctype="multipart/form-data" novalidate>
            <div class="mb-3">
                <label for="last_name">Last Name</label>
                <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name" required />
            </div>
            <div class="mb-3">
                <label for="first_name">First Name</label>
                <input id="first_name" name="first_name" type="text" class="form-control" placeholder="First Name" required />
            </div>
            <div class="mb-3">
                <label for="birth_date">Birth Date</label>
                <input id="birth_date" name="birth_date" type="date" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="city">City</label>
                <input id="city" name="city" type="text" class="form-control" placeholder="City" required />
            </div>
            <div class="mb-4">
                <label for="photo">Photo (optional)</label>
                <input id="photo" name="photo" type="file" class="form-control" accept="image/*" />
            </div>
            <button class="btn btn-primary" name="submit" type="submit">Submit</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>