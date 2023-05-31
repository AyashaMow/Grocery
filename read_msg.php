<?php


include 'DbConnect/connection.php';
if(isset($_GET['id']))
{
    $main_id = $_GET['id'];
    $sql_update = mysqli_query($con, "UPDATE message SET status=1 WHERE id = '$main_id'");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
    crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/own_style.css">

    <title>Notification</title>
  </head>
  <body>
    
  <div class="container" id="table1">
    <div class="row">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Serial No</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Product Name</th>
      <th scope="col"> Customer Message</th>
      <th scope="col">Date</th>
      <th scope="col">Delete</th>
      
    

    </tr>
  </thead>
  <tbody>
    <?php
    $sr_no=1;
    $sql_get = mysqli_query($con, "SELECT *FROM message WHERE status=1");
    while($main_result = mysqli_fetch_assoc($sql_get)) :?>
    <tr>
      <th scope="row"><?php echo $sr_no++; ?></th>
      <td><?php echo $main_result['cus_name']; ?></td>
      <td><?php echo $main_result['pro_name']; ?></td>
      <td><?php echo $main_result['message']; ?></td>
      <td><?php echo $main_result['cr_date']; ?></td>
      <td><a href="delete.php?id=<?php echo $main_result['id'];
      ?>" class="text-danger"><i class="fas fa-trash"></i></a></td>
    </tr>
    <?php endwhile ?>
   </tbody>
   </table>
    </div>
   </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>