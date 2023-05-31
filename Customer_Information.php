<?php
    
    include 'DbConnect/connection.php';
    include 'ProfilePictureOperation.php';
    include 'SessionCheck.php';
    
      
      $userId = $_GET['userId'];
      $names = [];
      $sql = "SELECT * FROM `registered_user` WHERE Shop_Id = '$userId'";
      $result = mysqli_query($con, $sql);  
      $names = mysqli_fetch_array($result, MYSQLI_ASSOC); 
      $userEmail = $_SESSION['Email'];
      $userBrand = $_SESSION['Shop_Name'];


      $customers = [];
      $sql = "SELECT * FROM `customer_data` ORDER BY `id` DESC";
      $result = $con->query($sql);
      if($result){
        $customers = $result->fetch_all(MYSQLI_ASSOC);
        
      }
    $con->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Customer Information</title>
  <link href="css/style1.css" rel="stylesheet" />
  <link href="css/style2.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />

  <script data-search-pseudo-elements defer src="js/script1.js" crossorigin="anonymous"></script>
  <script src="js/script2.js" crossorigin="anonymous">
  </script>
</head>

<body class="nav-fixed">
  <!-- Navbar -->
  <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white"
    id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle">
      <i data-feather="menu"></i>
    </button>
    <!-- Navbar Brand-->

    <?php echo '<p class="navbar-brand pe-3 ps-4 ps-lg-2">'.$_SESSION['Shop_Name'].'</p>' ?>


    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">
      <!-- User Dropdown-->
      <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
          href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false"><img class="img-fluid" src="assets/img/my_profile_picture.jpg" /></a>
        <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
          aria-labelledby="navbarDropdownUserImage">

            <style>
                .container {
                    width: 50%;
                    
                    display: block;
                    margin: 0 auto;
                    margin-bottom:32pt;
                    margin-top:16pt;
                }
                
                .outer {
                    width: 1100% !important;
                    height: 100% !important;
                    max-width: 100px !important; /* any size */
                    max-height: 100px !important; /* any size */
                    margin: auto;
                    background-color: #FFFFFF;
                    border-radius: 100%;
                    position: relative;
                    }
                    
                .inner {
                    background-color: #FFFFFF;
                    width: 32px;
                    height: 32px;
                    border-radius: 100%;
                    position: absolute;
                    bottom: 0;
                    right: 0;
                    box-shadow:  0 0 10px  rgba(0,0,0,0.6);
                }
                
                .inner:hover {
                    background-color: #e3e3e3;
                    
                }
                .inputfile {
                    overflow: hidden;
                    position: absolute;
                    z-index: 1;
                    width: 32px;
                    height: 32px;
                    padding-left:32px;
                    cursor: pointer;
                }
                .inputfile + label {
                    font-size: 1.25rem;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                    display: inline-block;
                    overflow: hidden;
                    width: 32px;
                    height: 32px;
                    line-height: 32px;
                    text-align: center;
                }
                .inputfile + label svg {
                    fill: #fff;
                    
                }
            </style>
            <script>
            
              function profilePictureHelper(event){
                  
                  var file = document.getElementById("image");
                  if(file!=null){
                      var image = document.getElementById("profile_picture");
                      image.src = URL.createObjectURL(event.target.files[0]);

                      var save = document.getElementById("profile_picture_save");
                      save.style.display="";
                  }
                  


              }
          
            </script>
          <form action="Dashboard.php" method="post" enctype="multipart/form-data">
          <h6 class="dropdown-header d-flex align-items-center">
     
              <div class="outer">
                <img src="assets/img/my_profile_picture.jpg" alt="Profile" class="rounded-circle outer" id="profile_picture">
                                  
                <div class="inner">                                    
                  <input class="inputfile" type="file" name="image" accept="image/jpg" id="image" onchange="profilePictureHelper(event)">
                  <label><a href="#"><i ><img src="img/edit.png"></i></a></label>           
                </div>
              </div>
              <div class="dropdown-user-details">
                <?php echo '<div class="dropdown-user-details-name">'.$_SESSION['Shop_Name'].'</div>' ?>
                <?php echo '<div class="dropdown-user-details-email mt-1">'.$_SESSION['Email'].'</div>' ?>
                <button type="submit" class="btn btn-primary mt-4 ms-2" style="max-height:8px;display:none;" name="profile_picture_save" id="profile_picture_save">Save</button>
              </div>
          
          </h6>
          </form>
          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="LogOutAction.php">
            <div class="dropdown-item-icon">
              <i data-feather="log-out"></i>
            </div>
            Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- Navbar end -->

  <div id="layoutSidenav">
    <!--  sidebar -->
    <div id="layoutSidenav_nav">
      <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
          <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Core</div>
            <!-- Sidenav Accordion (Dashboard)-->

            <!-- Dasboard start -->
            <?php 
                echo  
                    '<a class="nav-link" href="Dashboard.php?userId='.$userId.'">
                      <div class=" nav-link-icon"><i data-feather="activity"></i></div>
                      Dashboards
                    </a>'
            ?>

            <!-- Dasboard end -->

            <!-- Add customer start -->
            <?php 
                echo 
                    '<a class="nav-link" href="Purchase.php?userId='.$userId.'">
                      <div class="nav-link-icon"><i data-feather="shopping-cart" style="font-size: 15px"></i></div>
                      Purchase
                    </a>' 
            ?>

            <!-- Add customer end -->

            <?php 
                echo 
                    '<a class="nav-link active" href="Customer_Information.php?userId='.$userId.'">
                      <div class="nav-link-icon">
                        <i class="fa fa-search" aria-hidden="true" style="font-size: 15px"></i>
                      </div>
                      Customer Information
                    </a>' 
            ?>



            <!-- Invoice start -->
            <?php 
                
                
                
                
                
                
                
            ?>

            <!-- Invoice end -->

            <!-- Product Price start -->
            <?php 
                echo 
                    '<a class="nav-link" href="Product_price.php?userId='.$userId.'">
                      <div class="nav-link-icon">
                        <i class="fa fa-list" aria-hidden="true"></i>
                      </div>
                      Product Price
                    </a>'  
            ?>

            <!-- Product Price end -->
          </div>
        </div>

        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
          <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <?php echo ' <div class="sidenav-footer-title">'.$userEmail.'</div>' ?>
          </div>
        </div>
      </nav>
    </div>
    <!--  sidebar end -->

    <div id="layoutSidenav_content">
      <main>
        <!-- Main page content-->
        <div class="container-fluid px-4 mt-5">
          <div class="card mb-4">
            <div class="card-header ps-3">
              <div style="width: 300px">
                <form class="d-flex" action="Customer_Information.php?userId=<?php echo $userId?>" method="post">
                  <input class="form-control me-2" placeholder="customer ID" type="text" aria-label="Search"
                    id="myInput" />
                  <button class="btn btn-outline-primary" type="submit">
                    Search
                  </button>
                </form>
              </div>
            </div>
            <div class="card-body p-0">
              <!-- Billing history table-->
              <div class="table-responsive table-billing-history">
                <!-- Modal Section -->
                
                <table class="table mb-0">
                  <thead>
                    <tr>
                      <th class="border-gray-200" scope="col">Customer Id</th>
                      <th class="border-gray-200" scope="col">Customer Name</th>
                      <th class="border-gray-200" scope="col">Contact Number</th>
                      <th class="border-gray-200" scope="col">Sub Total</th>
                      <th class="border-gray-200" scope="col">Discount</th>
                      <th class="border-gray-200" scope="col">Paid</th>
                      <th class="border-gray-200" scope="col">Date</th>

                    </tr>
                  </thead>
                  <tbody id="myTable">
                    <?php

                        foreach($customers as $customer){
                         
                          echo '<tr>';
                          
                          echo '<td data-field="name">'.$customer['customerID'].'</td>';
                          echo '<td data-field="name">'.$customer['customerName'].'</td>';
                          echo '<td data-field="name">'.$customer['contact'].'</td>';
                          echo '<td data-field="name">'.$customer['subTotal'].'</td>';
                          echo '<td data-field="name">'.$customer['discount'].'</td>';
                          echo '<td data-field="name">'.$customer['paidTk'].'</td>';
                          echo '<td data-field="name">'.$customer['date'].'</td>';
                         
                          echo '<tr>';
                        }
                    
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>
      <footer class="footer-admin mt-auto footer-light">
        <div class="container-xl px-4">
          <div class="row">
            <div class="col-md-6 small">
              Copyright &copy; Your Website 2021
            </div>
            <div class="col-md-6 text-md-end small">
              <a href="#!">Privacy Policy</a>
              &middot;
              <a href="#!">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!--Bootstrap JS -->
  <script src="js/script4.js"></script>
  <script src=" bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="bootstrap-5.1.3/dist/js/scripts.js"></script>

  <script src="js/script5.js" crossorigin="anonymous"></script>

  <script src="js/datatables/datatables-simple-demo.js"></script>

  <script src="js/script6.js" crossorigin="anonymous"></script>

  <script src="js/litepicker.js"></script>
</body>

</html>