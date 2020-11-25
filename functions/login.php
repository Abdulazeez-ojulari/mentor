
<?php

include("../include/init.php");

$errormsg = "";
$infomesg = "";
$usertype = "";


if(isset($_POST['loginnow'])){


        $email              =   cleaninput($_POST['email']);
        $password           =   cleaninput($_POST['password']);
        $usertype           =   cleaninput($_POST['usertype']);

      if($usertype == 'mentor'){
        $mentors = new Mentors;

        if($mentors->Query($email)){

          if($mentors->CountRows() > 0){

              $row = $mentors->Single();
              $password_real   = $row[3];
              $idis   = $row[0];


              if($password_real == md5($password))
              {
                   $infomesg .= "Password Matched<br>";
              }
              else
              {
                   $errormsg .= "Wrong Email or Password<br>";
              }

          }
          else
              {
                   $errormsg .= "Wr or Password<br>";
              }

              if($errormsg == ""){

                  $infomesg .= "Logined";
                  $_SESSION['idis'] = $idis;
                  header("location:http://localhost/mentor/mentor.php");
                  
           }

        }
         

         /*
              * Submit the form
         */ 


      }else{
        $mentees = new Mentees;
        if($mentees->Query($email)){

          if($mentees->CountRows() > 0){

              $row = $mentees->Single();
              $password_real   = $row[3];
              $idis   = $row[0];

              if($password_real == md5($password))
              {
                   $infomesg .= "Password Matched<br>";
              }
              else
              {
                   $errormsg .= "Wrong Email or Password<br>";
              }

          }
          else
              {
                   $errormsg .= "W or Password<br>";
              }

              if($errormsg == ""){

                  $infomesg .= "Logined";
                  $_SESSION['idis'] = $idis;
                  header("location:http://localhost/mentor/mentee.php");
                  exit();
                  
           }

          }
         

         /*
              * Submit the form
         */ 

         
      }


   /*
       * 
   */


   

   }



?>
<!DOCTYPE html>
<html>
<head>
  <title>Career Couching</title>
  
  <?php
  
  include '../include/top.php';
  
  ?>  
  
</head>
<body>


  <?php

  include '../include/header.php';

  ?>

  
  
   <!-------------------PAGE Content---------------------->



   <div class="container" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>
                <?php if(isset($_SESSION['messeage_d'])){ ?>
                <div class="alert alert-success" style="text-align: center;">               
                  <?php 

                      echo $_SESSION['messeage_d'];

                      unset($_SESSION['messeage_d']);

                   ?>
                </div>
                <?php } ?>

                <?php if($infomesg != ""){ ?>
                <div class="alert alert-success" style="text-align: center;">               
                  <?php echo $infomesg; ?>        
                </div>
                <?php } ?>

                <?php if($errormsg != ""){ ?>
                <div class="alert alert-danger" style="text-align: center;">               
                  <?php echo $errormsg; ?>        
                </div>
                <?php } ?>
                        <div class="card-body">
                    <form method="POST" action="">
                        <input type="hidden" name="_token" value="1f4OpwIwES2fjOmBHlq9vwrO9CL4oIAnfSsut4o3">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" value="" required="" autocomplete="email" autofocus="">

                                                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password" required="" autocomplete="current-password">

                                                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="usertype" class="col-md-4 col-form-label text-md-right">User Type:</label>

                            <div class="col-md-6">
                              <select name="usertype" id="usertype" class="custom-select" required>
                                <option value="">Select user type</option>
                                <option value="mentor">Mentor</option>
                                <option value="mentee">Mentee</option>
                              </select>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" name="loginnow" class="btn btn-primary">
                                    Login
                                </button>

                                                                    <a class="btn btn-link" href="./forgotpassword">
                                        Forgot Your Password?
                                    </a>
                                                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


   <!----------------------------------------->



   
  <?php

  include '../include/footer.php';

  ?>


</body>
</html>