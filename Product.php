
<?php require_once("includes/connection.php"); ?>

<?php

$ProductID = "";
$ProductName = "";
$QuantityLeft= "";
$Price = "";
$ProviderID ="";

$query1=mysqli_query($con, "select * from `Product`");


print("<p id='p1'><b> Avaliable Flowers </b>
<table>
<tr> 
<th><b>ID</b></td>
<th><b>NAME</b></td>
<th><b>QUANTITY LEFT</b></td>
<th><b>PRICE</b></td>
<th><b>PROVIDER ID</b></td>
</tr>");

while ($a = mysqli_fetch_array($query1)) {
    $id = $a['ProductID'];
    $prdct = $a['ProductName'];
    $qntt = $a['QuantityLeft'];
    $prc = $a['Price'];
    $prvd = $a['ProviderID'];

    echo "<tr>
<td>$id</td>
<td>$prdct</td>
<td>$qntt</td>
<td>$prc</td>
<td>$prvd</td>
</tr>";
}
print("</table>");

// Search

if(isset($_POST['search']))
{
    $ProductID =mysqli_real_escape_string($con, $_POST['ProductID']);

    $search_Query = "SELECT * FROM `Product` WHERE `ProductID` = $ProductID";
    $search_Result = mysqli_query($con, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                
                $ProductID = $row['ProductID'];
                $ProductName= $row['ProductName'];
                $QuantityLeft = $row['QuantityLeft'];
                $Price = $row['Price'];
                $ProviderID=$row['ProviderID'];
            }
        }else{
            echo 'No Data For This Id';
        }
    }else{
        echo 'Result Error';
    }
}


// Insert
if ('admin' == $_COOKIE['usernamecookie']) {
if(isset($_POST['insert']))
{
    if(!empty($_POST['ProductID']) 
        && !empty($_POST['ProductName']) 
        && !empty($_POST['QuantityLeft']) 
        && !empty($_POST['Price']) 
        && !empty($_POST['ProviderID']) ) {
    $ProductID =mysqli_real_escape_string($con, $_POST['ProductID']);
    $ProductName =mysqli_real_escape_string($con, $_POST['ProductName']);
    $QuantityLeft =mysqli_real_escape_string($con, $_POST['QuantityLeft']);
    $Price =mysqli_real_escape_string($con, $_POST['Price']);
    $ProviderID=mysqli_real_escape_string($con, $_POST['ProviderID']);
    $query=mysqli_query($con, "SELECT * FROM `Product` WHERE `ProductID` = $ProductID");
    $numrows=mysqli_num_rows($query);
        
     if($numrows==0){


    $insert_Query = "INSERT INTO `Product`(`ProductID`,`ProductName`, `QuantityLeft`, `Price`, `ProviderID`) VALUES ($ProductID,'$ProductName',$QuantityLeft,$Price, $ProviderID)";
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
    $ProductID =mysqli_real_escape_string($con, $_POST['ProductID']);
    $delete_Query = "DELETE FROM `Product` WHERE `ProductID` = $ProductID";
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
        if(!empty($_POST['ProductID']) 
        && !empty($_POST['ProductName']) 
        && !empty($_POST['QuantityLeft']) 
        && !empty($_POST['Price'])
        && !empty($_POST['ProviderID']) ) {

    $ProductID =mysqli_real_escape_string($con, $_POST['ProductID']);
    $ProductName =mysqli_real_escape_string($con, $_POST['ProductName']);
    $QuantityLeft =mysqli_real_escape_string($con, $_POST['QuantityLeft']);
    $Price =mysqli_real_escape_string($con, $_POST['Price']);
    $ProviderID=mysqli_real_escape_string($con, $_POST['ProviderID']);
    $update_Query = "UPDATE `Product` SET `ProductName`='$ProductName',`QuantityLeft`=$QuantityLeft,`Price`=$Price, `ProviderID`=$ProviderID WHERE `ProductID` = $ProductID";
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
}



?>
<!DOCTYPE Html>
<html>
    <head>
    <title>Products</title>
    <?php include("includes/header.php"); ?>
    </head>
    <body>
        <form action="Product.php" method="post">
            
            <input title = "Enter number here" type="number" name="ProductID" placeholder="Id" value="<?php echo $ProductID;?>"><br><br>
            <input title = "Enter name" type="text" name="ProductName" placeholder="Product Name" value="<?php echo $ProductName;?>"><br><br>
            <input title = "Enter quantity, that left in storage" type="number" name="QuantityLeft" placeholder="Quantity Left" value="<?php echo $QuantityLeft;?>"><br><br>
            <input title = "Enter price" type="number" name="Price" placeholder="Price" value="<?php echo $Price;?>"><br><br>
            <input title = "Enter ID of provider" type="number" name="ProviderID" placeholder="Provider ID" value="<?php echo $ProviderID;?>"><br><br>
            <div>
                <?php
                if ('admin' == $_COOKIE['usernamecookie']) {
                echo " <input id='DV1' type='submit' name='insert' value='Add'> ";
                echo "<input id='DV1' type='submit' name='update' value='Update'> ";
                echo "<input id='DV1' type='submit' name='delete' value='Delete'> ";
            }?>
            <input id='DV1' type='submit' name='search' value='Find'>
            </div>
        Choose table to work with:<br>
        <a href="Customer.php"><input id="DV1" type="button" value="Customer"/></a>
        <a href="Employee.php"><input id="DV1" type="button" value="Employee"/></a>
        <a href="Provider.php"><input id="DV1" type="button" value="Provider"/></a>
        <a href="OrderDetail.php"><input id="DV1" type="button" value="Order Details"/></a>
        <p id="p2"><a href="logout.php">Logout</a> from system</p>
        </form>
    </body>
</html>
