<?php 
if('admin' != $_COOKIE['usernamecookie']){
    header("Location: intropage.php");
}
?>
<?php require_once("includes/connection.php"); ?>
<?php

$OrderID = "";
$Date = "";
$Cost= "";
$Amount ="";
$CustomerID="";
$ProductID= "";
$EmployeeID= "";

$query1=mysqli_query($con, "select * from `OrderDetail`");

print("<p id='p1'><b> ORDERS </b>
<table>
<tr> 
<th><b>ID</b></th>
<th><b>DATE</b></th>
<th><b>COST</b></thd>
<th><b>AMMOUNT</b></th>
<th><b>CUSTOMER ID</b></th>
<th><b>PRODUCT ID</b></th>
<th><b>EMPLOYEE ID</b></th>
</tr>");

while ($a = mysqli_fetch_array($query1)) {
    $id = $a['OrderID'];
    $dt = $a['Date'];
    $cst = $a['Cost'];
    $amm = $a['Amount'];
    $cID = $a['CustomerID'];
    $pID = $a['ProductID'];
    $eID = $a['EmployeeID'];


    echo "<tr>";
    if ('admin' == $_COOKIE['userlevelcookie']) {
echo "<td>" . $id ."</td>
<td>" . $dt . "</td>
<td>" . $cst . "</td>
<td>" . $amm . "</td>
<td>" . $cID . "</td>
<td>" . $pID . "</td>
<td>" . $eID . "</td>";}
"</tr>";
}
print("</table>");

// Search

if(isset($_POST['search']))
{
    $OrderID = mysqli_real_escape_string($con, $_POST['OrderID']);
    
    $search_Query = "SELECT * FROM `OrderDetail` WHERE `OrderID` = $OrderID";
    
    $search_Result = mysqli_query($con, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                
                $OrderID = $row['OrderID'];
                $Date= $row['Date'];
                $Cost = $row['Cost'];
                $Amount=$row['Amount'];
                $CustomerID=$row['CustomerID'];
                $ProductID=$row['ProductID'];
                $EmployeeID=$row['EmployeeID'];

            }
        }else{
            echo 'No Data For This Id';
        }
    }else{
        echo 'Result Error';
    }
}


// Insert
if(isset($_POST['insert']))
{
    if(!empty($_POST['OrderID']) 
        && !empty($_POST['Date']) 
        && !empty($_POST['Cost']) 
        && !empty($_POST['Amount']) 
        && !empty($_POST['CustomerID']) 
        && !empty($_POST['ProductID'])
        && !empty($_POST['EmployeeID']) ) {
    $OrderID = mysqli_real_escape_string($con, $_POST['OrderID']);
    $Date = mysqli_real_escape_string($con, $_POST['Date']);
    $Cost = mysqli_real_escape_string($con, $_POST['Cost']);
    $Amount = mysqli_real_escape_string($con, $_POST['Amount']);
    $CustomerID = mysqli_real_escape_string($con, $_POST['CustomerID']);
    $ProductID = mysqli_real_escape_string($con, $_POST['ProductID']);
    $EmployeeID = mysqli_real_escape_string($con, $_POST['EmployeeID']);
    $query=mysqli_query($con, "SELECT * FROM `OrderDetail` WHERE `OrderID` = $OrderID");
    $numrows=mysqli_num_rows($query);
        
    if($numrows==0){
    $insert_Query = "INSERT INTO `OrderDetail`
    (
        `OrderID`, 
        `Date`,
        `Cost`,
        `Amount`, 
        `CustomerID`, 
        `ProductID`,
        `EmployeeID`
    ) 
    VALUES 
    (
        $OrderID,
        CONVERT('$Date', DATETIME),
        $Cost,
        $Amount,
        $CustomerID,
        $ProductID,
        $EmployeeID
        
    )";

        $insert_Result = mysqli_query($con, $insert_Query);
        if($insert_Result)
        {
         echo 'Data Inserted';
        }else{
                echo 'Data Not Inserted';
        }
        } else {
             echo "Duplicate!";
     }   
     }else {
             echo "All fields are required!";
     }   
           
}

// Delete
if(isset($_POST['delete']))
{
    $OrderID = mysqli_real_escape_string($con, $_POST['OrderID']);
    $delete_Query = "DELETE FROM `OrderDetail` WHERE `OrderID` = $OrderID";
    try{
        $delete_Result = mysqli_query($con, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
                echo 'Data Deleted';
            }else{
                echo 'Data Not Deleted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
    if(!empty($_POST['OrderID']) 
        && !empty($_POST['Date']) 
        && !empty($_POST['Cost']) 
        && !empty($_POST['Amount']) 
        && !empty($_POST['CustomerID']) 
        && !empty($_POST['ProductID'])
        && !empty($_POST['EmployeeID']) ) {

    $OrderID = mysqli_real_escape_string($con, $_POST['OrderID']);
    $Date = mysqli_real_escape_string($con, $_POST['Date']);
    $Cost = mysqli_real_escape_string($con, $_POST['Cost']);
    $Amount = mysqli_real_escape_string($con, $_POST['Amount']);
    $CustomerID = mysqli_real_escape_string($con, $_POST['CustomerID']);
    $ProductID = mysqli_real_escape_string($con, $_POST['ProductID']);
    $EmployeeID = mysqli_real_escape_string($con, $_POST['EmployeeID']);


    $update_Query = "UPDATE `OrderDetail` SET
     `Date`=CONVERT('$Date', DATETIME),
     `Cost`= $Cost,
     `Amount`=$Amount,
     `CustomerID`=$CustomerID, 
     `ProductID`=$ProductID, 
     `EmployeeID`=$EmployeeID
     WHERE 
     `OrderID` = $OrderID";

        $update_Result = mysqli_query($con, $update_Query);
        
       if($update_Result)
            {
                echo 'Data updated';
            }else{
                echo 'Data not updated';
            }  
     }else {
             echo "All fields are required!";
     }   

}




?>
<!DOCTYPE Html>
<html>
    <head>
        <title>Order Details</title>
        <?php include("includes/header.php"); ?>
    </head>
    <body>
        <form action="OrderDetail.php" method="post">
            <input title = "Enter number here" type="number" name="OrderID" placeholder="Id" value="<?php echo $OrderID;?>"><br><br>
            <input title = "Enter date and time" type="text" name="Date" placeholder="Date-time" value="<?php echo $Date;?>"><br><br>
            <input title = "Enter cost" type="number" name="Cost" placeholder="Cost" value="<?php echo $Cost;?>"><br><br>
            <input title = "Enter amount" type="number" name="Amount" placeholder="Amount" value="<?php echo $Amount;?>"><br><br>
            <input title = "Enter customer ID" type="number" name="CustomerID" placeholder="CustomerID" value="<?php echo $CustomerID;?>"><br><br>
            <input title = "Enter product ID" type="number" name="ProductID" placeholder="ProductID" value="<?php echo $ProductID;?>"><br><br>
             <input title = "Enter employee ID" type="number" name="EmployeeID" placeholder="EmployeeID" value="<?php echo $EmployeeID;?>"><br><br>

            <div>
                <!-- Input For Add Values To Database-->
                <input id="DV1" type="submit" name="insert" value="Add">
                
                <!-- Input For Edit Values -->
                <input id="DV1" type="submit" name="update" value="Update">
                
                <!-- Input For Clear Values -->
                <input id="DV1" type="submit" name="delete" value="Delete">
                
                <!-- Input For Find Values With The given ID -->
                <input id="DV1" type="submit" name="search" value="Find">
            </div>
               <br>Choose another table to work with:<br>
        <a href="Customer.php"><input id="DV1" type="button" value="Customers"/></a>
        <a href="Employee.php"><input id="DV1" type="button" value="Employee"/></a>
        <a href="Product.php"><input id="DV1" type="button" value="Product"/></a>
        <a href="Provider.php"><input id="DV1" type="button" value="Provider"/></a>

        <p id="p2"><a href="logout.php">Logout</a> from system</p>
        </form>
    </body>
</html>
