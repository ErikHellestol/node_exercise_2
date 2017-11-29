<?php
/* Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}*/
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Skriv et brukernavn";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM accounts WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Dette brukernavnet er allerede i bruk.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Noe gikk galt. Prøv igjen senere.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Skriv inn et passord.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Passordet må innerholde minst 6 tegn.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Bekreft passordet.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Passordene matcher ikke.';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO accounts (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: kontoer.php");
            } else{
                echo "Oops! Noe gikk galt. Prøv igjen!";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="site-style.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
</head>
<body>
	<a href="welcome.php" id="back-link">Tilbake</a>
	<a href ="logout.php" id="logout">Logg ut</a>
    <div id="signup">
        <h2 id="top-header-konto" class="h2-header">Lag ny konto</h2>
        <p id="sec-header-konto">Fyll inn informasjon for å sette opp en ny konto til adminsider.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Brukernavn:</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Passord:</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Bekreft passord:</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="buttons" value="Lag konto">
                <input type="reset" class="buttons" value="Tilbakestill">
            </div>
        </form>
     
	<div id="edit-accs-box">
	<h2 class="h2-header">Rediger kontoer</h2>
	<p id="list"><?php
$servername = "46.250.210.148";
$username = "polinlvk_admin";
$password = "a98s98A98S98";
$dbname = "polinlvk_mobelringen";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, username FROM accounts";
$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> ID: ". $row["id"]. " - Brukernavn: ". $row["username"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?> </p>
	</div>
	

	<div id="delete-account">
	<p id="delete-head">Skriv hvilken ID som skal slettes</p>
	<form action="delete.php" method="post">
		<input type="number" id="delete-input" name="delete">
		<input type="submit" class="buttons" value="Slett">
	</form>
	</div>	
</div> 
</body>
</html>
</body>
</html>