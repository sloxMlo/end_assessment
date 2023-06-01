<?php

$host = 'localhost';
$dbname = 'root';
$username = 'maluti_db';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Error: Could not connect to the database. " . $e->getMessage());
}


$sql = "INSERT INTO patients (name, dob, marital_status, dependencies, next_of_kin, address, phone_numbers, village) 
        VALUES (:name, :dob, :marital_status, :dependencies, :next_of_kin, :address, :phone_numbers, :village)";
$stmt = $pdo->prepare($sql);


$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':dob', $_POST['dob']);
$stmt->bindParam(':marital_status', $_POST['marital_status']);
$stmt->bindParam(':dependencies', $_POST['dependencies']);
$stmt->bindParam(':next_of_kin', $_POST['next_of_kin']);
$stmt->bindParam(':address', $_POST['address']);
$stmt->bindParam(':phone_numbers', $_POST['phone_numbers']);
$stmt->bindParam(':village', $_POST['village']);


if ($stmt->execute()) {
    echo "Data inserted successfully.";
} else {
    echo "Error: Could not insert data. " . $stmt->errorInfo()[2];
}
?>
