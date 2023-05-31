<?php      

  include 'DbConnect/connection.php';
  session_start();
  if(isset($_SESSION['Email']))
  {    
      echo "<script>location.href='Dashboard.php'</script>";
  }

  $insert = false;
  
  if(isset($_POST['Email'])){
    
    $Email = $_POST['Email'];  
    $Password = $_POST['Password'];  
    
    $Email = stripcslashes($Email);  
    $Password = stripcslashes($Password);  
    
      
    $sql1 = "SELECT *FROM `registered_user` WHERE email = '$Email' AND password = '$Password';";
    $result1 = mysqli_query($con, $sql1);  
    $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);  
    $count1 = mysqli_num_rows($result1);
    
    $sql2 = "SELECT *FROM `dashboard_table` WHERE email = '$Email' AND password = '$Password'";
    $result2 = mysqli_query($con, $sql2);  
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);  
    $count2 = mysqli_num_rows($result2);

      
    if($count1 == 1){
      $sql3 = "SELECT Shop_Id FROM `registered_user` WHERE email = '$Email'";
      $result3 = $con->query($sql3); 
      if($result3){
        $userId = mysqli_fetch_array($result3, MYSQLI_ASSOC);  
      }

      $sql4 = "SELECT Shop_Name FROM `registered_user` WHERE email = '$Email'";
      $result4 = $con->query($sql4); 
      if($result4){
        $userId2 = mysqli_fetch_array($result4, MYSQLI_ASSOC);  
      }

      session_start();
      $_SESSION['Email'] = $Email;
      $_SESSION['Shop_Id'] = $userId['Shop_Id'];
      $_SESSION['Shop_Name'] = $userId2['Shop_Name'];
      header('Location: Dashboard.php?userId='.$userId['Shop_Id'].'');

    }
    elseif($count2 == 1)
    {
      $sql4 = "SELECT Shop_Id FROM `dashboard_table` WHERE email = '$Email'";
      $result4 = $con->query($sql4); 
      if($result4){
        $userId = mysqli_fetch_array($result4, MYSQLI_ASSOC);  
      }

      $sql4 = "SELECT Shop_Name FROM `dashboard_table` WHERE email = '$Email'";
      $result4 = $con->query($sql4); 
      if($result4){
        $userId2 = mysqli_fetch_array($result4, MYSQLI_ASSOC);  
      }

      session_start();
      $_SESSION['Email'] = $Email;
      $_SESSION['Shop_Id'] = $userId['shop_Id'];
      $_SESSION['Shop_Name'] = $userId2['Shop_Name'];

      header('Location: Purchase(staff).php?userId='.$userId['Shop_Id'].'');
    }
    else{
      
      header('Location: Login.php?id=0');
    }   
  }
  
  $con->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Phonix Checking</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	      <script src="https://kit.fontawesome.com/a81368914c.js"></script>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style>
            html, body {
            height: 100%;
            width: 85%;
            }

            html {
                display:table;
                margin: auto;
    
            }

            body {
                display: table-cell;
                vertical-align: middle;
                
            }
            *{
              padding: 0;
              margin: 0;
              box-sizing: border-box;
            }

            body{
                font-family: 'Poppins', sans-serif;
                overflow: hidden;
            }



            .container{
                width: 100vw;
                height: 100vh;
                top:300px;
                display:grid;
                grid-template-columns: repeat(2, 1fr);
                grid-gap :7rem;
                padding: 0 2rem;
            }

            .image {
              width: 100%;
              transition: transform 1.1s ease-in-out;
              transition-delay: 0.4s;
            }

            form{
              width: 360px;
            }





            .btn{
              display: block;
              width: 100%;
              height: 50px;
              border-radius: 30px;
              outline: none;
              border: none;
              background-image: linear-gradient(to right, #b953c7, #2216E6,#3E34E0);
              background-size: 200%;
              font-size: 1.5rem;
              color: #fff;
              font-family: 'Poppins', sans-serif;
              text-transform: uppercase;
              margin: 1rem 0;
              cursor: pointer;
              transition: .5s;
            }
            .btn:hover{
              background-position: right;
            }
            .panels-container {
              position: absolute;
              height: 100%;
              width: 100%;
              top: 0;
              left: 0;
              display: grid;
              grid-template-columns: repeat(2, 1fr);
            }

            .container:before {
              content: "";
              position: absolute;
              height: 2000px;
              width: 2000px;
              top: -10%;
              right: 48%;
              transform: translateY(-58%);
              background-image: linear-gradient(-45deg, #6C63FF 0%, #3E34E0 100%);
              transition: 1.8s ease-in-out;
              border-radius: 50%;
              z-index: 6;
            }



            .panel {
              display: flex;
              flex-direction: column;
              align-items: flex-end;
              justify-content: space-around;
              text-align: center;
              z-index: 6;
            }

            .left-panel {
              pointer-events: all;
              padding: 3rem 17% 2rem 12%;
            }



            .panel .content {
              color: #fff;
              transition: transform 0.9s ease-in-out;
              transition-delay: 0.6s;
            }

            .panel h3 {
              font-weight:600;
              line-height: 1;
              font-size: 1.5rem;
            }

            .panel p {
              font-size: 0.95rem;
              padding: 0.7rem 0;
            }


            .right-panel .image,
            .right-panel .content {
              transform: translateX(800px);
            }

            @media (max-width: 870px) {
              .container {
                min-height: 800px;
                height: 100vh;
              }
              .signin-signup {
                width: 100%;
                top: 95%;
                transform: translate(-50%, -100%);
                transition: 1s 0.8s ease-in-out;
              }

              .signin-signup,
              .container.sign-up-mode .signin-signup {
                left: 50%;
              }

              .panels-container {
                grid-template-columns: 1fr;
                grid-template-rows: 1fr 2fr 1fr;
              }

              .panel {
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                padding: 2.5rem 8%;
                grid-column: 1 / 2;
              }

              .right-panel {
                grid-row: 3 / 4;
              }

              .left-panel {
                grid-row: 1 / 2;
              }

              .image {
                width: 200px;
                transition: transform 0.9s ease-in-out;
                transition-delay: 0.6s;
              }

              .panel .content {
                padding-right: 15%;
                transition: transform 0.9s ease-in-out;
                transition-delay: 0.8s;
              }

              .panel h3 {
                font-size: 1.2rem;
              }

              .panel p {
                font-size: 0.7rem;
                padding: 0.5rem 0;
              }

              .btn.transparent {
                width: 110px;
                height: 35px;
                font-size: 0.7rem;
              }

              .container:before {
                width: 1500px;
                height: 1500px;
                transform: translateX(-50%);
                left: 30%;
                bottom: 68%;
                right: initial;
                top: initial;
                transition: 2s ease-in-out;
              }

              .container.sign-up-mode:before {
                transform: translate(-50%, 100%);
                bottom: 32%;
                right: initial;
              }

              .container.sign-up-mode .left-panel .image,
              .container.sign-up-mode .left-panel .content {
                transform: translateY(-300px);
              }

              .container.sign-up-mode .right-panel .image,
              .container.sign-up-mode .right-panel .content {
                transform: translateY(0px);
              }

              .right-panel .image,
              .right-panel .content {
                transform: translateY(300px);
              }

              .container.sign-up-mode .signin-signup {
                top: 5%;
                transform: translate(-50%, 0);
              }
            }

            @media (max-width: 570px) {
              form {
                padding: 0 1.5rem;
              }

              .image {
                display: none;
              }
              .panel .content {
                padding: 0.5rem 1rem;
              }
              .container {
                padding: 1.5rem;
              }

              .container:before {
                bottom: 72%;
                left: 50%;
              }

              .container.sign-up-mode:before {
                bottom: 28%;
                left: 50%;
              }
            }

        </style>


    </head>

    <body>
        <script>
            function showPassword(){
                var pass = document.getElementById("Password");
                if(document.getElementById("logInFormPasswordShow").checked==true){
                    pass.setAttribute("type","text");
                    
                }
                else{
                    pass.setAttribute("type","password");
                }
            }
            
        </script>
        <div class="container">
          
             
        <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
             We can see previous projects And get ideas through this web app!
            </p>
            
          </div>
          <img src="assets/img/undraw_shopping_app_flsj.svg" class="image" alt="" />
        </div>
        
        <div class="container-fluid">
                <div class="col">
                    <div class="row navbar justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <form action="Login.php" method="post" style="margin-top: 100pt;
                            margin-bottom: 70pt;">
                               <h2 style="text-align: center; font-weight: bold;" >LogIn</h1>
                                <div class="mb-3" >
                                
                                  <label for="exampleInputEmail1" class="form-label">Email</label>
                                
                                <input type="email" class="form-control" name="Email" required>
                                 
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="Password" 
                                    id="Password" required>
                                    <div style="text-align: left; width: 100%; " class="my-3" >
                                        <input class="form-check-input " 
                                        id="logInFormPasswordShow" onchange="showPassword()" type="checkbox" > 
                                        <label class="form-check-label" for="exampleCheck1">
                                          Show Password</label>
                                    </div>
                                </div>
        
                                
                                <button type="submit" class="btn btn-primary col-12 mt-4;" style=" font-weight: bold;" 
                                 name="submit">Login</button>
                                <div class="mt-4">
                                    <label for="exampleInputEmail1" class="form-label">
                                        Are You New User?</label>
                                    <a id="areyounewuser" href="Register.php" 
                                    style="color: black; font-weight: bold;">Signup</a>
                                </div>

                              </form>                              
                        </div>
                    </div>
                        
                </div>
                </div>
          </div>
                
        <script type="text/javascript" src="js/main.js"></script>
        


    </body>
</html>

