<?php require_once("includes/connection.php"); ?>
<?php

$CustomerID='';
$Name='';
$Email='';

print ("<p id='p1'><b> Customers </b>
<table>
<tr> 
<th><b>ID</b></th>
<th><b>NAME</b></th>
<th><b>EMAIL</b></th>
</tr>");

$query1 = mysqli_query($con, "SELECT * from `Customer`");
while ($a = mysqli_fetch_array($query1)) {
    $id = $a['CustomerID'];
    $nm = $a['Name'];
    $mail = $a['Email'];

    echo "<tr>
    <td>" . $id . "</td>
    <td>" . $nm . "</td>";
    if ('admin' == $_COOKIE['usernamecookie']) {
        echo "<td>" . $mail . "</td>";
    } else{
        echo "<td></td>";
    }
    echo "</tr>";
}
print("</table>");

// Search
if(isset($_POST['search']))
{
    $CustomerID = mysqli_real_escape_string($con, $_POST["CustomerID"]);
    $search_Query = "SELECT * FROM `Customer` WHERE `CustomerID` = $CustomerID";
    $search_Result = mysqli_query($con, $search_Query);
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $CustomerID = $row['CustomerID'];
                $Name= $row['Name'];
                if ('admin' == $_COOKIE['usernamecookie']) {
                $Email = $row['Email'];}
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
if(isset($_POST['insert'])){
 if(!empty($_POST["CustomerID"]) 
        && !empty($_POST["Name"]) 
        && !empty($_POST["Email"])) {
    $CustomerID = mysqli_real_escape_string($con, $_POST["CustomerID"]);
    $Name = mysqli_real_escape_string($con, $_POST["Name"]);
    $Email= mysqli_real_escape_string($con, $_POST["Email"]);
    $query=mysqli_query($con, "SELECT * FROM `Customer` WHERE `CustomerID` = $CustomerID");
    $numrows=mysqli_num_rows($query);
    if($numrows==0){
    $insert_Query = "INSERT INTO `Customer`(`CustomerID`,`Name`, `Email`) VALUES ($CustomerID,'$Name','$Email')";

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
    $CustomerID = mysqli_real_escape_string($con, $_POST["CustomerID"]);
    $delete_Query = "DELETE FROM `Customer` WHERE `CustomerID` = $CustomerID";
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
{       if(!empty($_POST["CustomerID"]) 
        && !empty($_POST["Name"]) 
        && !empty($_POST["Email"])) {
    $CustomerID = mysqli_real_escape_string($con, $_POST["CustomerID"]);
    $Name = mysqli_real_escape_string($con, $_POST["Name"]);
    $Email= mysqli_real_escape_string($con, $_POST["Email"]);
    $update_Query = "UPDATE `Customer` SET `Name`='$Name',`Email`=' $Email' WHERE `CustomerID` = $CustomerID";
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
        <title>Customer</title>
            <?php include("includes/header.php"); ?>
    </head>
    <body>
        <form action="Customer.php" method="post">
            <input title = "Enter number here" type="number" name="CustomerID" placeholder="Id" value="<?php echo $CustomerID;?>"><br><br>
            <input title = "Enter name" type="text" name="Name" placeholder="Name" value="<?php echo $Name;?>"><br><br>
            <input title = "Enter email" type="email" name="Email" placeholder="Email" value="<?php echo $Email;?>"><br><br>

            <div>
                <?php
                if ('admin' == $_COOKIE['usernamecookie']) {
               echo " <input id='DV1' type='submit' name='insert' value='Add'> ";
               echo "<input id='DV1' type='submit' name='update' value='Update'> ";
               echo "<input id='DV1' type='submit' name='delete' value='Delete'> ";
               echo " <input id='DV1' type='submit' name='search' value='Find'> ";
            }?>
            </div>
            <br>Choose another table to work with:<br>

        <a href="Employee.php"><input id="DV1" type="button" value="Employee"/></a>
        <a href="Product.php"><input id="DV1" type="button" value="Product"/></a>
        <a href="Provider.php"><input id="DV1" type="button" value="Provider"/></a>
        <a href="OrderDetail.php"><input id="DV1" type="button" value="Order Details"/></a>
        <p id="p2"><a href="logout.php">Logout</a> from system</p>
        </form>
    </body>
</html>
