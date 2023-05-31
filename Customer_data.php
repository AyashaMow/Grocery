<?php
    include 'DbConnect/connection.php';
    
      $customerID = $_POST['customerID'];
      $customerName = $_POST['customerName'];
      $date = $_POST['date'];
      $contact = $_POST['contact'];
      $subTotal = $_POST['subTotal'];
      $discount = $_POST['discount'];
      $paidTk = $_POST['paidTk'];
      
      
      
      $sql = "INSERT INTO `customer_data` (`customerName`, `date`, `contact`, `paidTk`,  `customerID` , `subTotal` , `discount`) VALUES
       ('$customerName','$date',' $contact', '$paidTk','$customerID','$subTotal','$discount');";
     
      if($con->query($sql)== true){       
         header("Refresh:0");
      }
      else{
       
      }
   

    
    $con->close();
?>