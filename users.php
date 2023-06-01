<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
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
<a href="<?php echo isset($_SESSION['role']) && $_SESSION['role'] === 'ADMIN' ? 'admin_home.php' : 'index.php'; ?>"></a>
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
          <a class="nav-link"  href="admin_home.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users.php">ADMINISTER USERS</a>
        </li>
    
        <li class="nav-item">
          <a class="nav-link " href="events.php">EVENTS</a>
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
<div class="card" style="width: 18rem;">
            <img src="admin.png" class="card-img-top" alt="admin image">
            <div class="card-body text-center">
            <h5 class="card-title">Admin  
    <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>
</h5>

                <a href="logout.php" class="btn btn-dark">Logout</a>
            </div>
        </div>
</div>
<div class="container col-md-8" style="align: right;">
        <dev class="p-3">

            <h1 class="display-5 fw-bold" style="text-align: center;color:#00006B;font-family:Times New Roman;">All Registered Pharmacy Users</h1>
  
<style>
    .table {
        border-collapse: collapse;
        width: 32rem;
        font-size: 1.2rem;
    }
    .table th {
        text-align: left;
        padding: 0.8rem;
        border-bottom: 2px solid #ddd;
        background-color: #f2f2f2;
        color: #333;
        font-weight: 600;
        text-transform: uppercase;
    }
</style>

            <table class="table" style="width:32rem;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maluti_db";

try {
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $query = "UPDATE users SET name = '$name', username = '$username', role = '$role' WHERE id = $id";
    $conn->query($query);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM users WHERE id = $id";
    $conn->query($query);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

try {
    $query = "SELECT id, name, username, role FROM users";
    $result = $conn->query($query);

    while($data = $result->fetch(PDO::FETCH_ASSOC)) {
        $modalId = "editModal".$data['id'];
        ?>
        <tr>
            <td><?=$data['id']?></td>
            <td><?=$data['name']?></td>
            <td><?=$data['username']?></td>
            <td><?=$data['role']?></td>
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
                        <h5 class="modal-title" id="<?=$modalId?>">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name<?=$data['id']?>" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name<?=$data['id']?>" name="name" value="<?=$data['name']?>">
                        </div>
                        <div class="mb-3">
                            <label for="username<?=$data['id']?>" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username<?=$data['id']?>" name="username" value="<?=$data['username']?>">
                        </div>
                        <div class="mb-3">
                            <label for="role<?=$data['id']?>" class="form-label">Role</label>
                            <select class="form-control" id="role<?=$data['id']?>" name="role">
                            <option value="1" <?php if($data['role'] === 'PHARMACIST') echo 'selected'; ?>>Pharmacist</option>
                            <option value="2" <?php if($data['role'] === 'PATIENT') echo 'selected'; ?>>Patient</option>
                            
                        </select>
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
        </dev>
        <a href="registraction_admin.php">
  <button style="background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  border-radius: 10px;">
  Add New User
  </button>
</a>
</dev>
</dev>
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
