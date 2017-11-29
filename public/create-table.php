<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$servername = "ec2-46-137-174-67.eu-west-1.compute.amazonaws.com";
$username = "ybyncykjxyctqo";
$password = "02d96d972d10c154bf3524ee74dbefa3543ebec61049e3db4f7eae9114956db0";
$dbname = "d34eo2gvf0u1tf";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE tasks (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
taskname VARCHAR(255) NOT NULL,
task VARCHAR(255) NOT NULL,
dato VARCHAR(255) NOT NULL,
klokke VARCHAR(255) NOT NULL,

created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";
	
$sql = "CREATE TABLE accounts (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,

created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Tasks created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>


</body>
</html>