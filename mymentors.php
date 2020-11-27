<?php 
include("session_home.php");
include("include/init.php");

if(isset($_POST['logout'])){
  session_destroy();
  header("location:register.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Mentee</title>
		<?php
  
  include 'include/top.php';
  
  ?>  
  

  <?php

  include 'include/header.php';

  ?>
	<div class="container">
        <header class="navbar">
            <a href="index.php">
                <img src="images/iconic_10.png" class="main__logo" alt="Mentor" />
            </a>


            <nav class="user-nav">
                
                <div class="user-nav__user">
                    <a class="user-nav__user-name link" href="index.php"><h1>Home</h1></a>
                </div>
                <div class="user-nav__user">
                    <a class="user-nav__user-name link" href="mentee.php"><h1>Mentors</h1></a>
                </div>
                <div class="user-nav__user">
                    <a class="user-nav__user-name link" href="mymentors.php"><h1>My Mentors</h1></a>
                </div>
                <div class="user-nav__user">
                    <a class="user-nav__user-name link">
                      <form method='post' action=''>
                        <input type='hidden' name='logout' value="" />                           
                        <button type='submit' class="logout"><h1>Log Out</h1></button>
                      </form>
                    </a>
                </div>
            </nav>
        </header>
        <div class="body_container">
        	<h3 class="secheader">My Mentors</h3>
            <div class="shoppingTable">

                    <div class="itemHeader">
                        <p class="item">Mentor Name</p>
                        <p class="quantity">Mentor Email</p>
                    </div>
                    <div class="itemData">
                        <?php


                    $mentors = new Mentors;

                   /*
                       * Email validation
                   */
                   $id = $_SESSION['idis'];
                   $row = $mentors->getMenteesMentors($id);
                   if($row){
                      if($mentors->CountRows() > 0 ){
                       


                      while($results = $mentors->FetchAll($row)) {
                        echo "<div class='cartItem'}>
                                <div class='cartItemDetails'>
                                    
                                    <h3 class='cartItemName'>{$results["mentor_name"]}</h3>
                                </div>
                                <div class='cartItemPrice'><p>{$results["mentor_email"]}</p></div>
                                
                            </div>";
                      }       
                      }
                    }
                    ?>
                        
                    </div>
            </div>
        </div>
			
								
	</div>
	 <?php

  include 'include/footer.php';

  ?>
	</body>
</html>