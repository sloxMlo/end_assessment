<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <title>pharmacist_home</title>
    <script src="js/bootstrap.bundle.min.js"></script>
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
          <a class="nav-link active" aria-current="page" href="pharmacist_home.php">HOME</a>
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
              <li><a class="dropdown-item" href="#">Pharmacy Patients</a></li>
              <li><a class="dropdown-item" href="fetch_orders.php">Prescriptions from Catalogue</a></li>
              <li><a class="dropdown-item" href="fetch_appointment.php">Prescriptions Appointments</a></li>
           </ul>
        </div>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="event2.php">EVENTS</a>
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
                <h5 class="card-title">PHARMACIST
                <?=$_SESSION['name']?>
                </h5>
                <a href="logout.php" class="btn btn-dark">Logout</a>
                </div>
              </div>
            <?php } ?>
        </div>
    </div>
    <div class="container col-md-8" style="align: right;">
    <dev class="p-3">
   <h1 class="display-5 fw-bold" style="text-align: center;color:#00006B;font-family:Times New Roman;">All Registered Pharmacy Patient Users</h1> 
   <table class="table" style="width:32rem;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Names</th>
                <th scope="col">DOB</th>
                <th scope="col">Marital_status</th>
                <th scope="col">Number_of_Dependencies</th>
                <th scope="col">Next_of_Kin</th>
                <th scope="col">Address</th>
                <th scope="col">Phone_Numbers</th>
                <th scope="col">Village</th>
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

        try {
            $query = "SELECT id, names, dob, marital_status, number_of_dependencies, next_of_kin, address, phone_numbers, village FROM patiant";
            $result = $conn->query($query);

            while($data = $result->fetch(PDO::FETCH_ASSOC)) {
                $modalId = "editModal" . $data['id'];
                ?>
                <tr>
                    <td><?=$data['id']?></td>
                    <td><?=$data['names']?></td>
                    <td><?=$data['dob']?></td>
                    <td><?=$data['marital_status']?></td>
                    <td><?=$data['number_of_dependencies']?></td>
                    <td><?=$data['next_of_kin']?></td>
                    <td><?=$data['address']?></td>
                    <td><?=$data['phone_numbers']?></td>
                    <td><?=$data['village']?></td>
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
                            <label for="names<?=$data['id']?>" class="form-label">Name</label>
                            <input type="text" class="form-control" id="names<?=$data['id']?>" name="names" value="<?=$data['names']?>">
                        </div>
                        <div class="mb-3">
    <label for="dob<?=$data['id']?>" class="form-label">Date of Birth</label>
    <input type="date" class="form-control" id="dob<?=$data['id']?>" name="dob" value="<?=$data['dob']?>">
</div>

<div class="mb-3">
    <label for="marital_status<?=$data['id']?>" class="form-label">Marital Status</label>
    <select class="form-select" id="marital_status<?=$data['id']?>" name="marital_status">
        <option value="">--Select--</option>
        <option value="Single" <?php if($data['marital_status']=='Single') echo 'selected'?>>Single</option>
        <option value="Married" <?php if($data['marital_status']=='Married') echo 'selected'?>>Married</option>
        <option value="Divorced" <?php if($data['marital_status']=='Divorced') echo 'selected'?>>Divorced</option>
        <option value="Widowed" <?php if($data['marital_status']=='Widowed') echo 'selected'?>>Widowed</option>
    </select>
</div>

<div class="mb-3">
    <label for="number_of_dependencies<?=$data['id']?>" class="form-label">Number of Dependents</label>
    <input type="number" class="form-control" id="number_of_dependencies<?=$data['id']?>" name="number_of_dependencies" value="<?=$data['number_of_dependencies']?>">
</div>

<div class="mb-3">
    <label for="next_of_kin<?=$data['id']?>" class="form-label">Next of Kin</label>
    <input type="text" class="form-control" id="next_of_kin<?=$data['id']?>" name="next_of_kin" value="<?=$data['next_of_kin']?>">
</div>

<div class="mb-3">
    <label for="address<?=$data['id']?>" class="form-label">Address</label>
    <input type="text" class="form-control" id="address<?=$data['id']?>" name="address" value="<?=$data['address']?>">
</div>

<div class="mb-3">
    <label for="phone_numbers<?=$data['id']?>" class="form-label">Phone Numbers</label>
    <input type="text" class="form-control" id="phone_numbers<?=$data['id']?>" name="phone_numbers" value="<?=$data['phone_numbers']?>">
</div>

<div class="mb-3">
    <label for="village<?=$data['id']?>" class="form-label">Village</label>
    <input type="text" class="form-control" id="village<?=$data['id']?>" name="village" value="<?=$data['village']?>">
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
                <?php
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        ?>
        </tbody>
    </table>
    <a href="patiant_register2.php">
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
