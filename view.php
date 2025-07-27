<?php
include "connect.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // Cast to int for safety
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Details</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <style>
        body {
            background-color: whitesmoke;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .content {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            border: 1px solid #dee2e6;
            border-radius: 15px;
            gap: 40px;
            padding: 30px 40px;
            background: white;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            align-items: center;
        }
        .photo {
            flex: 0 0 140px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        }
        .photo img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            display: block;
        }
        .details {
            flex: 1;
            min-width: 220px;
        }
        .details h5 {
            margin-bottom: 18px;
            font-weight: 600;
            color: #495057;
        }
        .details h5 span {
            color: #6c757d;
            font-weight: 500;
            margin-right: 6px;
        }
        .btn-back {
            margin-top: 30px;
        }
        @media (max-width: 576px) {
            .content {
                flex-direction: column;
                gap: 20px;
            }
            .photo, .details {
                flex: 1 1 100%;
                text-align: center;
            }
            .details h5 {
                margin-bottom: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5 w-75 w-md-100">
        <h2>User Details</h2>
        <div class="content">
            <div class="photo">
                <img src="<?= htmlspecialchars($user['photo']) ?>" alt="User Photo" />
            </div>
            <div class="details">
                <h5><span>Last Name:</span> <strong><?= htmlspecialchars($user['last_name']) ?></strong></h5>
                <h5><span>First Name:</span> <strong><?= htmlspecialchars($user['first_name']) ?></strong></h5>
                <h5><span>Birth Date:</span> <strong><?= htmlspecialchars($user['birth_date']) ?></strong></h5>
                <h5><span>City:</span> <strong><?= htmlspecialchars($user['city']) ?></strong></h5>
            </div>
        </div>
        <a href="index.php" class="btn btn-dark btn-lg btn-back">Back</a>
    </div>
</body>
</html>