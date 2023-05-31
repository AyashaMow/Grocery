<?php
    
    include 'DbConnect/connection.php';
      
      $userId = $_GET['userId'];
      $rowId = $_GET['id'];

      $details = [];
      $sql = "SELECT * FROM `price_table` WHERE id = '$rowId'";
      $result = mysqli_query($con, $sql);  
      $details = mysqli_fetch_array($result, MYSQLI_ASSOC);
       
      $product_name = $details['product_name'];
      $product_price = $details['price'];
      


      if(isset($_POST['Nprice'])){

        $product_price = $_POST['Nprice'];
       

        $sql = "UPDATE `price_table` SET price = '$product_price' WHERE id = '$rowId'";
       
        if($con->query($sql)== true){
           header("Refresh:0");
        }
        else{
          header("Location: Product_price(staff).php?userId='.$userId.'");
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
  <title>Update Product Price</title>
  <link href="css/style1.css" rel="stylesheet" />
  <link href="css/style2.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />

  <script data-search-pseudo-elements defer src="js/script1.js" crossorigin="anonymous"></script>
  <script src="js/script2.js" crossorigin="anonymous">
  </script>
</head>

<body class="nav-fixed">
  <div class="d-flex justify-content-center">
    <div class="container px-4">
      <div class="text-center my-5 mt-10">
        <h1 class="text-primary mb-2 display-6 fw-bold">
          Update Product Price
        </h1>
      </div>
      <!-- Pricing table example-->
      <!-- id='.$test['id'].'&userId='.$userId.' -->
      <form id="myform" action="updatePrice(staff).php?id=<?php echo $rowId?>&userId=<?php echo $userId?>" method="post"
        class="row d-flex justify-content-center">
        <!-- Patient Test part -->
        <section class="col-xl-5">
          <div class="row gx-3 mb-3">
            <div class="col-md-6">
              <label class="small mb-1" for="product_name">Product Name</label>
              <input class="form-control" name="product_name" id="product_name" type="text"
                value="<?php echo (isset($product_name))?$product_name:''?>" readonly />
            </div>
            <div class="col-md-6">
              <label class="small mb-1" for="price">Producrt Price</label>
              <input class="form-control" name="price" id="price"
                value="<?php echo (isset($product_price))?$product_price:''?>" type="text" readonly />
            </div>
          </div>

          <div class="col-md-6 ms-auto me-auto mb-3">
            <label class="small mb-1" for="Nprice">New Price</label>
            <input class="form-control" name="Nprice" id="Nprice" value="" type="text" />
          </div>

          <div class="card-footer border-top-0">
            <div class="d-flex">
              <button form="myform" class="btn btn-primary me-2">
                Update
              </button>
              <a class="btn btn-primary" <?php echo 'href="Product_price(staff).php?userId='.$userId.'' ?>
                type="button">Back</a>
            </div>
          </div>
        </section>
      </form>
    </div>
  </div>
  <!--Bootstrap JS -->
  <script src="js/script4.js"></script>
  <script src="https:

  <!-- javascript for dropdown -->
  <script src=" bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="bootstrap-5.1.3/dist/js/scripts.js"></script>

  <script src="js/script5.js" crossorigin="anonymous"></script>

  <script src="js/datatables/datatables-simple-demo.js"></script>

  <script src="js/script6.js" crossorigin="anonymous"></script>

  <script src="js/litepicker.js"></script>

  <script>
  $("#Nprice").on("keydown", function search(e) {
    if (e.keyCode == 45) {
      var Nprice = $(this).val();


      document.getElementById("price").value = Nprice;

    }
  });
  </script>
</body>

</html>