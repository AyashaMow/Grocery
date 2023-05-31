<?php
    
    include 'DbConnect/connection.php';
    include 'ProfilePictureOperation.php';
    include 'SessionCheck.php';

    $insert = false;
    
    $staffs = [];
    $sql = "SELECT * FROM `dashboard_table` ORDER BY `id` DESC";
    $result = $con->query($sql);
    if($result){
      $staffs = $result->fetch_all(MYSQLI_ASSOC);
    }
    //set the name;
    $userId = $_GET['userId'];
    $names = [];
    $sql = "SELECT * FROM `registered_user` WHERE Shop_Id = '$userId'";
    $result = mysqli_query($con, $sql);  
    $names = mysqli_fetch_array($result, MYSQLI_ASSOC); 
    $userEmail = $_SESSION['Email'];
    $userBrand = $_SESSION['Shop_Name'];
      

    // calculation for card

    
    // income calculation
    $sql3 = "SELECT SUM(paidTk) FROM customer_data WHERE date > (NOW() - INTERVAL 1 MONTH)";
    $sql4 = "SELECT SUM(paidTk) FROM customer_data WHERE date > (NOW() - INTERVAL 1 YEAR)";
    $result3 =  $con->query($sql3);
    $result4 =  $con->query($sql4);
    $monthIncome = $result3->fetch_assoc();
    $yearIncome = $result4->fetch_assoc();

    //graph
    $graph = [];
    $sql = "SELECT MONTH(date) as month, SUM(paidTk) as 'total' FROM `customer_data` WHERE YEAR(date) = YEAR(CURRENT_DATE()) GROUP BY YEAR(date), MONTH(date)";
    $result = $con->query($sql);
    if($result){
      $graph = $result->fetch_all(MYSQLI_ASSOC);
    }

  


    if(isset($_POST['ModalName'])){
    
      $ModalName = $_POST['ModalName'];
      $ModalId = $_POST['ModalId'];
      $ModalDate = $_POST['ModalDate'];
      $ModalSalary = $_POST['ModalSalary'];
      $ModalStatus = $_POST['ModalStatus'];
      $ModalEmail = $_POST['ModalEmail'];
    
      if(empty($ModalName) || empty($ModalId) || empty($ModalDate) || empty($ModalEmail) || empty($ModalSalary) || empty($ModalStatus))
      {
        //
      }
      else{
        $shop_name = $_SESSION['Shop_Name'];
        $shop_id = $_SESSION['Shop_Id'];
        $sql = "INSERT INTO `dashboard_table` (`name`,`staff_Id`,`email`,`date`, `salary`, `status`,`shop_id`,`Shop_Name`)
        VALUES ('$ModalName','$ModalId','$ModalEmail','$ModalDate', '$ModalSalary', '$ModalStatus','$shop_id','$shop_name')";
      }

      if($con->query($sql)== true){
        $insert = true;
        header("Refresh:0");
      }
      
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
  <title>Dashboard</title>

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
                    '<a class="nav-link active" href="Dashboard.php?userId='.$userId.'">
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
                    '<a class="nav-link" href="Customer_Information.php?userId='.$userId.'">
                      <div class="nav-link-icon">
                        <i class="fa fa-search" aria-hidden="true" style="font-size: 15px"></i>
                      </div>
                      Customer Information
                    </a>' 
            ?>


            <!-- Invoice start -->
            <?php 
                // echo 
                //     '<a class="nav-link" href="invoice.php?userId='.$userId.'">
                //       <div class="nav-link-icon">
                //         <i class="fas fa-file-invoice"></i>
                //       </div>
                //       Invoice
                //     </a>'
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


          <!-- Notification start -->
          <?php 
                echo 
                    '<a class="nav-link" href="Notification.php?userId='.$userId.'">
                      <div class="nav-link-icon">
                        <i class="fas fa-bell" aria-hidden="true"></i>
                      </div>
                      Notification
                    </a>' 
                    

                
            ?>

            <!-- Notification end -->

           <li>
           <?php
                   echo 
                    '<a class="nav-link" href="Notification.php?userId='.$userId.'">
                      <div class="nav-link-icon">
                        <i class="fas fa-comment-alt" aria-hidden="true"></i>
                      </div>
                      Chitter-Chatter
                    </a>' 
                    
            ?>
             
             <ul>
              
              <?php
                   echo 
                    '<a class="nav-link" href="Notification.php?userId='.$userId.'">
                      <div class="nav-link-icon">
                        <i class="far fa-comments" aria-hidden="true"></i>
                      </div>
                      Chatting With Staff
                    </a>' 
                    
            ?>
              
              
              <?php
                   echo 
                    '<a class="nav-link" href="Notification.php?userId='.$userId.'">
                      <div class="nav-link-icon">
                        <i class="far fa-comments" aria-hidden="true"></i>
                      </div>
                      Chatting With Delivery Man
                    </a>' 
                    
            ?>
              
             </ul>
           </li>
           
            













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

    <!--  Dashbord -->
    <div id="layoutSidenav_content">
      <main>
        <header class="page-header page-header-dark bg-primary pb-5">
          <div class="container-xl px-4">
            <div class="page-header-content pt-4">
              <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                  <h1 class="page-header-title">
                    <div class="page-header-icon">
                      <i data-feather="activity"></i>
                    </div>
                    Dashboard
                  </h1>
                  <div class="page-header-subtitle">
                    Manage your Super Shop
                  </div>
                </div>
                <!-- calaneder -->
                <div class="col-12 col-xl-auto mt-4">
                  <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                    <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                    <input class="form-control ps-0 pointer" id="litepickerRangePlugin"
                      placeholder="Select date range..." />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>

        <!-- Main page content-->
        <div class="container-xl px-4 mt-n5">
          <!--Cards section for Dashboard -->
          <section>
            <div class="row">
              <div class="col-lg-6 col-xl-6 mb-4">
                <div class="card lift text-white h-100" style="background-color:#45B08C;">
                  <div class="card-body ">
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="me-3">
                        <div class="text-white-85 small">
                          Sales (Monthly)
                        </div>
                        <div class="text-lg fw-bold"><?php echo  implode("|",$monthIncome)?> taka</div>
                      </div>
                      <i class="feather-xl text-white-50" data-feather="calendar"></i>
                    </div>
                  </div>

                </div>
              </div>
              <div class="col-lg-6 col-xl-6 mb-4">
                <div class="card lift  text-white h-100" style="background-color:#FFBF00;">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="me-3">
                        <div class="text-white-85 small">
                          Sales (Annual)
                        </div>
                        <div class="text-lg fw-bold"><?php echo implode("|",$yearIncome) ?> taka</div>
                      </div>
                      <i class="feather-xl text-white-50" data-feather="dollar-sign"></i>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </section>

          <!-- Charts for Dashboard-->
          <section>
            <div class="row">
              <div class="col-xl-12 mb-4">
                <div class="card card-header-actions h-100">
                  <div class="card-header">
                    Sales Breakdown
                    <div class="dropdown no-caret">
                      <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample"
                        type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="text-gray-500" data-feather="more-vertical"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end animated--fade-in-up"
                        aria-labelledby="areaChartDropdownExample">
                        <a class="dropdown-item" href="#!">Last 12 Months</a>
                        <a class="dropdown-item" href="#!">Last 30 Days</a>
                        <a class="dropdown-item" href="#!">Last 7 Days</a>
                        <a class="dropdown-item" href="#!">This Month</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#!">Custom Range</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart-area">
                      <canvas id="myAreaChart" width="100%" height="30"></canvas>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </section>

          <!-- Staff DataTable for Dashboard -->
          <section>
            <div class="card mb-4">
              <div class="card-header">Staff Management</div>
              <div class="card-body">
                <div class="dataTable-top pb-2">
                  <div>
                    <!--Modal  -->
                    <section>
                      <!-- Add Modal  -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title w-100 font-weight-bold text-primary" id="exampleModalLabel">
                                Add Staff Details
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form id="myform" action="Dashboard.php?userId=<?php echo $userId ?>" method="post">
                                <div class="row gx-3 mb-3">
                                  <!-- Form Group (first name)-->
                                  <div c class="col-md-6">
                                    <label class="small mb-1" for="ModalName">Name</label>
                                    <input class="form-control" name="ModalName" id="ModalName" type="text" />
                                  </div>
                                  <!-- Form Group (last name)-->
                                  <div class="col-md-6">
                                    <label class="small mb-1" for="ModalEmail">Email</label>
                                    <input type="email" name="ModalEmail" id="ModalEmail" class="form-control" />
                                  </div>
                                </div>

                                <div class="row gx-3 mb-3">
                                  <!-- Form Group (first name)-->
                                  <div class="col-md-6">
                                    <label class="small mb-1" for="ModalId">Id</label>
                                    <input class="form-control" name="ModalId" id="ModalId" type="text" />
                                  </div>
                                  <!-- Form Group (last name)-->
                                  <div class="col-md-6">
                                    <label class="small mb-1" for="ModalDate">Date</label>
                                    <input type="date" name="ModalDate" id="ModalDate" class="form-control" />
                                  </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                  <!-- Form Group (first name)-->
                                  <div class="col-md-6">
                                    <label class="small mb-1" for="ModalSalary">Salary</label>
                                    <input class="form-control" name="ModalSalary" id="ModalSalary" type="text" />
                                  </div>
                                  <!-- Form Group (last name)-->
                                  <div class="col-md-6">
                                    <label class="small mb-1" for="ModalStatus">Status</label>
                                    <input class="form-control" name="ModalStatus" id="ModalStatus" type="text" />
                                  </div>
                                </div>


                              </form>

                              <button form="myform" class="btn btn-outline-primary mt-2 btn-block  modal_button"
                                data-bs-dismiss="modal">
                                Add form
                                <i class="fas fa-paper-plane-o ms-1"></i>
                              </button>
                            </div>


                          </div>
                        </div>
                      </div>
                      <!-- Add Modal end  -->

                      <!-- Delete modal -->
                      <div class="modal fade" id="DeleteButtonModal" tabindex="-1" role="dialog"
                        aria-labelledby="modalDelete" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header text-center">
                              <h4 class="modal-title w-100 font-weight-bold ml-5 text-danger">
                                Delete
                              </h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body mx-3">
                              <p class="text-center h4">
                                Are you sure to delete selected row?
                              </p>
                            </div>
                            <div class="modal-footer d-flex justify-content-center deleteButtonsWrapper">
                              <a type="button" class="btn btn-danger btnYesClass" id="btnYes" data-bs-dismiss="modal">
                                Yes
                              </a>
                              <button type="button" class="btn btn-primary btnNoClass" id="btnNo"
                                data-bs-dismiss="modal" aria-label="Close">
                                No
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--Delete modal end -->
                    </section>

                    <!-- Add Button -->
                    <a href="" class="btn btn-blue btn-rounded btn-sm me-2" data-bs-toggle="modal"
                      data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Add<i
                        class="fas fa-plus-square ms-1"></i></a>
                    <!-- Add Button end-->
                  </div>
                </div>

                <table id="datatablesSimple">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Date</th>
                      <th>Salary</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
            
                      foreach($staffs as $staff){
                        echo '<tr>';
                        echo '<td data-field="name">'.$staff['staff_Id'].'</td>';
                        echo '<td data-field="name">'.$staff['name'].'</td>';
                        echo '<td data-field="name">'.$staff['email'].'</td>';
                        echo '<td data-field="name">'.$staff['date'].'</td>';
                        echo '<td data-field="name">'.$staff['salary'].'</td>';
                        if($staff['status'] == 'F'){
                          echo '<td data-field="name">
                                  <div class="badge bg-info rounded-pill">Full-time</div>
                                </td>';
                        }else{
                          echo '<td data-field="name">
                                  <div class="badge bg-warning rounded-pill"> Part-time</div>
                                </td>';
                        }
                        echo '<td>
                                <a class="btn btn-datatable btn-sm"  href="Delete/delete1.php?id='.$staff['id'].'&userId='.$userId.'"  title="Delete" >
                                <i class="fa-solid fa-trash-can ms-3" style="font-size: 18px;"></i>
                                <i class="fas fa-paper-plane-o ms-1" style="font-size: 15px;"></i>
                                
                                </a>
                              </td>';
                        echo '</tr>';
                     
                    }
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </main>
      <footer class="footer-admin mt-auto footer-light">
        <div class="container-xl px-4">
          <div class="row">
            <div class="col-md-6 small">
              Copyright &copy;yourwebsitename@gmail.com
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!--Bootstrap JS -->
  <script src="js/script3.js"></script>
  <!-- javascript for dropdown -->
  <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="bootstrap-5.1.3/dist/js/scripts.js"></script>

  <!-- javascript for Chart -->
  <script src="bootstrap-5.1.3/dist/js/Chart.min.js"></script>
  <!-- Chart 1 -->

  <script src="js/script5.js" crossorigin="anonymous"></script>

  <script src="js/datatables/datatables-simple-demo.js"></script>

  <script src="js/script6.js" crossorigin="anonymous"></script>

  <script src="js/litepicker.js"></script>

  <script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  (Chart.defaults.global.defaultFontFamily = "Metropolis"),
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = "#858796";

  function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + "").replace(",", "").replace(" ", "");
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
      dec = typeof dec_point === "undefined" ? "." : dec_point,
      s = "",
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return "" + Math.round(n * k) / k;
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
      s[1] = s[1] || "";
      s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
  }

  // Area Chart Example
  var ctx = document.getElementById("myAreaChart");
  var myLineChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
      ],
      datasets: [{
        label: "Earnings",
        lineTension: 0.3,
        backgroundColor: "rgba(0, 97, 242, 0.05)",
        borderColor: "rgba(0, 97, 242, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(0, 97, 242, 1)",
        pointBorderColor: "rgba(0, 97, 242, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(0, 97, 242, 1)",
        pointHoverBorderColor: "rgba(0, 97, 242, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: [
          <?php
                      $j = 0;
                      for($i=1; $i<=12; $i++){
                        if($j < count($graph) && $graph[$j]['month'] == $i){
                          echo $graph[$j]['total'] . ', ';
                          $j+=1;
                        }else{
                          echo '0,';
                        }
                      }

                  ?>

        ]
      }]
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: "date"
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 7
          }
        }],
        yAxes: [{
          ticks: {
            maxTicksLimit: 10,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return number_format(value) + " Tk";
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }]
      },
      legend: {
        display: false
      },
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: "#6e707e",
        titleFontSize: 14,
        borderColor: "#dddfeb",
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: "index",
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel =
              chart.datasets[tooltipItem.datasetIndex].label || "";
            return datasetLabel + number_format(tooltipItem.yLabel) + ": TK";
          }
        }
      }
    }
  });
  </script>

  <!--  -->
  <script src="js/script4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"></script>



</body>

</html>