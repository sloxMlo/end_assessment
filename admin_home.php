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
    <title>adminn_home</title>
    <script src="js/bootstrap.bundle.min.js"></script>
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
          <a class="nav-link active" aria-current="page" href="#">HOME</a>
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
        <div class="container" style="min-height: 50vh;">
            <?php if ($_SESSION['role']== 'ADMIN') {?>
                <div class="card" style="width: 18rem;">
                <img src="admin.png" class="card-img-top" alt="admin image">
                <div class="card-body text-center">
                <h5 class="card-title">ADMIN  
                <?=$_SESSION['name']?>
                </h5>
                <a href="logout.php" class="btn btn-dark">Logout</a>
                </div>
              </div>
            <?php } ?>
        </div>
    </div>
    <div class="container col-md-8" style="text-align:center;">
        <h1 class="display-5 fw-bold" style="text-align: center;color:#00006B;font-family:Times New Roman;">Best Pharmacy in Lesotho</h1>
        <p>Welcome to Maluti Pharmacy, your one-stop-shop for all your pharmaceutical needs! We are dedicated to providing you with the best possible service and high-quality products to help you lead a healthier, happier life.

Our team of experienced pharmacists and healthcare professionals are here to help you with any questions or concerns you may have about your medications, vitamins, supplements, or any other healthcare products. We strive to provide you with the most up-to-date information and advice to help you make informed decisions about your health.

At Maluti Pharmacy, we understand that your time is valuable, which is why we offer fast and efficient services, including online ordering and prescription refills. We also offer competitive prices to help you save on your healthcare expenses.

We are proud to be a part of the local community and are committed to giving back through various charitable initiatives.</p>
        <?php
      
            $some_condition = true; 

    
            if ($some_condition) {
              $video_source = "maluti.mp4";
            } else {
              $video_source = "maluti.mp4";
            }
            ?>

            <video controls  width="400" height="300" autoplay>
              <source src="<?php echo $video_source; ?>" type="video/mp4">
              Your browser does not support the video tag.
            </video>

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
    