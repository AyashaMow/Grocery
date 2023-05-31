<?php
    
    include 'DbConnect/connection.php';

    $userId = $_GET['userId'];
  
    
    $alldata = [];
    $sql1 = "SELECT * FROM `customer_data` ORDER BY id DESC LIMIT 1;";
    $result1 = mysqli_query($con, $sql1);  
    $alldata = mysqli_fetch_array($result1, MYSQLI_ASSOC); 

    $customerID = $alldata['customerID'];
    $date = $alldata['date'];
    $customerName = $alldata['customerName'];
    $customercontact = $alldata['contact'];
    $customerID = $alldata['customerID'];
    $subTotal = $alldata['subTotal'];
    $discount = $alldata['discount'];
    $paidTk = $alldata['paidTk'];
  

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
    $userLocation = $names['location'];
    $userBrand = $names['Shop_Name'];
    $userConatct = $names['contact'];

    
    
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
  <title>Invoice</title>


  <link href="css/styles.css" rel="stylesheet" />


  <script data-search-pseudo-elements defer src="js/script1.js" crossorigin="anonymous"></script>
  <script src="js/script2.js" crossorigin="anonymous">
  </script>
  <style>
  @media print {
    @page {
      size: auto;

      margin: 0px;

    }

    .billpart {
      margin-right: -30px;
    }

    body * {
      visibility: hidden;
    }

    #section-to-print * {
      visibility: visible;

    }

    #section-to-print {
      position: absolute;

      left: 0;
      top: 0;
    }
  }
  </style>
</head>

<body>
  <main id="printableArea">
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4" id="section-to-print">
      <!-- Invoice-->
      <div class="card card-waves invoice ">
        <div class="card-header p-4 p-md-5 border-bottom-0 bg-light bg-gradient text-black-50">
          <div class="row justify-content-between align-items-center">
            <div class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-start">
              <!-- Invoice branding-->
              <img class="invoice-brand-img rounded-circle mb-4" src="assets/img/demo/demo-logo.svg" alt="" />
              <?php echo '<div class="h2 text-primary mb-0">'.$userBrand.'</div>' ?>
              Super Shop
            </div>
            <div class="col-12 col-lg-auto text-center text-lg-end">
              <!-- Invoice details-->
              <div class="h3 text-primary ">Invoice</div>
              <?php echo $customerID ?>
              <br />
              <?php echo $date ?>
            </div>
          </div>
        </div>
        <div class="card-body p-4 p-md-5">
          <div class="d-flex justify-content-between mb-5">
            <div>
              <h6 class="mb-3">From:</h6>
              <div>
                <strong><?php echo $userBrand ?></strong>
              </div>
              <div>Location: <?php echo $userLocation ?></div>
              <div>Email: <?php echo $userEmail ?></div>
              <div>Phone: <?php echo $userConatct ?></div>
            </div>

            <div>
              <h6 class="mb-3">To:</h6>
              <div>
                <strong><?php echo $customerName ?></strong>
              </div>

              <div>Phone:<?php echo $customercontact ?></div>
            </div>
          </div>
          <!-- Invoice table-->
          <div class="table-responsive">
            <table class="table table-borderless mb-1">
              <thead>
                <tr class="border-bottom border-bottom-primary ">
                  <th class="col-1">#</th>
                  <th class="col-7">Product Name</th>
                  <th class="col-4">Price</th>
                </tr>
              </thead>
              <tbody>
                <?php
                      $i = 1;
                      foreach($tests as $test){
                        
                        echo '<tr class="border-bottom">';
                        echo '<td class="col-1">'.$i.'</td>';
                        echo '<td class="col-7">'.$test['product_name'].'</td>';
                        echo '<td class="col-4">'.$test['price'].'</td>';
                        echo '</tr>';
              
                        $i++;

                      }
                   ?>
              </tbody>
            </table>
          </div>

          <div class="row billpart">
            <div class="col-lg-4 col-sm-5 ms-auto me-3">
              <table class="table table-clear">
                <tbody>
                  <tr>
                    <td class="left">
                      <strong>Subtotal</strong>
                    </td>
                    <td class="right"><?php echo $subTotal ?></td>
                  </tr>
                  <tr>
                    <td class="left">
                      <strong>Discount</strong>
                    </td>
                    <td class="right"><?php echo $discount ?></td>
                  </tr>
                  <tr>
                    <td class="left">
                      <strong>Paid</strong>
                    </td>
                    <td class="right h5 mb-0 fw-700 text-green">
                      <strong><?php echo $paidTk ?></strong>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <div class="container-xl px-4 mt-4">

    <div class="row">
      <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
        <button type="button" class="btn btn-primary printBtn" onclick="printDiv('printableArea')">Print</button>
        <?php echo '<a class="btn btn-primary" href="Delete/clearALL(staff).php?userId='.$userId.'">Back</a>' ?>
      </div>
    </div>
  </div>


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
    </div>0


    <script src="js/script7.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script>
    function printDiv(printableArea) {
      var printContents = document.getElementById(printableArea).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
    }
    </script>
</body>

</html>