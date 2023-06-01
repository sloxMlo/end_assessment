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
    <title>persnal_home</title>
    <script src="js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example" style="background-color: wheat;">
  <a href="<?php echo isset($_SESSION['role']) && $_SESSION['role'] === 'PHARMACIST' ? 'pharmacist_home.php' : 'index.php'; ?>"></a>
<header>
  
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <img src="logo.jpg" alt="logo" style="width: 120px; height: 100px;">
   <h1><a class="navbar-brand" href="#">Maluti Pharmacist</a></h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="vhw_home.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">ABOUT US</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: white; color: black;">
              PATIENTS BOARD
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="patiant_register.php">TB Clinic Patientsr</a></li>
              <li><a class="dropdown-item" href="#">Pharmacy  Despensary</a></li>
              <li><a class="dropdown-item" href="#">Appointment Reports</a></li>
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
                <img src="nurse.png" class="card-img-top" alt="admin image">
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
    <h1 class="display-4 fs-1">My Personal Information</h1>
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
   
