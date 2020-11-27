<?php
session_start();
    include("include/init.php");

    $name               = "";
    $email              = "";
    $password           = "";
    $confirm_password   = "";
    $dob                = "";
    $usertype			= "";

    $errormsg = "";
    $infomesg = "";

if(isset($_POST['signup'])){


        $name               =   cleaninput($_POST['name']);
        $email              =   cleaninput($_POST['email']);
        $password           =   cleaninput($_POST['password']);
        $confirm_password   =   cleaninput($_POST['password_confirmation']);
        $dob                =   cleaninput($_POST['dob']);
        $usertype           =   cleaninput($_POST['usertype']);

        if($usertype == 'mentor'){
        	$mentors = new Mentors;

		   /*
		       * Email validation
		   */

		   if($mentors->Query($email)){
		      if($mentors->CountRows() > 0 ){
		        $errormsg .= "Sorry email is already exist<br>";
		      }
		    }


		   /*
		        * Password validations
		   */


		   if(strlen($password) < 5){
		      $errormsg .= "Password is too short<br>";
		   }

		   /*
		       * Confirm password validations
		   */ 

		   if($password != $confirm_password){
		    $errormsg .= "Confirm password is not matched<br>";
		   }

		   /*
		        * Submit the form
		   */ 

		   if($errormsg == ""){

		            $mentors->setvalues($name, $email, $password, $dob);
		            
		            $isinsert = $mentors->insert();

		            if($isinsert){
		            	if($mentors->Query($email)){

					          if($mentors->CountRows() > 0){

					              $row = $mentors->Single();
					              $password_real   = $row[3];
					              $idis   = $row[0];

					          }

				              if($errormsg == ""){

				                  $infomesg .= "Logined";
				                  $_SESSION['idis'] = $idis;
				                  header("location:mentor.php");
					                  
					           }

					        }
		            }else{
		            	$errormsg .= "Somthing Went Wrong. Please Try Again<br>";
		            }
		            
		     }


        }else{

        	$mentees = new Mentees;

		   /*
		       * Email validation
		   */

		   if($mentees->Query($email)){
		      if($mentees->CountRows() > 0 ){
		        $errormsg .= "Sorry email is already exist<br>";
		      }
		    }


		   /*
		        * Password validations
		   */


		   if(strlen($password) < 5){
		      $errormsg .= "Password is too short<br>";
		   }

		   /*
		       * Confirm password validations
		   */ 

		   if($password != $confirm_password){
		    $errormsg .= "Confirm password is not matched<br>";
		   }

		   /*
		        * Submit the form
		   */ 

		   if($errormsg == ""){

		            $mentees->setvalues($name, $email, $password, $dob);
		            
		            $isinsert = $mentees->insert();

		            
		            if($isinsert){
		            	if($mentees->Query($email)){

				          if($mentees->CountRows() > 0){

				              $row = $mentees->Single();
				              $password_real   = $row[3];
				              $idis   = $row[0];

				          }
				              if($errormsg == ""){

				                  $infomesg .= "Logined";
				                  $_SESSION['idis'] = $idis;
				                  header("location:mentee.php");
				                  
				           }

				          }
		            }else{
		            	$errormsg .= "Somthing Went Wrong. Please Try Again<br>";
		            }
		            
		     }
        }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Account  |  Career Couching</title>
<?php
  
  include 'include/top.php';
?>  
  
</head>
<body>
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
	                    <a href="login.php" class="user-nav__user-name link"><h1>Login</h1></a>
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
                            <h3 class="secheader">Register</h3>
                            <div class="formrow">
                                <div class="formcol-2">
                                    <div class="formgroup">
                                    	<label class="formlabel" for="name">Name</label>
                                        <input class="forminput" placeholder="Name" id="name" type="text" name="name" value="<?php echo $name; ?>" required="" autocomplete="name" autofocus="">    
                                        
                                    </div>
                                    
                                    <div class="formgroup">
                                    	<label for="email" class="formlabel">E-Mail Address</label>
                                        <input class="forminput" placeholder="E-Mail Address" id="email" type="email" name="email" value="<?php echo $email; ?>" required autocomplete="email">
                            
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="formrow">
                                <div class="formcol-2">
                                    <div class="formgroup">
                                    	<label class="formlabel" for="password">Password</label>
                                        <input class="forminput" placeholder="Password" id="password" type="password" value="<?php echo $password; ?>" name="password" required="" autocomplete="new-password">
                              
                            
                                    </div>
                                    
                                    <div class="formgroup">
                                    	<label class="formlabel" for="password-confirm">Confirm Password</label>
                                        <input class="forminput" placeholder="Confirm Password" id="password-confirm" type="password" value="<?php echo $confirm_password; ?>" name="password_confirmation" required="" autocomplete="new-password">
                              
                            
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="formrow">
                                <div class="formcol-2">
                                    <div class="formgroup">
                                    	<label class="formlabel" for="dob">Date of Birth</label>
                                    	<input class="forminput" placeholder="Date of Birth" id="dob" type="Date" name="dob" value="<?php echo $dob; ?>" required="">
                                
                            
                                        
                                    </div>
                                    
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
                        <button class="btn btn-outline btn-bg" type="submit" name="signup" >Join</button>
                    </form>
                </div>
            
        </div>


	 	
	 </div>

	 <?php

  include 'include/footer.php';

  ?>



</body>
</html>