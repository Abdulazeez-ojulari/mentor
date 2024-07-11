<?php
session_start();
include("include/init.php");

$errormsg = "";
$infomesg = ""
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
                   $errormsg .= "Wrong Email or Password<br>";
              }

              if($errormsg == ""){

                  $infomesg .= "Logined";
                  $_SESSION['idis'] = $idis;
                  header("location:mentor.php");
                  
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
                   $errormsg .= "Wrong Email or Password<br>";
              }

              if($errormsg == ""){

                  $infomesg .= "Logined";
                  $_SESSION['idis'] = $idis;
                  header("location:mentee.php");
                  
           }

          }
         

         /*
              * Submit the form
         */ 

         
      }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Career Couching</title>
  
  <?php
  
  include 'include/top.php';
  
  ?>  
  

  <?php

  include 'include/header.php';

  ?>

  
  
   <!-------------------PAGE Content---------------------->
    <div class="container">
        <header class="navbar">
            <a href="index.php">
                <img src="images/iconic_10.png" class="main__logo" alt="Mentor" />
            </a>


            <nav class="user-nav">
                
                <div class="user-nav__user">
                    <a href="register.php" class="user-nav__user-name link"><h1>Register</h1></a>
                </div>
            </nav>
        </header>
        <div class="body_container">
            <?php if($infomesg != ""){ ?>
            <div class="alert alert-success">               
              <?php echo $infomesg; ?>        
            </div>
            <?php } ?>

            <?php if($errormsg != ""){ ?>
            <div class="alert alert-danger">               
              <?php echo $errormsg; ?>        
            </div>
            <?php } ?>
            <div class="orderForm">
                <form method="POST" action="">
                    <div class="orderSection">
                        <h3 class="secheader">Login</h3>
                        <div class="formrow">
                            <div class="formcol-2">
                                <div class="formgroup"> 
                                    <label for="email" class="formlabel">E-Mail Address</label>
                                    <input class="forminput" id="email" placeholder="E-Mail Address" type="email" name="email" value="" required="" autocomplete="email" autofocus="">

                                  
                                    
                                </div>
                                
                                <div class="formgroup">
                                    <label for="password" class="formlabel">Password</label>
                                    <input id="password" type="password" class="forminput" placeholder="Password" name="password" required="" autocomplete="current-password">

                        
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="formrow">
                            <div class="formcol-2">
                                <div class="formgroup">
                                    <label for="usertype" class="formlabel">User Type:</label>

                                    <select name="usertype" id="usertype" class="form-control" required>
                                      <option value="">Select user type</option>
                                      <option value="mentor">Mentor</option>
                                      <option value="mentee">Mentee</option>
                                    </select>
                          
                        
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <button class="btn btn-outline btn-bg" type="submit" name="loginnow" >Log In</button>
                </form>
            </div>
        
    </div>
 <?php

  include 'include/footer.php';

  ?>

</body>
</html>