<?php
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}

// HANDLEVOGN

require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM products WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'pages'=>$_POST["pages"], 'price'=>$productByCode[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="site-style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
</head>

<body>


<div id="top-bar">
	<a href="logout.php" id="logout">Logg ut</a>
	<div id="logo"></div>
	
	<h1 id="top-header">Bekreft ordre</h1>
	<a href="welcome.php" class="back">Tilbake</a>

	<h2 id="sec-header">Velg butikk</h2>
	<select id="butikk" name="butikk">
	<option>Møbelringen Alta</option>
	<option>Møbelringen Arendal</option>
	<option>Møbelringen Drammen</option>
	<option>Møbelringen Etne</option>
	<option>Møbelringen Hokksund</option>
	<option>Møbelringen Horten</option>
	</select>
	

<div id="shopping-cart">
<div class="txt-heading">Handlevogn <a id="btnEmpty" href="welcome.php?action=empty">Tøm handlevognen</a></div>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	
<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;"><strong>Produkt</strong></th>
<th style="text-align:left;"><strong>Produktkode</strong></th>
<th style="text-align:right;"><strong>Opplag</strong></th>
<th style="text-align:right;"><strong>Sideantall</strong></th>
<th style="text-align:right;"><strong>Pris</strong></th>
<th style="text-align:center;"><strong>Rediger</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["name"]; ?></strong></td>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["code"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["pages"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$item["price"]; ?></td>
				<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="welcome.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Fjern</a></td>
				</tr>
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
	<td colspan="1" align=center><form action="bestill.php"><input type="submit" id="bestill-but" value="Bestill"></form></td>
</tr>
</tbody>
</table>		
  <?php
}
?>
</div>


	
</div>

</body>
</html>