<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'db_conn.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
  $id = $_POST['id'];
  $product_name = $_POST['product_name'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $image_type = $_POST['image_type'];
  $status = $_POST['status'];
  $query = "UPDATE orders SET product_name = '$product_name', quantity = '$quantity', price = '$price', image_type = '$image_type', status = '$status' WHERE id = $id";
  $conn->query($query);
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
  $id = $_POST['id'];
  $sql = "DELETE FROM orders WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>pharmacist_home</title>
    <script src="js/bootstrap.bundle.min.js"></script>
 

    <style>
  .img-thumbnail {
    width: 100px;
    height: 100px;
  }
  table {
  border-collapse: collapse;
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
}

thead {
  background-color: #f2f2f2;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  font-weight: bold;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #e2e2e2;
}
</style>
  </head>
  <body class="p-3 m-0 border-0 bd-example" style="background-color: wheat;">
  <a href="<?php echo isset($_SESSION['role']) && $_SESSION['role'] === 'PHARMACIST' ? 'pharmacist_home.php' : 'index.php'; ?>"></a>
<header>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <img src="logo.jpg" alt="logo" style="width: 120px; height: 100px;">
   <h1><a class="navbar-brand" href="#">Maluti Pharmacy</a></h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="pharmacist_home.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">ABOUT US</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: white; color: black;">
            PHARMACIST BOARD
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="patiant_records.php">Pharmacy Patients</a></li>
              <li><a class="dropdown-item" href="fetch_orders.php">Prescriptions from Catalogue</a></li>
              <li><a class="dropdown-item" href="fetch_appointment.php">Prescriptions Appointments</a></li>
           </ul>
        </div>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="event1.php">EVENTS</a>
        </li>
      </ul>
    </div>
    <img src="heartbeat.png" alt="logo" style="height: 100px;">
  </div>
</nav>
</hearder>
<br><br>
<div class="container row">
    <div class="col-md-2" style="align: left; ">
        <div class="container" style="min-height: 50vh;">
            <?php if ($_SESSION['role']== 'PHARMACIST') {?>
                <div class="card" style="width: 18rem;">
                <img src="despensary.jpg" class="card-img-top" alt="admin image">
                <div class="card-body text-center">
                <h5 class="card-title">Pharmacist 
                <?=$_SESSION['name']?>
                </h5>
                <a href="logout.php" class="btn btn-dark">Logout</a>
                </div>
              </div>
            <?php } ?>
        </div>
    </div>
    <div class="container col-md-8" style="align: right;">
    <h1 class="display-5 fw-bold" style="text-align: center;color:#00006B;font-family:Times New Roman;">All Ordered Pharmacy Drugs</h1>
   <table class="table" style="width:64rem;">
   <thead>
    <tr>
      <th>Patient Name</th>
    <th>Product Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Medicine/Drugs</th>
    <th>Delivary Status</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody>
  <?php
  try {
    $sql = "SELECT name, product_name, quantity, price, image_type, id, status FROM orders";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    while($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $modalId = "editModal".$data['id'];
        ?>
  <tr>
    <td><?php echo $data['name']; ?></td>
    <td><?php echo $data['product_name']; ?></td>
    <td><?php echo $data['quantity']; ?></td>
    <td><p>R <?php echo $data['price']; ?></p></td>
    <td><img src="<?php echo $data['image_type']; ?>" class="img-thumbnail"></td>
    <td><?php echo $data['status']; ?></td>
    <td>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?=$modalId?>">Edit</button>

<form method="POST" id="deleteForm<?=$data['id']?>">
    <input type="hidden" name="id" value="<?=$data['id']?>">
    <button type="submit" form="deleteForm<?=$data['id']?>" name="delete" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?=$data['id']?>">Delete</button>
</form>

    </td>
  </tr>
  <div class="modal fade" id="<?=$modalId?>" tabindex="-1" aria-labelledby="<?=$modalId?>" aria-hidden="true">
  <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="editForm<?=$data['id']?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="<?=$modalId?>">Edit Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <div class="modal-body">
             
            <div class="mb-3">
                            <label for="name<?=$data['id']?>" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name<?=$data['id']?>" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $data['name']; ?>">

                        </div>
                        <div class="mb-3">
                            <label for="product_name<?=$data['id']?>" class="form-label">Product_Name</label>
                            <input type="text" class="form-control" id="product_name<?=$data['id']?>" name="product_name" value="<?=$data['product_name']?>">
                        </div>
                        <div class="mb-3">
                            <label for="quantity<?=$data['id']?>" class="form-label">Quantity</label>
                            <input type="text" class="form-control" id="quantity<?=$data['id']?>" name="quantity" value="<?=$data['quantity']?>">
                        </div>
                        <div class="mb-3">
                            <label for="price<?=$data['id']?>" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price<?=$data['id']?>" name="price" value="<?=$data['price']?>">
                        </div>
                      <div class="mb-3">
                           <label for="image_type">Image Type</label>
                          <input type="text" class="form-control" id="image_type" name="image_type" value="<?php echo $data['image_type']; ?>">
                      </div>
                      <div class="mb-3">
                            <label for="status<?=$data['id']?>" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status<?=$data['id']?>" name="status" value="<?=$data['status']?>">
                        </div>
                <input type="hidden" name="id" value="<?=$data['id']?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="editForm<?=$data['id']?>" name="edit" class="btn btn-primary">Save Changes</button>
                </div>
        </form>
      </div>
    </div> 
  </div>
</div>
<?php }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>
</tbody>
</table>
</div>
</div>
    <script src="js/bootstrap.bundle.min.js"></script>
<footer style="text-align: center;">
        <hr>
        <br>
        
        
        <a href="https://www.facebook.com/maluti" target="blank">
           <img src="facebook.PNG" width="30px

        
        
            <a href="mailto:malutiphamarcy@gmail.com" tagert="blank">
            <img src="email.jpg" width="30px"></a>
        
    
        This page is proctected by 2024 &copy copyright  
  </footer>
  </body>
</html>
    