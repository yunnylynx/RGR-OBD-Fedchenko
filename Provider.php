
<?php require_once("includes/connection.php"); ?>
<?php

$ProviderID = "";
$NameProv = "";
$HowMany= "";


$query1 = mysqli_query($con, "select * from `Provider`");
print("<p id='p1'><b> Providers </b>
<table>
<tr> 
<th><b>ID</b></th>
<th><b>NAME</b></th>
<th><b>HOW MANY ARRIVED</b></th>

</tr>");

while ($a = mysqli_fetch_array($query1)) {
    $id = $a['ProviderID'];
    $namP = $a['NameProv'];
    $HoMan = $a['HowMany'];


    echo "<tr>";
    echo "<td>" . $id . "</td>
    <td>" . $namP . "</td>";
    if ('admin' == $_COOKIE['usernamecookie']) {
    echo "<td>" . $HoMan . "</td>";
    } else {
        echo "<td></td>";
    }
    "</tr>";
}
echo "</table>";

// Search

if(isset($_POST['search']))
{
    if(!empty($_POST["ProviderID"])){
    $ProviderID =mysqli_real_escape_string($con, $_POST['ProviderID']);
    
    $search_Query = "SELECT * FROM `Provider` WHERE `ProviderID` = $ProviderID";
    
    $search_Result = mysqli_query($con, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                
                $ProviderID = $row['ProviderID'];
                $NameProv= $row['NameProv'];
                if ('admin' == $_COOKIE['usernamecookie']) {
                $HowMany = $row['HowMany'];}

            }
        }else{
            echo 'No Data For This Id';
        }
    }else{
        echo 'Result Error';
    }
    } else{
        echo 'Enter ID';
    }
}


// Insert
if ('admin' == $_COOKIE['usernamecookie']) {
if(isset($_POST['insert']))
{
    $ProviderID =mysqli_real_escape_string($con, $_POST['ProviderID']);
    $NameProv =mysqli_real_escape_string($con, $_POST['NameProv']);
    $HowMany =mysqli_real_escape_string($con, $_POST['HowMany']);

    $insert_Query = "INSERT INTO `Provider`(`ProviderID`,`NameProv`, `HowMany`) VALUES ($ProviderID,'$NameProv', $HowMany)";
    try{
        $insert_Result = mysqli_query($con, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
                echo 'Data Inserted';
            }else{
                echo 'Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
}

// Delete
if(isset($_POST['delete']))
{
    if(!empty($_POST["ProviderID"])){
    $ProviderID =mysqli_real_escape_string($con, $_POST['ProviderID']);
    $delete_Query = "DELETE FROM `Provider` WHERE `ProviderID` = $ProviderID";
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
    } else{
        echo 'Enter ID';
    }
}
// Edit
if(isset($_POST['update']))
{
    if(!empty($_POST["EmployeeID"]) 
        && !empty( $_POST['ProviderID']) 
        && !empty($_POST['NameProv']) 
        && !empty($_POST['HowMany']) ){
    $ProviderID =mysqli_real_escape_string($con, $_POST['ProviderID']);
    $NameProv =mysqli_real_escape_string($con, $_POST['NameProv']);
    $HowMany =mysqli_real_escape_string($con, $_POST['HowMany']);
    $update_Query = "UPDATE `Provider` SET `NameProv`='$NameProv',`HowMany`=$HowMany WHERE `ProviderID` = $ProviderID";
  
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
        <title>Provider</title>
<?php include("includes/header.php"); ?>
    </head>
    <body>
        <form action="Provider.php" method="post">
            <input title = "Enter number" type="number" name="ProviderID" placeholder="Id" value="<?php echo $ProviderID;?>"><br><br>
            <input title = "Enter name of provider" type="text" name="NameProv" placeholder="Provider Name" value="<?php echo $NameProv;?>"><br><br>
            <input title = "Enter how many product arrived" type="text" name="HowMany" placeholder="How many products" value="<?php echo $HowMany;?>"><br><br>

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
        <a href="Product.php"><input id="DV1" type="button" value="Product"/></a>
        <a href="OrderDetail.php"><input id="DV1" type="button" value="Order Details"/></a>

        <p id="p2"><a href="logout.php">Logout</a> from system</p>
        </form>
    </body>
</html>
