<?php

	session_start();
		
	if(!(isset($_SESSION['idis']))){
		header("location:register.php");
	}
?>