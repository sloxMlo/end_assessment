<?php

session_status() === PHP_SESSION_ACTIVE ?: session_start();


include "db_conn.php";


if (isset($_POST['register'])) {

   
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($name) || empty($username) || empty($password) || empty($role)) {
        $message = "<label>Please fill all fields</label>";
    } else {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $conn->prepare($query);
        $stmt->execute(array(':username' => $username));
        $count = $stmt->rowCount();

        if ($count > 0) {
            $message = "<label>Username already exists. Please choose a different username.</label>";
        } else {
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

         
            $query = "INSERT INTO users (name, username, password, role) VALUES (:name, :username, :password, :role)";
            $stmt = $conn->prepare($query);
            $stmt->execute(array(
                ':name' => $name,
                ':username' => $username,
                ':password' => $hashed_password,
                ':role' => $role
            ));

            
            $_SESSION['name'] = $name;
            $_SESSION['id'] = $conn->lastInsertId();
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;

            
            header("Location: login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body style="background-color: grey;">
    <dev class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <form class="border shadow p-3 rounded" action="registration.php" method="post" style="width: 450px; background-color: white;">
            <h1 class="display-5 fw-bold" style="text-align: center;color:#00006B;font-family:Times New Roman;">Maluti Pharmacy Registration Form</h1>
            <?php if (isset($message)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select mb-3" name="role" id="role" aria-label="Default select example">
                <option selected value="1">PHARMACIST</option>
                <option value="2">PATIENT</option>
           
            </select>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" name="register">Register</button>
        </div>
        <div class="text-center mt-3">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </form>
</dev>
<script src="js/bootstrap.min.js"></script>

