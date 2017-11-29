<?php
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}

/** Sends a UTF-8 header **/
header ('content-type:text/html;charset=utf-8');



// Lagre

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":

$servername = "ec2-46-137-174-67.eu-west-1.compute.amazonaws.com";
$username = "ybyncykjxyctqo";
$password = "02d96d972d10c154bf3524ee74dbefa3543ebec61049e3db4f7eae9114956db0";
$dbname = "d34eo2gvf0u1tf";

}}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO tasks (taskname, task, dato, klokke)
VALUES ('$taskname', '$task', '$dato', '$klokke')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();



?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Create task</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
</head>

<body>


<div id="top-bar">
	<a href="logout.php" id="logout">Logg ut</a>
	


	
<div id="boks">
        <h1 id="velkommen">Opprett oppgave </h1>
        <input id="tasknavn" type="text" placeholder="TaskNavn" name="tasknavn" />
        <br>
        <br>
        <input id="beskrivelse" type="text" placeholder="Beskrivelse" name="beskriv"/>
        <br>
        <br>
        <input id ="dato" type="date" placeholder="dd/mm/åååå" name="dato"/>
        <input id ="klokkeslett" type ="datetime" placeholder="klokkeslett" name="klokke"/>
        <br>
        <br>
        <input type="submit" id="btn"> Create Task </button>
    </div>
    
<div id="task-box">
</div>
	


	
</div>


<script src="script.js"></script>
</body>
</html>