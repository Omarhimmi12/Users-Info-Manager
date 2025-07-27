<?php
include "connect.php";

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id = $id";
    mysqli_query($con, $query);    
}

header("Location: index.php");