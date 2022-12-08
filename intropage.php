
<?php

session_start();

if(!isset($_SESSION["session_username"])):
header("location:login.php");
else:
?>


<?php include("includes/header.php"); ?>






<div id="welcome">
<h2>Welcome, <span><?php echo $_SESSION['session_username'];?>! </span></h2>
  <p><a href="logout.php">Logout</a> from system</p>
Choose table to work with:<br>
        <a href="Customer.php"><input id="DV1" type="button" value="Customer"/></a>
        <a href="Employee.php"><input id="DV1" type="button" value="Employee"/></a>
        <a href="Product.php"><input id="DV1" type="button" value="Product"/></a>
        <a href="Provider.php"><input id="DV1" type="button" value="Provider"/></a>
        <a href="OrderDetail.php"><input id="DV1" type="button" value="Order Details"/></a>
</div>
	
<?php endif; ?>

