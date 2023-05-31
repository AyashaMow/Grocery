<?php
    
    include 'DbConnect/connection.php';
    include 'ProfilePictureOperation.php';
    include 'SessionCheck.php';
    $insert = false;
   

    
    $tests = [];
    $sql = "SELECT * FROM `price_table` ORDER BY `id` DESC";
    $result = $con->query($sql);
    if($result){
      $tests = $result->fetch_all(MYSQLI_ASSOC);
    }

   
    if(isset($_POST['productName'])){
    
      $productName = $_POST['productName'];
      $productPrice = $_POST['productPrice'];
      
      if(empty($productName) || empty($productPrice))
      {
        
      }
      else{
        $sql = "INSERT INTO `price_table` (`product_name`,`price`)
        VALUES ('$productName','$productPrice');";
      }

      if($con->query($sql)== true){
        $insert = true;
        header("Refresh:0");
      }
      
    }
    
    
    $userId = $_GET['userId'];
    $names = [];
    $sql = "SELECT * FROM `registered_user` WHERE Shop_Id = '$userId'";
    $result = mysqli_query($con, $sql);  
    $names = mysqli_fetch_array($result, MYSQLI_ASSOC); 
    $userEmail = $_SESSION['Email'];
    $userBrand = $_SESSION['Shop_Name'];
    
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
  <title>Product Price</title>
  <link href="css/style1.css" rel="stylesheet" />
  <link href="css/style2.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />

  <script data-search-pseudo-elements defer src="js/script1.js" crossorigin="anonymous"></script>
  <script src="js/script2.js" crossorigin="anonymous">
  </script>
</head>

<!-- Main body -->

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

            <!-- Add patient start -->
            <?php 
                echo 
                    '<a class="nav-link" href="Purchase.php?userId='.$userId.'">
                      <div class="nav-link-icon"><i data-feather="shopping-cart" style="font-size: 15px"></i></div>
                      Purchase
                    </a>' 
            ?>

            <!-- Add patient end -->

            <?php 
                echo 
                    '<a class="nav-link" href="Customer_Information.php?userId='.$userId.'">
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
                    '<a class="nav-link active" href="Product_price.php?userId='.$userId.'">
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


    <!-- Minhaj Dashbord -->
    <div id="layoutSidenav_content">
      <main>
        <main>
          <!-- Main page content-->
          <div class="container-xl px-4 mt-4">
            <!-- Price-->
            <div class="card">
              <div class="card-header p-4 p-md-5 border-bottom-0 bg-gradient-primary-to-secondary text-white-50">
                <div class="row justify-content-between align-items-center">
                  <div class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-start">
                    <!-- Price branding-->
                    <img class="rounded-circle mb-4 h-25 w-25" src="img/file.png" alt="" />
                    <div class="h2 text-white mb-0">Price List</div>
                  </div>
                </div>
              </div>

              <div class="card-body p-4 p-md-5 row justify-content-center">
                <!-- Price table-->
                <div style="width: 75%">
                  <div class="dataTable-top pb-2">
                    <div>
                      <!-- Add Modal end  -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title w-100 font-weight-bold text-primary" id="exampleModalLabel">
                                Add product & Price
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="Product_price.php?userId=<?php echo $userId ?>" method="post">
                                <div class="row gx-3 mb-3">
                                  <!-- Form Group (first name)-->
                                  <div class="col-md-6">
                                    <label class="small mb-1" for="productName">product Name</label>
                                    <input class="form-control" name="productName" id="productName" type="text" />
                                  </div>
                                  <!-- Form Group (last name)-->
                                  <div class="col-md-6">
                                    <label class="small mb-1" for="productPrice">Rate</label>
                                    <input class="form-control" name="productPrice" id="productPrice" type="text" />
                                  </div>
                                </div>

                                <button class="btn btn-outline-primary btn-block buttonAdd" data-bs-dismiss="modal">
                                  Add form
                                  <i class="fas fa-paper-plane-o ml-1"></i>
                                </button>

                              </form>
                            </div>

                          </div>
                        </div>
                      </div>
                      <!-- Add Modal end  -->

                      <!-- Add Button -->
                      <a href="" class="btn btn-blue btn-rounded btn-sm me-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Add<i
                          class="fas fa-plus-square ms-1"></i></a>
                      <!-- Add Button end-->


                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <table id="datatablesSimple">
                        <thead>
                          <tr>
                            <th>product Name</th>
                            <th>Rate</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                              foreach($tests as $test){
                                echo '<tr>';
                                echo '<td data-field="name">'.$test['product_name'].'</td>';
                                echo '<td data-field="name">'.$test['price'].'</td>';
                               
                                echo '<td>
                                        <a class="btn btn-datatable btn-sm"  href="Delete/delete3.php?id='.$test['id'].'&userId='.$userId.'"  title="Delete" >
                                        <i class="fa-solid fa-trash-can ms-3" style="font-size: 15px;"></i>
                                        <i class="fas fa-paper-plane-o ms-1" style="font-size: 15px;"></i>
                                        </a>
                                        
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark ms-3" 
                                href="updatePrice.php?id='.$test['id'].'&userId='.$userId.'"><i data-feather="edit"></i></a>
                                   
                                      </td>';
                                echo '</tr>';
                             
                              }
                          ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer p-4 p-lg-5 border-top-0">
                <div class="row">
                  <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <!-- Invoice - sent to info-->

                    <!-- <div class="h6 mb-1">Company Name</div>
                    <div class="small">1234 Company Dr.</div>
                    <div class="small">Yorktown, MA 39201</div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </main>
      <footer class="footer-admin mt-auto footer-light">
        <div class="container-xl px-4">
          <div class="row">
            <div class="col-md-6 small">
              Copyright &copy;yourwebsite@gmail.com
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!--Bootstrap JS -->
  <!-- javascript for dropdown -->
  <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="bootstrap-5.1.3/dist/js/scripts.js"></script>

  <script src="js/script5.js" crossorigin="anonymous"></script>

  <script src="js/datatables/datatables-simple-demo.js"></script>

  <script src="js/script6.js" crossorigin="anonymous"></script>

  <script src="js/litepicker.js"></script>





</body>

</html>