<?php
class DBController {
	private $host = "ec2-46-137-174-67.eu-west-1.compute.amazonaws.com";
	private $user = "ybyncykjxyctqo";
	private $password = "02d96d972d10c154bf3524ee74dbefa3543ebec61049e3db4f7eae9114956db0";
	private $database = "d34eo2gvf0u1tf";
	private $conn;
	
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}

	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>