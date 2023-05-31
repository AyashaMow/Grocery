<?php
    include 'DbConnect/connection.php';
    include 'ProfilePictureOperation.php';
    include 'SessionCheck.php';
    $tests = [];
    $sql = "SELECT * FROM `bill` ORDER BY `id` DESC";
    $result = $con->query($sql);
    if($result){
      $tests = $result->fetch_all(MYSQLI_ASSOC);
    }

    
    $userId = $_GET['userId'];
    $names = [];
    $sql = "SELECT * FROM `registered_user` WHERE Shop_Id = '$userId'";
    $result = mysqli_query($con, $sql);  
    $names = mysqli_fetch_array($result, MYSQLI_ASSOC); 
    $userEmail = $names['email'];
    $userBrand = $names['Shop_Name'];
    
    $hash = "#";
    
    $dateString =  gmdate("dnyGis", time()+6*60*60);
    
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
  <title>Purchase</title>
  <link href="css/style1.css" rel="stylesheet" />
  <link href="css/style2.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />

  <script data-search-pseudo-elements defer src="js/script1.js" crossorigin="anonymous"></script>
  <script src="js/script2.js" crossorigin="anonymous">
  </script>
  <style>
  .table-wrap {
    height: 424px;
  }

  .table-wrap1 {
    overflow-y: auto;
  }


  #show {
    display: none;
  }

  ul#results {
    list-style: none;
    width: 200px;
    margin: 0;
    padding: 0;
    display: none;
    margin-top: 10px;
    border: none;
  }

  ul#results li a {
    color: #000;
    background: white;
    display: block;
    text-decoration: none;
  }

  ul#results li a:hover {
    background: #e0e5ec;
  }
  </style>
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

    <?php echo '<p class="navbar-brand pe-2 ps-4 ps-lg-2" >'.$_SESSION['Shop_Name'].'</p>' ?>


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


            <!-- Add customer start -->
            <?php 
                echo 
                    '<a class="nav-link active" href="Purchase(staff).php?userId='.$userId.'">
                      <div class="nav-link-icon"><i data-feather="shopping-cart" style="font-size: 15px"></i></div>
                      Purchase
                    </a>' 
            ?>

            <!-- Add customer end -->

            <!-- Customer Information start -->
            <?php 
                echo 
                    '<a class="nav-link" href="Customer_Information(staff).php?userId='.$userId.'">
                      <div class="nav-link-icon">
                        <i class="fa fa-search" aria-hidden="true" style="font-size: 15px"></i>
                      </div>
                      Customer Information
                    </a>' 
            ?>

            <!-- Customer Information end -->


            <!-- Product Price start -->
            <?php 
                echo 
                    '<a class="nav-link" href="Product_price(staff).php?userId='.$userId.'">
                      <div class="nav-link-icon">
                        <i class="fa fa-list" aria-hidden="true"></i>
                      </div>
                      Product Price
                    </a>'  
            ?>

            <!-- Product Price end -->

            <!-- Feedback start -->
                <?php 
                echo 
                    '<a class="nav-link" href="Product_price(staff).php?userId='.$userId.'">
                      <div class="nav-link-icon">
                        <i class="fas fa-comment" aria-hidden="true"></i>
                      </div>
                     Feedback
                    </a>'  
            ?>

            <!-- Feedback end -->









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

    <!-- Dashbord -->
    <div id="layoutSidenav_content">
      <main>
        <!-- Main page content-->
        <div class="px-4 mt-4">
          <!-- Add customer-->
          <div class="card">
            <div class="card-header  d-flex">
              <div class="col-5">Customer details</div>
              <div class="col-2 m-0 pt-2 pb-1  alert alert-success  alert-dismissible fade show" id="show" role="alert">
                <strong>Successfully inserted !</strong>
              </div>
            </div>
            <div class="card-body p-4 p-md-5 row justify-content-between">
              <!-- customer Information part -->

              <form id="myform" action="Purchase(staff).php?userId=<?php echo $userId?>" method="post"
                class="row d-flex justify-content-between">

                <!-- customer Test part -->
                <section class="col-xl-4 ">
                  <!-- Form Row-->

                  <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                      <label class="small mb-1" for="customerID">Customer ID</label>
                      <input class="form-control" name="customerID" id="customerID" type="text"
                        value="<?php echo $hash.''.$dateString ?>" readonly />
                    </div>

                    <div class="col-md-6">
                      <label class="small mb-1" for="date">Date</label>
                      <input type="date" name="date" id="date" class="form-control" />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="small mb-1" for="customerName">Customer Name</label>
                    <input class="form-control" name="customerName" id="customerName" type="text" />
                  </div>
                  <!-- Form Row-->
                  <div class="row gx-3 mb-3">
                    <div class="col-md-8">
                      <label class="small mb-1" for="contact">Customer number</label>
                      <input class="form-control" name="contact" id="contact" type="text" />
                    </div>

                  </div>



                </section>

                <!-- customer Test part -->
                <section class="col-xl-6">
                  <div class="table-responsive table-wrap">
                    <div class="d-flex justify-content-between bd-highlight">
                      <div class="dataTable-search mb-3">
                        <label class="small mb-1" for="search">Product Name</label>
                        <input class="form-control" placeholder="Search..." type="text" id="search" name="search"
                          value="" />
                        <ul id="results">

                        </ul>
                      </div>


                    </div>

                    <table class="table">
                      <thead>
                        <tr>
                          <th>Product Name</th>
                          <th>Rate</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="table-wrap1" id="myTable">
                        <?php
                          $total_price = 0;
                          foreach($tests as $test){
                            echo '<tr>';
                            echo '<td data-field="name">'.$test['product_name'].'</td>';
                            echo '<td data-field="name">'.$test['price'].'</td>';
                            echo '<td>
                                    <a class="btn btn-datatable btn-sm"  href="Delete/delete2(staff).php?id='.$test['id'].'&userId='.$userId.'"  title="Delete" >
                                    <i class="fa-solid fa-trash-can ms-3" style="font-size: 18px;"></i>
                                    <i class="fas fa-paper-plane-o ms-1" style="font-size: 15px;"></i>
                                    </a>
                                  </td>';
                            echo '</tr>';
                            
                            $total_price+= $test['price'];
                          }  
                      ?>
                      </tbody>
                    </table>
                  </div>
                </section>


                <!-- customer bill part -->
                <section class="col-xl-2 ">

                  <div class="mb-3">
                    <label class="small mb-1" for="subTotal">Sub Total</label>
                    <input class="form-control" name="subTotal" id="subTotal" type="text" value="" readonly />
                  </div>
                  <div class="mb-3">
                    <label class="small mb-1" for="inputDiscount">Discount Tk</label>
                    <input class="form-control search" name="inputDiscount" id="inputDiscount" type="text" />
                  </div>
                  <div class=" mb-3">
                    <label class="small mb-1" for="inputNetPayable">Net Payable</label>
                    <input class="form-control" id="inputNetPayable" type="text" value="" readonly />
                  </div>

                  <div class="mb-3">
                    <label class="small mb-1 search" for="paidTk">Total Paid</label>
                    <input class="form-control" name="paidTk" id="paidTk" type="text" />
                  </div>


                </section>
              </form>
            </div>
            <div class="card-footer p-4 p-lg-5 border-top-0">

              <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <input class="btn btn-primary" type="submit" name="submit" id="submitBtn" value="Submit" />
                  <button class="btn btn-primary" type="button" id="invoiceBtn">
                    Invoice
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      <footer class="footer-admin mt-auto footer-light">
        <div class="container-xl px-4">
          <div class="row">
            <div class="col-md-6 small">
              Copyright &copy;Websitename@gmail.com
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!--Bootstrap JS -->
  <script src="js/script4.js"></script>



  <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  

  <script src="bootstrap-5.1.3/dist/js/scripts.js"></script>

  <script src="js/script5.js" crossorigin="anonymous"></script>

  <script src="js/datatables/datatables-simple-demo.js"></script>

  <script src="js/script6.js" crossorigin="anonymous"></script>

  <script src="js/litepicker.js"></script>


  <script src="js/script3.js"></script>
  <!--  Creating Ajax Request to send Search Value -->


  <script type="text/javascript">
  var results = document.getElementById("results");
  var show = document.getElementById("show");

  const params = new URLSearchParams(window.location.search);
  const userId = params.get('userId');
  search.addEventListener("input", getSearchResults);




  function getSearchResults() {
    var searchVal = search.value;

    if (searchVal.length < 1) {
      results.style.display = 'none';
      return;
    }
    getData = 'search=' + searchVal + '&userId=' + userId;
    $.ajax({
      url: "searchBox(staff).php",
      type: "GET",
      data: getData,
      success: function(data, status, xhr) {

        var text = xhr.responseText;

        results.innerHTML = text;
        results.style.display = 'block';


      },
      error: function(jqXHR, status, errorThrown) {

      }
    });
  }


  $("#submitBtn").click(function() {

    var customerID = $('#customerID').val();
    var customerName = $('#customerName').val();
    var date = $('#date').val();
    var contact = $('#contact').val();
    var subTotal = $('#subTotal').val();
    var discount = $('#inputDiscount').val();
    var paidTk = $('#paidTk').val();


    var postData = 'customerID=' + customerID + '&customerName=' + customerName + '&date=' + date + '&contact=' +
      contact + '&age=' + '&subTotal=' +
      subTotal + '&discount=' + discount + '&paidTk=' + paidTk + '&userId=' + userId;



    $.ajax({
      url: "Customer_data.php",
      type: "POST",
      data: postData,
      success: function(data, status, xhr) {

        show.style.display = 'block';
        $("#show").fadeTo(1000, 300).slideUp(300, function() {
          $("#show").slideUp(300);
        });

      },
      error: function(jqXHR, status, errorThrown) {
        alert("Failed insert");
      }
    });
  });
  </script>

  <!-- bill -->
  <script>
  var total_price = <?php echo $total_price ?>;
  subTotal.value = total_price;


  var NetPayable;
  $("#inputDiscount").on("keydown", function search(e) {
    if (e.keyCode == 45) {
      var Discount = $(this).val();
      NetPayable = total_price - Discount;
      inputNetPayable.value = NetPayable;
    }
  });

  $("#paidTk").on("keydown", function search(e) {
    if (e.keyCode == 45) {
      var TotalPaid = $(this).val();
      var DueTk = NetPayable - TotalPaid;
      dueTk.value = DueTk;
    }
  });

  document.getElementById("invoiceBtn").onclick = function() {
    location.href = "invoice(staff).php?userId=" + userId;
  }
  </script>

  <script src="https:
  <script src=" https: integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous">
  </script>
</body>

</html>