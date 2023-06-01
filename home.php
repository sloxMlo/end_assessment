<?php

session_status() === PHP_SESSION_ACTIVE ?: session_start();
include "db_conn.php";


if(isset($_SESSION['username']) && isset($_SESSION['id'])) { ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center"
    style="min-height;100vh">

    <?php if ($_SESSION['role']== 'ADMIN') { ?>
       <?php include 'admin_home.php'; ?>
    <?php } else if ($_SESSION['role']== 'PHARMACIST') { ?>
        <?php include 'pharmacist_home.php'; ?>
    <?php } else if ($_SESSION['role']== 'PATIENT') { ?>
        <?php include 'patiants_home.php'; ?>
     <?php } ?>

    </div>
</body>
</html>

<?php } else {
    header("Location: index.php");
} ?>
