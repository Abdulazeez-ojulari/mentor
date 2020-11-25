<?php 

// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "hospital";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $database);


// function query($query){

// 	global $conn;

// 	return mysqli_query($conn, $query);
// }



// function escape($string){

// 	global $conn;

// 	return mysqli_real_escape_string($conn, $string);
// }


// function fetch_data($result){

// 	global $conn;

// 	return mysqli_fetch_array($result);
// }


// function confirm($result){

// 	global $conn;

// 	if (!$result) {
		
// 		die("Query Failed" . mysqli_error($conn));
// 	}
// }

// function row_count($result){

// 	return mysqli_num_rows($result);
// }










?>


<?php



class Database{

	private $servername;
	private $username;
	private $password;
	private $dbname;
	protected $db;


	protected function connect(){


		$this->servername = "localhost";
		$this->username   = "root";
		$this->password   = "";
		$this->dbname     = "mentor";

		/*******MYsqli way*********/

		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

		if(!$conn){
			die('could not connect');
		}

		return $conn;


		/***********PDO**************/

		
		// try {

		// 	$dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";port:3308";
		//     $conn = new PDO($dsn, $this->username, $this->password);
		//     // set the PDO error mode to exception
		//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//     return $conn;
		//     }
		// catch(PDOException $e)
		//     {
		//     echo "Connection failed: " . $e->getMessage();
		//     }




	}



}








?>