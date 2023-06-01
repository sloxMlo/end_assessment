<?php

session_status() === PHP_SESSION_ACTIVE ?: session_start();

include "db_conn.php";

session_status() === PHP_SESSION_ACTIVE ?: session_start();

include "db_conn.php";

if (isset($_POST['login'])) {
    $query = ("SELECT * FROM users WHERE username = :username");
    $stmt = $conn->prepare($query);
    $stmt->execute(array('username' => $_POST["username"]));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $result = $stmt->fetch();
        if (password_verify($_POST["password"], $result["password"])) {
            if ($result['role'] === 'PHARMACIST' || $result['role'] === 'ADMIN' || $result['role'] === 'PATIENT') {
                $_SESSION['name']       = $result['name'];
                $_SESSION['id']         = $result['id'];
                $_SESSION['role']       = $result['role'];
                $_SESSION['username']   = $result['username'];
                header("Location: home.php");
            } else {
                header("Location: login.php?error=Access denied");
            }
        } else {
            header("Location: login.php?error=Wrong password");
        }
    } else {
        header("Location: login.php?error=User not found");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INDEX</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: gray;">
    <dev class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <form class="border shadow p-3 rounded" action="login.php" method="post" style="width: 450px; background-color: white;">
            <h1 class="display-5 fw-bold" style="text-align: center;color:#00006B;font-family:Times New Roman;">Maluti Pharmacy Login</h1>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_GET['error'] ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="username" class="form-label">User name</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-1">
                <label class="form-label">Select User Type:</label>
            </div>
            <select class="form-select mb-3" name="role" id="role" aria-label="Default select example">
                <option selected value="1">PHARMACIST</option>
                <option value="2">PATIENT</option>
                <option value="3">ADMIN</option>
            </select>

            <button type="submit" name="login" class="btn btn-primary">Login</button><br><br>
            <a href="registration.php" style="text-decoration: none;">Register Here</a>
        </form>
       
    </dev>

</body>

</html>