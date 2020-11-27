<?php
// $this->servername = "localhost";
// 		$this->username   = "id15511065_ojulari";
// 		$this->password   = "i6Rx!nZr|J<+5v[W";
// 		$this->dbname     = "id15511065_mentor";

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

	}

}
?>