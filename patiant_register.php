<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "db_conn.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $names = trim($_POST['names'] ?? '');
    $dob = trim($_POST['dob'] ?? '');
    $maritalStatus = trim($_POST['marital_status'] ?? '');
    $numberOfDependencies = trim($_POST['number_of_dependencies'] ?? '');
    $nextOfKin = trim($_POST['next_of_kin'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $phoneNumbers = trim($_POST['phone_numbers'] ?? '');
    $village = trim($_POST['village'] ?? '');

 
        $stmt = $conn->prepare("SELECT * FROM patiant WHERE names = :names");
        $stmt->execute([':names' => $names]);
        $count = $stmt->rowCount();

        if ($count > 0) {
            $message = "<div class='alert alert-danger'>Patient already exists. Please choose a different name.</div>";
        } else {
            $stmt = $conn->prepare("INSERT INTO patiant (names, dob, marital_status, number_of_dependencies, next_of_kin, address, phone_numbers, village) VALUES (:names, :dob, :maritalStatus, :numberOfDependencies, :nextOfKin, :address, :phoneNumbers, :village)");
            $stmt->bindParam(':names', $names);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':maritalStatus', $maritalStatus);
            $stmt->bindParam(':numberOfDependencies', $numberOfDependencies);
            $stmt->bindParam(':nextOfKin', $nextOfKin);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phoneNumbers', $phoneNumbers);
            $stmt->bindParam(':village', $village);

            if ($stmt->execute()) {
                $_SESSION['names'] = $names;
                $_SESSION['id'] = $conn->lastInsertId();
                $_SESSION['dob'] = $dob;
                $_SESSION['marital_status'] = $maritalStatus;
                $_SESSION['number_of_dependencies'] = $numberOfDependencies;
                $_SESSION['next_of_kin'] = $nextOfKin;
                $_SESSION['address'] = $address;
                $_SESSION['phone_numbers'] = $phoneNumbers;
                $_SESSION['village'] = $village;

                $message = "<div class='alert alert-success'>Registration successful.</div>";

                header("refresh:3;url=patiants_home.php");
                exit();
            } else {
                $message = "<div class='alert alert-danger'>Failed to register patient.</div>";
            }
        }
    //}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Registration Form</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: grey">
<dev class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        
        <form class="border shadow p-3 rounded" action="patiant_register.php" method="post" style="width: 450px; background-color: white;">
        <h1 class="display-5 fw-bold" style="text-align: center;color:#00006B;font-family:Times New Roman;">Complete Your Registration</h1>
            <?php if (isset($message)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php } ?>
        <div class="mb-3">
                <label for="name" class="form-label">Names</label>
                <input type="text" class="form-control" id="name" name="names" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="mb-3">
                <label for="marital_status" class="form-label">Marital Status</label>
                <select class="form-control" id="marital_status" name="marital_status" required>
                    <option value="" disabled selected>Select marital status</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="dependencies" class="form-label">Number of Dependencies</label>
                <input type="number" class="form-control" id="dependencies" name="dependencies" min="0" max="10" required>
            </div>
            <div class="mb-3">
                <label for="next_of_kin" class="form-label">Next of Kin</label>
                <input type="text" class="form-control" id="next_of_kin" name="next_of_kin" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="phone_numbers" class="form-label">Phone Numbers</label>
                <input type="tel" class="form-control" id="phone_numbers" name="phone_numbers" required>
            </div>
            <div class="mb-3">
                <label for="village" class="form-label">Village</label>
                <input type="text" class="form-control" id="village" name="village" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="js/bootstrap.min.js" ></script>
</body>
</html>