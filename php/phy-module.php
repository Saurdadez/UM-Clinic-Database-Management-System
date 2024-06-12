<?php
include '../host/dbconnection.php';

if (isset($_POST['save'])) {
    try{

        $FirstName = $_POST['_FirstName'];
        $LastName = $_POST['_LastName'];
        $MiddleInitial = $_POST['_MiddleInitial'];
        $ContactNo = $_POST['_ContactNo'];
        $email = $_POST['_email'];
        $specialization = $_POST['_specialization'];
    
        insertData($FirstName, $LastName, $MiddleInitial, $ContactNo, $email, $specialization, $con);
    }
    catch(Exception $e){
        echo "<script>alert('Cannot add from records.'); window.location.href = './pages/physicians.php';</script>";
    }
}

function insertData($FirstName, $LastName, $MiddleInitial, $ContactNo, $email, $specialization, $con)
{
    $sql = "INSERT INTO physician (firstName, lastName, middleInitial, contactNum, email_address, specialization)
            VALUES ('$FirstName', '$LastName', '$MiddleInitial', '$ContactNo', '$email', '$specialization')";
    $query1 = mysqli_query($con, $sql);

    header("location: ../pages/physicians.php");
    exit;
}
if (isset($_GET['delete'])) {
    try{
        $PhysicianID = $_GET['delete'];
  
    require_once("../host/dbconnection.php");

    $sql = "DELETE FROM physician WHERE physicianID='$PhysicianID'";
    $query = mysqli_query($con, $sql);

    header("location: ../pages/physicians.php");
    }
    catch(Exception $e){
        echo "<script>alert('Record is used in another table.'); window.location.href = './pages/physicians.php';</script>";
    }

}


function editData($PhysID, $FName, $LName, $emadd, $cnum, $middleInit, $Special, $con)
{
    
    require_once("../host/dbconnection.php");
    
    $sql = "UPDATE physician SET firstName='$FName', lastName='$LName', middleInitial='$middleInit',contactNum='$cnum', email_address='$emadd', specialization ='$Special'
    WHERE physicianID='$PhysID'";
    $query1 = mysqli_query($con, $sql);
    
    header("location: ../pages/physicians.php");
  
}

if (isset($_GET['editbtn'])) {
    $PhysID = $_GET['physId'];
    $FName = $_GET['fname'];
    $LName = $_GET['lname'];
    $emadd = $_GET['eaddress'];
    $cnum = $_GET['cnumber'];
    $middleInit = $_GET['minitial'];
    $Special = $_GET['special'];
    
    editData($PhysID, $FName, $LName, $emadd, $cnum, $middleInit, $Special, $con);
}
?>