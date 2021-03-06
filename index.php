<?php
require 'config/config.php';
$data = [];

try {
  //foreach ($keyword as $key => $value) {
  # code...

  $stmt = $connect->prepare("SELECT * FROM room_rental_registrations_apartment WHERE 1");
  $stmt->execute();
  $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $data = $data2;
} catch (PDOException $e) {
  $errMsg = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Abdulkadri Zinat">

  <title>Tenancy Managment System</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/index/styles.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />

  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
  <!-- Third party plugin CSS-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />

  <!-- Custom fonts for this template -->
  <!-- <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
-->
  <!-- Custom styles for this template -->
  <!--<link href="assets/css/rent.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">-->
</head>

<body id="page-top">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">TMS</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto my-2 my-lg-0">

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="./app/search.php">Search</a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">How It Works</a>
          </li>

          <?php
          if (empty($_SESSION['username'])) {
            echo '<li class="nav-item">';
            echo '<a class="nav-link  js-scroll-trigger" href="./auth/login.php">Login</a>';
            echo '</li>';
          } else {
            echo '<li class="nav-item">';
            echo '<a class="nav-link js-scroll-trigger" href="./auth/dashboard.php">Home</a>';
            echo '</li>';
          }
          ?>


          <li class="nav-item">
            <a class="nav-link  js-scroll-trigger" href="./auth/register.php">Register</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Simple Tenancy Managment System</h1>
          <hr class="divider my-4" />
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white-75 font-weight-light mb-5">TMS has something to offer you Landlords, Agents and Tenants!</p>
          <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
        </div>
      </div>
    </div>
  </header>

  <!-- Search -->
  <section class="page-section bg-primary" id="featured">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="section-heading text-uppercase text-white mt-0">FEATURED</h2>
          <hr class="divider light my-4" />
          <h3 class="text-white-50 mb-4">Featured Rental Listings!</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        
          <?php
          if (isset($errMsg)) {
            echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
          }
          if (count($data) !== 0) {
            echo "<h2 class='text-center text-white'>Available Results:</h2>";
          } else {
            //echo "<h2 class='text-center' style='color:red;'>Try Some other keywords</h2>";
          }
          ?>
          <?php
          echo '<div class="row row-cols-1 row-cols-md-2">';
            foreach ($data as $key => $value) {
              echo '<div class="col mb-4">          
                        <div class="card shadow bg-light">';
            // echo '<a class="btn btn-warning float-right" href="update.php?id='.$value['id'].'&act=';if(isset($value['ap_number_of_plats'])){ echo "ap"; }else{ echo "indi"; } echo '">Edit</a>';
              if ($value['image'] !== NULL) {
              # code...
              echo '<img src="app/' . $value['image'] . '" class="card-img-top" alt="Property Image">';
              } else {
                echo '<img src="assets/img/tms.jpg" class="card-img-top" alt="Property Image">';
              }
             
              echo   '<div class="card-body">
                            <h5 class="card-title">' . $value['state'] . ',' . $value['country'] . '</h5>
                            <h4 class="text-center">Owner Details</h4>';
              echo '<p><b>Owner Name: </b>' . $value['fullname'] . '</p>';
              echo '<p><b>Contact Number: </b>' . $value['mobile'] . '</p>';
              echo '<p><b>Alternate Number: </b>' . $value['alternat_mobile'] . '</p>';
              echo '<p><b>Email: </b>' . $value['email'] . '</p>';
              echo '<p><b>Country: </b>' . $value['country'] . '</p><p><b> State: </b>' . $value['state'] . '</p><p><b> City: </b>' . $value['city'] . '</p>';

              echo '</div>
                            <div class="col-5">
                            <h4 class="text-center">Property Details</h4>';
              // echo '<p><b>Country: </b>'.$value['country'].'<b> State: </b>'.$value['state'].'<b> City: </b>'.$value['city'].'</p>';
              echo '<p><b>Plot Number: </b>' . $value['plot_number'] . '</p>';

              if (isset($value['rent'])) {
                echo '<p><b>Rent: </b>$' . $value['rent'] . ' <small><i>per month</i></small></p> ';
              }

              if (isset($value['sale'])) {
                echo '<p><b>Sale: </b>$' . $value['sale'] . '</p>';
              }

              if (isset($value['apartment_name']))
                echo '<div class="alert alert-success" role="alert"><p><b>Apartment Name: </b>' . $value['apartment_name'] . '</p></div>';

              if (isset($value['ap_number_of_plats']))
                echo '<div class="alert alert-success" role="alert"><p><b>Plat Number: </b>' . $value['ap_number_of_plats'] . '</p></div>';

              echo '<p><b>Available Rooms: </b>' . $value['rooms'] . '</p>';
              echo '<p><b>Address: </b>' . $value['address'] . '</p><p><b> Landmark: </b>' . $value['landmark'] . '</p>';
              echo '</div>
                            <div class="col-3">
                            <h4>Other Details</h4>';
              echo '<p><b>Accommodation: </b>' . $value['accommodation'] . '</p>';
              echo '<p><b>Description: </b>' . $value['description'] . '</p>';
              if ($value['vacant'] == 0) {
                echo '<div class="alert alert-danger" role="alert"><h3><b>Occupied</b></h3></div>';
              } else {
                echo '<div class="alert alert-success" role="alert"><h3><b>Vacant!</b></h3></div>';
              }
              echo '</div>
                          </div>              
                          </div>
                      </div>';
            }
          echo '</div>'
          ?>
        </div>
      </div>
    </div>
    <br><br><br><br><br><br>
  </section>

  <!-- Footer -->
  <footer style="background-color: #ccc;">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <span class="copyright">&copy; Tenancy Management System - <?php echo date("Y"); ?></span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="#">
                <i class="fa fa-whatsapp"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fa fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fa fa-facebook"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fa fa-instagram"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JS-->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Third party plugin JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
  <!-- Core theme JS-->
  <script src="assets/index/scripts.js?v=<?php echo time(); ?>"></script>
</body>

</html>