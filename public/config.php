<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'ec2-46-137-174-67.eu-west-1.compute.amazonaws.com');
define('DB_USERNAME', 'ybyncykjxyctqo');
define('DB_PASSWORD', '02d96d972d10c154bf3524ee74dbefa3543ebec61049e3db4f7eae9114956db0');
define('DB_NAME', 'd34eo2gvf0u1tf');
 


/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>