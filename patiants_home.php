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
    <title>patients_home</title>
    <script src="js/bootstrap.bundle.min.js"></script>
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
          <a class="nav-link active" aria-current="page" href="#">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about1.php">ABOUT US</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; color: blue; border: none;">
        PATIENTS BOARD <i class="bi bi-caret-down-fill"></i>
    </a>

    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="patiant_register.php">Complete Register</a></li>
        <li><a class="dropdown-item" href="fetch_appointment1.php">My Clinic Records</a></li>
        <li><a class="dropdown-item" href="appointment.php">Appointments</a></li>
        <li><a class="dropdown-item" href="fetch_myorders.php">My Orders Status</a></li>
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
    <div class="col-md-2" style="align: left;">
        <div class="container" style="min-height: 50vh;">
            <?php if ($_SESSION['role']== 'PATIENT') {?>
                <div class="card" style="width: 18rem;">
                    <img src="patiant.png" class="card-img-top" alt="admin image">
                    <div class="card-body text-center">
                        <h5 class="card-title">Patient <?=$_SESSION['name']?></h5>
                        <a href="logout.php" class="btn btn-dark">Logout</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <div class="container col-md-8" style="align: right; margin-left: 200px;">
    <h1 class="display-5 fw-bold" style="text-align: center;color:#00006B;font-family:Times New Roman;">Order Now In Our Medical Catalogue</h1>
    <div class="row justify-content-center">
    <div class="col-md-3 text-center">
    <form action="ordering.php" method="post">
      <input type="hidden" name="name" value="<?php if ($_SESSION['role']== 'PATIENT') {?> <?=$_SESSION['name']?> <?php } ?>" >
        <input type="hidden" name="product_name" value="Benzodiazepines">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="price" value="10.00">
        <input type="hidden" name="image_type" value="panado.jpg">
        <input type="hidden" name="status" value="Delivery Pending">
        <button type="submit" style="background:none; border:none; padding:0;">
            <img src="panado.jpg" alt="Panado Pills" width="200" height="200">
            <h6>Benzodiazepines R10.00</h6>
        </button>
    </form>
</div>
<div class="col-md-3 text-center">
    <form action="ordering.php" method="post">
    <input type="hidden" name="name" value="<?php if ($_SESSION['role']== 'PATIENT') {?> <?=$_SESSION['name']?> <?php } ?>" >
        <input type="hidden" name="product_name" value="Methylphenidate">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="price" value="20.00">
        <input type="hidden" name="image_type" value="panado1.jpeg">
        <input type="hidden" name="status" value="Delivery Pending">
        <button type="submit" style="background:none; border:none; padding:0;">
            <img src="panado1.jpeg" alt="Panado Pills" width="200" height="200">
            <h6>Methylphenidate R20.00</h6>
        </button>
    </form>
</div>
<div class="col-md-3 text-center">
    <form action="ordering.php" method="post">
    <input type="hidden" name="name" value="<?php if ($_SESSION['role']== 'PATIENT') {?> <?=$_SESSION['name']?> <?php } ?>" >
        <input type="hidden" name="product_name" value="Propylphenidate">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="price" value="40.00">
        <input type="hidden" name="image_type" value="panado2.jpeg">
        <input type="hidden" name="status" value="Delivery Pending">
        <button type="submit" style="background:none; border:none; padding:0;">
            <img src="panado2.jpeg" alt="Panado Pills" width="200" height="200">
            <h6>Propylphenidate R40.00</h6>
        </button>
    </form>
</div>
<div class="col-md-3 text-center">
    <form action="ordering.php" method="post">
    <input type="hidden" name="name" value="<?php if ($_SESSION['role']== 'PATIENT') {?> <?=$_SESSION['name']?> <?php } ?>" >
        <input type="hidden" name="product_name" value="Nopaine">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="price" value="80.00">
        <input type="hidden" name="image_type" value="panado3.jpeg">
        <input type="hidden" name="status" value="Delivery Pending">
        <button type="submit" style="background:none; border:none; padding:0;">
            <img src="panado3.jpeg" alt="Panado Pills" width="200" height="200">
            <h6>Nopaine R80.00</h6>
        </button>
    </form>
</div>

        
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





<!-- End Example Code -->
  </body>
</html>
    