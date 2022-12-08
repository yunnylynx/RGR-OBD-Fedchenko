
<?php require_once("includes/connection.php"); ?>
<?php

$EmployeeID = "";
$NameEmp = "";
$Specification= "";
$DateOfBirth ="";
$Experience="";
$Salary="";



$query1=mysqli_query($con, "select * from `Employee`");

print ("<p id='p1'><b> Employees </b>
<table>
<tr> 
<th><b>ID</b></th>
<th><b>NAME</b></th>
<th><b>SPECIFICATION</b></th>
<th><b>DATE OF BIRTH</b></th>
<th><b>EXP</b></th>
<th><b>SALARY</b></th>
</tr>");

while ($a=mysqli_fetch_array($query1))
{ 

$id=$a['EmployeeID'];
$namE=$a['NameEmp'];
$spf=$a['Specification'];
$dob=$a['DateOfBirth'];
$exp=$a['Experience'];
$slr=$a['Salary'];

echo "<tr>
<td>" . $id . "</td>
<td>" . $namE . "</td>
<td>" . $spf . "</td>";
 if ('admin' == $_COOKIE['usernamecookie']) {
echo "<td>" . $dob . "</td>
<td>" . $exp . "</td>
<td>" . $slr . "</td>";}
else 
    {echo "<td></td>";
echo "<td></td>";
echo "<td></td>";}
echo "</tr>";
}
print ("</table>");

// Search

if(isset($_POST['search']))
{

    $EmployeeID = mysqli_real_escape_string($con, $_POST["EmployeeID"]);
    $search_Query = "SELECT * FROM `Employee` WHERE `EmployeeID` = $EmployeeID";
    
    $search_Result = mysqli_query($con, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                if ('admin' == $_COOKIE['usernamecookie']) {
                $EmployeeID = $row['EmployeeID'];}
                $NameEmp= $row['NameEmp'];
                $Specification = $row['Specification'];
                if ('admin' == $_COOKIE['usernamecookie']) {
                $DateOfBirth=$row['DateOfBirth'];
                $Experience=$row['Experience'];
                $Salary=$row['Salary'];}

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
    if(!empty($_POST["EmployeeID"]) 
        && !empty($_POST["NameEmp"]) 
        && !empty($_POST["Specification"]) 
        && !empty($_POST["DateOfBirth"]) 
        && !empty($_POST["Experience"]) 
        && !empty($_POST["Salary"]) ) {

    $EmployeeID = mysqli_real_escape_string($con, $_POST["EmployeeID"]);
    $NameEmp = mysqli_real_escape_string($con, $_POST["NameEmp"]);
    $Specification= mysqli_real_escape_string($con, $_POST["Specification"]);
    $DateOfBirth =mysqli_real_escape_string($con, $_POST["DateOfBirth"]);
    $Experience=mysqli_real_escape_string($con, $_POST["Experience"]);
    $Salary=mysqli_real_escape_string($con, $_POST["Salary"]);
    $query=mysqli_query($con, "SELECT * FROM `Employee` WHERE `EmployeeID` = $EmployeeID");
    $numrows=mysqli_num_rows($query);
        
     if($numrows==0){
        $insert_Query = "INSERT INTO `Employee` (
        `EmployeeID`, 
        `NameEmp`,
        `Specification`,
        `DateOfBirth`, 
        `Experience`, 
        `Salary`
    ) 
    VALUES 
    (
        $EmployeeID,
        '$NameEmp',
        '$Specification',
        CONVERT('$DateOfBirth', DATE),
        $Experience,
        $Salary
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
    $EmployeeID = mysqli_real_escape_string($con, $_POST["EmployeeID"]);
    $delete_Query = "DELETE FROM `Employee` WHERE `EmployeeID` = $EmployeeID";
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
        if(!empty($_POST["EmployeeID"]) 
        && !empty($_POST["NameEmp"]) 
        && !empty($_POST["Specification"]) 
        && !empty($_POST["DateOfBirth"]) 
        && !empty($_POST["Experience"]) 
        && !empty($_POST["Salary"]) ) {

    $EmployeeID = mysqli_real_escape_string($con, $_POST["EmployeeID"]);
    $NameEmp = mysqli_real_escape_string($con, $_POST["NameEmp"]);
    $Specification= mysqli_real_escape_string($con, $_POST["Specification"]);
    $DateOfBirth =mysqli_real_escape_string($con, $_POST["DateOfBirth"]);
    $Experience=mysqli_real_escape_string($con, $_POST["Experience"]);
    $Salary=mysqli_real_escape_string($con, $_POST["Salary"]);
    $query=mysqli_query($con, "SELECT * FROM `Employee` WHERE `EmployeeID` = $EmployeeID");
    $numrows=mysqli_num_rows($query);

    $update_Query = "UPDATE `Employee` SET `NameEmp`='$NameEmp',`Specification`='$Specification', `DateOfBirth`=STR_TO_DATE('$DateOfBirth','%Y-%m-%d'), `Experience`=$Experience, `Salary`=$Salary WHERE `EmployeeID` = $EmployeeID";
  
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
        <title>Employees</title>
<?php include("includes/header.php"); ?>
    </head>
    <body>
        <form action="Employee.php" method="post">
            <input title = "Enter number here" type="number" name="EmployeeID" placeholder="Id" value="<?php echo $EmployeeID;?>"><br><br>
            <input title = "Enter name here" type="text" name="NameEmp" placeholder="Employee Name" value="<?php echo $NameEmp;?>"><br><br>
            <input title = "Enter specification here" type="text" name="Specification" placeholder="Profession" value="<?php echo $Specification;?>"><br><br>
            <input title = "Enter date of birth" type="text" name="DateOfBirth" placeholder="Date of Birth" value="<?php echo $DateOfBirth;?>"><br><br>
            <input title = "Enter expirience" type="number" name="Experience" placeholder="Experience" value="<?php echo $Experience;?>"><br><br>
            <input title = "Enter salary" type="number" name="Salary" placeholder="Salary" value="<?php echo $Salary;?>"><br><br>

            <div>
                <?php
                if ('admin' == $_COOKIE['usernamecookie']) {
                echo " <input id='DV1' type='submit' name='insert' value='Add'> ";
                echo "<input id='DV1' type='submit' name='update' value='Update'> ";
                echo "<input id='DV1' type='submit' name='delete' value='Delete'> ";
                }
                ?>
                <input id='DV1' type='submit' name='search' value='Find'>
            </div>

        <br>Choose another table to work with:<br>

        <a href="Customer.php"><input id="DV1" type="button" value="Customer"/></a>
        <a href="Product.php"><input id="DV1" type="button" value="Product"/></a>
        <a href="Provider.php"><input id="DV1" type="button" value="Provider"/></a>
        <a href="OrderDetail.php"><input id="DV1" type="button" value="Order Details"/></a>
        <p id="p2"><a href="logout.php">Logout</a> from system</p>
        </form>
    </body>
</html>
