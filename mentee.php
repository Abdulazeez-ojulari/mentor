<?php 
include("session_home.php");
include("include/init.php");

$mentors = new Mentors;

$mentee_id = $_SESSION['idis'];

if (isset($_POST['mentors_id']) && $_POST['mentors_id']!=""){
$mentors_id = $_POST['mentors_id'];

$result = $mentors->getMentorsbById($mentors_id);
    $row = mysqli_fetch_array($result);
    $mentors_name = $row['mentors_name'];
    $mentors_email = $row['mentors_email'];
    $mentors_dob = $row['mentors_dob'];
    


    
	$results = $mentors->insert_mentor($mentee_id,$mentors_id,$mentors_name,$mentors_email,$mentors_dob);

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
                    <a class="user-nav__user-name link"><h1>Logout</h1></a>
                </div>
            </nav>
        </header>
        <div class="body_container">
            <h3 class="secheader">Mentors</h3>
            <div class="shoppingTable">
                    <div class="itemHeader">
                        <p class="item">Mentor Name</p>
                        <p class="quantity">Mentor Email</p>
                        <p class="unitPrice"></p>
                    </div>
                    <div class="itemData">
                        <?php


                        $mentors = new Mentors;

                       /*
                           * Email validation
                       */
                       $row = $mentors->getMentors();
                       if($row){
                          if($mentors->CountRows() > 0 ){
                           


                          while($results = $mentors->FetchAll($row)) {
                            echo "<div class='cartItem'}>
                                <div class='cartItemDetails'>
                                    
                                    <h3 class='cartItemName'>{$results["mentors_name"]}</h3>
                                </div>
                                <div class='cartItemPrice'><p>{$results["mentors_email"]}</p></div>
                                <div class='cartItemTotal'>
                                    <p>
                                        <form method='post' action=''>
                                          <input type='hidden' name='mentors_id' value={$results['mentors_id']}/>
                                          
                                          <button type='submit' class='btn btn-outline btn-bg'>Add</button>
                                        </form>
                                    </p>
                                </div>
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