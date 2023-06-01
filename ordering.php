<?php

require_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image_type = $_POST['image_type'];
    $status = $_POST['status'];
    
    $sql = "INSERT INTO orders (name, product_name, quantity, price, image_type, status) VALUES (:name, :product_name, :quantity, :price, :image_type, :status)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image_type', $image_type);
    $stmt->bindParam(':status', $status);
    

    if ($stmt->execute()) {
        echo "Your medical order was successfully placed.";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
    exit();
}

?>

