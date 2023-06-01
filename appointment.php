<?php
session_start();
require_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $prescription = htmlspecialchars($_POST['prescription']);

    $stmt = $conn->prepare("INSERT INTO appointment (name, date, time, prescription) VALUES (:name, :date, :time, :prescription)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':prescription', $prescription);
    
    if (!$stmt->execute()) {
        echo "Error inserting data: " . $stmt->errorInfo()[2];
    } else {
        echo "";
    }
}

$conn = null;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
	<title>Appointment Form</title>
</head>
<body class="p-3 m-0 border-0 bd-example" style="background-color: wheat;">
  <a href="<?php echo isset($_SESSION['role']) && $_SESSION['role'] === 'PATIANT' ? 'patiants_home.php' : 'index.php'; ?>"></a>
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
          <a class="nav-link active" aria-current="page" href="patiants_home.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about1.php">ABOUT US</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: white; color: black;">
              PATIENTS BOARD
            </a>

            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="patiant_register.php">Complete Register</a></li>
              <li><a class="dropdown-item" href="fetch_appointment1.php">My Clinic Records</a></li>
              <li><a class="dropdown-item" href="#">Appointments</a></li>
              <li><a class="dropdown-item" href="fetch_myorders.php">My Orders Status</a></li>
           </ul>
        </div>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">EVENTS</a>
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
            <?php if ($_SESSION['role']== 'PATIENT') {?>
                <div class="card" style="width: 18rem;">
                <img src="patiant.png" class="card-img-top" alt="admin image">
                <div class="card-body text-center">
                <h5 class="card-title">Patiant 
                <?=$_SESSION['name']?>
                </h5>
                <a href="logout.php" class="btn btn-dark">Logout</a>
                </div>
              </div>
            <?php } ?>
        </div>
    </div>
    <div class="container col-md-8" style="align: right;">
    <dev class="container d-flex justify-content-center align-items-center" style="min-height: 10vh;">
	
    <form class="border shadow p-3 rounded" method="post" action="appointment.php" style="width: 450px; background-color: white;">
    <h1 class="display-5 fw-bold" style="text-align: center;color:#00006B;font-family:Times New Roman;">Appointment Form</h1>
    <input type="hidden" name="name" value="<?php if ($_SESSION['role']== 'PATIENT') {?> <?=$_SESSION['name']?> <?php } ?>" >
		<label for="date">Date:</label>
		<input type="date" id="date" name="date" required><br><br>

		<label for="time">Time:</label>
		<input type="time" id="time" name="time" required><br><br>

		<label for="prescription">Medical Discription	:</label>
		<input type="text" id="prescription" name="prescription" required><br><br>

		<input type="submit" value="Submit">
   </form>
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

</body>
</html>
