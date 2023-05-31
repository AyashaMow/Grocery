<?php
    include 'DbConnect/connection.php';

    $ShopName = $_POST['ShopName'];
    $ShopId = $_POST['ShopId'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $Email = $_POST['Email'];
    $Location = $_POST['Location'];
    $Password = $_POST['Password'];
      
      
    $sql = "INSERT INTO `registered_user` (`Shop_Name`,`Shop_Id`, `contact`, `email`, `location`, `password`)
    VALUES ('$ShopName','$ShopId','$PhoneNumber', '$Email', '$Location', '$Password');";
  
    if($con->query($sql)== true){
      header("Location: Register.php?success=1");
    }
    else{
      header("Location: Register.php?success=0");
    }
   

    
    $con->close();
?>