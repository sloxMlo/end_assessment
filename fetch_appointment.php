<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maluti_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($conn) {
        echo "";
    } else {
        echo "Database connection failed";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


$stmt = $conn->prepare("SELECT * FROM appointment");
$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$conn = null;

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <title>pharmacist_home</title>
    <script src="js/bootstrap.bundle.min.js"></script>
    <style>
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
              <li><a class="dropdown-item" href="#">Prescriptions Appointments</a></li>
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
    <h1 class="display-5 fw-bold" style="text-align: center;color:#00006B;font-family:Times New Roman;">Prescriptions Appointments</h1>
<table>
  <thead>
    <tr>
     <th>Patient Name</th>
      <th>Date</th>
      <th>Time</th>
      <th>Prescription</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($appointments as $appointment): ?>
    <tr>
    <td>
      <?php echo $appointment['name']; ?></td>
      <td><?php echo $appointment['date']; ?></td>
      <td><?php echo $appointment['time']; ?></td>
      <td><?php echo $appointment['prescription']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>
</div>
<footer style="text-align: center;">
        <hr>
        <br>
        
        <a href="https://www.facebook.com/maluti" target="blank">
           <img src="facebook.PNG" width="30px

        
        
            <a href="mailto:malutiphamarcy@gmail.com" tagert="blank">
            <img src="email.jpg" width="30px"></a>
        
        
    
        This page is proctected by 2024 &copy copyright  
  </footer>
