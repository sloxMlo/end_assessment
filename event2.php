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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
   <title>events</title>
    <script src="js/bootstrap.bundle.min.js"></script>

</head>
<body class="p-3 m-0 border-0 bd-example" style="background-color: wheat;">
<a href="<?php echo isset($_SESSION['role']) && $_SESSION['role'] === 'PATIENT' ? 'patiants_home.php' : 'index.php'; ?>"></a>
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
          <a class="nav-link"  href="patiants_home.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about1.php">ABOUT US</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: white; color: black;">
              PATIENT BOARD
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="patiant_register.php">Complete Register</a></li>
              <li><a class="dropdown-item" href="#">My Clinic Records</a></li>
              <li><a class="dropdown-item" href="appointment.php">Appointments</a></li>
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
                <h5 class="card-title">PATIENT 
                <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>
                </h5>
                <a href="logout.php" class="btn btn-dark">Logout</a>
                </div>
              </div>
            <?php } ?>
        </div>
    </div><br>
    <div class="container col-md-8" style="text-align:center;">
    <h1>Maluti Pharmacy</h1>
	<p>Welcome to our Pharmacy events page. Here you will find information about upcoming events, including dates, times, and locations. Check back often for updates!</p>
    <h2>Upcoming Events</h2>
    <div class="event">
  <h3>Health and Wellness Expo</h3>
  <p>Date: August 15th, 2023</p>
  <p>Join us for our Health and Wellness Expo, where you'll have the opportunity to discover a wide range of health and wellness products and services...</p>
</div>

<div class="event">
  <h3>Medication Management Seminar</h3>
  <p>Date: September 25th, 2023</p>
  <p>Learn how to manage your medications safely and effectively at our Medication Management Seminar...</p>
</div>

<div class="event">
  <h3>Flu Shot Clinic</h3>
  <p>Date: October 1st to 15th, 2023</p>
  <p>Stay healthy this flu season by getting your flu shot at our Flu Shot Clinic...</p>
</div>

<div class="event">
  <h3>Senior Health Fair</h3>
  <p>Date: November 5th, 2023</p>
  <p>Join us for our Senior Health Fair, designed specifically for seniors...</p>
</div>

<div class="event">
  <h3>Diabetes Management Workshop</h3>
  <p>Date: January 10th, 2024</p>
  <p>If you're living with diabetes, our Diabetes Management Workshop is a must-attend event...</p>
</div>

<div class="event">
  <h3>Women's Health Seminar</h3>
  <p>Date: March 8th, 2024</p>
  <p>Celebrate International Women's Day with our Women's Health Seminar, focused on women's health and wellness...</p>
</div>

<div class="event">
  <h3>Allergy Awareness Week</h3>
  <p>Date: May 13th to 19th, 2024</p>
  <p>Join us for Allergy Awareness Week and learn about how to manage allergies safely and effectively...</p>
</div>

<div class="event">
  <h3>Men's Health Month</h3>
  <p>Date: June 1st to 30th, 2024</p>
  <p>Celebrate Men's Health Month with Maluti Pharmacy, where we'll focus on men's health and wellness...</p>
</div></div>
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