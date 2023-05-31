<?php
    include 'DbConnect/connection.php';
    //delete user
    $id = $_GET['id'];
    //set the name;
    $userId = $_GET['userId'];
    
    $sql1 = "SELECT product_name FROM `price_table` WHERE id = '$id'"; //Query for search;
    $result1 = $con->query($sql1); // location of the database where this query will be search 
    $product_names = mysqli_fetch_assoc($result1);

    $sql2 = "SELECT price FROM `price_table` WHERE id = '$id'";
    $result2 = $con->query($sql2);
    $prices = mysqli_fetch_assoc($result2);


    $product_name =  $product_names['product_name'];
    $price =  $prices['price'];
  
    
    $sql = "INSERT INTO `bill` (`product_name`, `price`) VALUES ('$product_name','$price');";
      if($con->query($sql)== true){
        header("Location: Purchase(staff).php?userId=$userId");
      }
      else{
        header("Location: Purchase(staff).php?success=0");
      }    
    

    $con->close();
?>