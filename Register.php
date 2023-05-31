<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Phonix Checking</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

      <link href="css/styles.css" rel="stylesheet" />
  <script data-search-pseudo-elements defer src="js/script1.js" crossorigin="anonymous"></script>
  <script src="js/script2.js" crossorigin="anonymous">
  </script>
  
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
<style>
 

  .form_control_custom.success input {
    border-color: var(--succes-color);
  }

  .form_control_custom.error input {
    border-color: var(--error-color);
  }

  .form_control_custom small {
    color: var(--error-color);

    display: none;
  }

  .form_control_custom.error small {
    display: block;
  }
  </style>

    </head>

    <body>
    <script>
            function showPassword(){
                var pass = document.getElementById("fPassword");
                if(document.getElementById("logInFormPasswordShow").checked==true){
                    pass.setAttribute("type","text");
                    
                }
                else{
                    pass.setAttribute("type","password");
                }
            }
            function showPassword2(){
                var pass = document.getElementById("fConfirmPassword");
                if(document.getElementById("logInFormPasswordShow2").checked==true){
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
          <img src="assets/img/undraw_online_groceries_a02y.svg" class="image" alt="" />
        </div>
        <div class="container-fluid">
            
             
            
                
    
                <div class="col">
                    <div class="row justify-content-center mt-4">
                        <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
                            <form>
                                <h2 style="text-align: center;margin-bottom:48px;">SignUp</h2>
                                <div class="row gx-3">
                                  <div class="col-md-6 mb-3">
                                    <!-- Form Group (first name)-->
                                    <div class="form_control_custom ">
                                      <label class="small mb-1" for="ShopName">Shop Name</label>
                                      <input class=" form-control" name="ShopName" id="ShopName" type="text"
                                        placeholder="Enter Shop Name" />
                                      <small class="mt-1" style="font-size: 12px">Error Message</small>
                                    </div>

                                  </div>
                                  <div class=" mb-3 col-md-6">
                                    <!-- Form Group (last name)-->
                                    <div class="form_control_custom ">
                                      <label class="small mb-1" for="ShopId">Shop Id</label>
                                      <input class=" form-control" name="ShopId" id="ShopId" type="text" placeholder="Enter Shop Id" />
                                      <small class="mt-1" style="font-size: 12px">Error Message</small>
                                    </div>

                                  </div>
                                </div>
                                <div class="row gx-3">
                                  <div class="col-md-6 mb-3 ">
                                    <div class="form_control_custom">
                                      <label class="small mb-1" for="Email">Email</label>
                                      <input class="form-control" name="Email" id="Email" type="email" aria-describedby="emailHelp"
                                        placeholder="Enter email address" />
                                      <small class="mt-1" style="font-size: 12px">Error Message</small>
                                    </div>

                                  </div>

                                  <div class="col-md-6  mb-3">
                                    <!-- Form Group (last name)-->
                                    <div class="form_control_custom">
                                      <label class="small mb-1" for="PhoneNumber">Phone Number</label>
                                      <input class="form-control" name="PhoneNumber" id="PhoneNumber" type="text"
                                        placeholder="Enter Shop Contact Number" />
                                      <small class="mt-1" style="font-size: 12px">Error Message</small>
                                    </div>

                                  </div>

                                </div>
                                <!-- Form Group (address) -->
                                <div class="mb-3 ">
                                  <div class="form_control_custom ">
                                    <label class="small mb-1" for="Location">Location</label>
                                    <input class="form-control" name="Location" id="Location" type="text"
                                      placeholder="Enter Shop Location" />
                                    <small class="mt-1" style="font-size: 12px">Error Message</small>
                                  </div>

                                </div>

                                <div class="row gx-3">
                                  <div class="col-md-6 mb-3">
                                    <!-- Form Group (password)-->
                                    <div class="form_control_custom">
                                      <label class="small mb-1" for="Password">Password</label>
                                      <input class="form-control" name="Password" id="Password" type="password"
                                        placeholder="Enter password" />
                                      <small class="mt-1" style="font-size: 12px">Error Message</small>
                                    </div>

                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <!-- Form Group (confirm password)-->
                                    <div class="form_control_custom">
                                      <label class="small mb-1" for="Password2">Confirm Password</label>
                                      <input class="form-control" type="password" name="Password2" id="Password2"
                                        placeholder="Confirm password" />
                                      <small class="mt-1" style="font-size: 12px">Error Message</small>
                                    </div>


                                  </div>
                                </div>                                                          
                              
                            </form>

                            <div>
                                <button class="mt-4 btn btn-primary col-12" style="font-size:12pt;" id="submitBtn" name="submitBtn">Create Account</button>
                                <div class="mt-4">
                                    <label for="exampleInputEmail1" class="form-label"><div class="mt-4"> </label>
                                    <label for="exampleInputEmail1" class="form-label">Already Have Account?</label>
                                    <a id="alreadyHaveAccount" href="Login.php" style="color: black; font-weight: bold;">Log in</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>
                </div>
          </div>
                
        <script type="text/javascript" src="js/main.js"></script>
        

        <link src="https:
  <!-- javascript for dropdown -->
  <script src=" bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js">
  </script>

  <script src="bootstrap-5.1.3/dist/js/scripts.js"></script>

  <script src="js/script5.js" crossorigin="anonymous"></script>

  <script src="js/datatables/datatables-simple-demo.js"></script>

  <script src="js/script6.js" crossorigin="anonymous"></script>

  <script src="js/litepicker.js"></script>

  <script src="js/script3.js"></script>


  <script>
    var insert = false;
    var f1 = 0,
      f2 = 0,
      f3 = 0,
      f4 = 0,
      f5 = 0,
      f6 = 0;

    var ShopName = document.getElementById("ShopName");
    var ShopId = document.getElementById("ShopId");
    var Email = document.getElementById("Email");
    var PhoneNumber = document.getElementById("PhoneNumber");
    var Location = document.getElementById("Location");
    var Password = document.getElementById("Password");
    var Password2 = document.getElementById("Password2");

    var mobileRegex = /^(\+88)?(\+88-)?01[3-9]\d{8}$/;
    var emailRegex = /^[a-z0-9]*[a-z]+[a-z0-9]*@([a-z]+)\.(com)$/;
    var passwordRegex = /(?=.*\d+)(?=.*[A-Z]+)(?=.*[!?@#$%^&*(){}\[\]_+\-=\\]+).{6,}/;


    function showError(input, message) {
      const formControl = input.parentElement;
      formControl.className = "form_control_custom error";
      const small = formControl.querySelector("small");
      small.innerText = message;
    }


    function showSucces(input) {
      const formControl = input.parentElement;
      formControl.className = "form_control_custom success";
    }


    function checkName(input) {
      if (input.value.trim() === "") {
        insert = false;
        showError(input, "Can't be empty!");
      } else {
        f1 = 1;
        showSucces(input);
      }
    }


    function checkId(input) {
      if (input.value.trim() === "") {
        insert = false;
        showError(input, "Can't be empty!");
      } else {
        f2 = 1;
        showSucces(input);
      }
    }

    function checkLocation(input) {
      if (input.value.trim() === "") {
        insert = false;
        showError(input, "Can't be empty!");
      } else {
        f3 = 1;
        showSucces(input);
      }
    }


    function checkEmail(input) {
      if (emailRegex.test(input.value.trim())) {
        f4 = 1;
        showSucces(input);
      } else {
        insert = false;
        showError(input, "Email is not invalid");
      }
    }


    function checkNumber(input) {
      if (mobileRegex.test(input.value.trim())) {
        f5 = 1;
        showSucces(input);
      } else {
        insert = false;
        showError(input, "Number is not invalid");
      }

    }




    function checkPassword(input) {
      if (passwordRegex.test(input.value.trim())) {
        showSucces(input);
      } else {
        insert = false;
        showError(input,
          "Use 6 or more characters with at least one digit & One capital letter, one special character.");
      }
    }


    function checkPasswordMatch(input1, input2) {
      if ((input1.value.trim() !== "")) {
        if (input1.value !== input2.value) {
          insert = false;
          showError(input2, "Passwords do not match");
        } else {
          showSucces(input2)
          f6 = 1;
        }
      }

    }





    $("#submitBtn").click(function() {

      checkName(ShopName);
      checkId(ShopId);
      checkLocation(Location);
      checkNumber(PhoneNumber);
      checkPassword(Password);
      checkEmail(Email);
      checkPasswordMatch(Password, Password2);

      if (f1 == 1 && f2 == 1 && f3 == 1 && f4 == 1 && f5 == 1 && f6 == 1) {
        insert = true;
      }
      alert("Workings");
      if (insert == true) {

        var postData = 'ShopName=' + ShopName.value + '&ShopId=' + ShopId.value +
          '&Email=' +
          Email.value +
          '&PhoneNumber=' + PhoneNumber.value + '&Location=' + Location.value + '&Password=' + Password.value;

        alert("Working");

        $.ajax({
          url: "Register_data.php",
          type: "POST",
          data: postData,
          success: function(data, status, xhr) {

            location.reload();

          },
          error: function(jqXHR, status, errorThrown) {

          }
        });
      }
    });
  </script>
  </body>
</html>


