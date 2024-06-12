<?php
include '../host/dbconnection.php';

if (isset($_POST['save'])) {
    
    try{
        $PatId = $_POST['_patientid'];
    $prIll = $_POST['_illness'];
    $prTreat = $_POST['_treatment'];
    $algy = $_POST['_allergy'];
    $btyp = $_POST['_bloodtype'];


    $EquipmentId = $_POST['_equipmentid'];      
    
    
    $queryadd=mysqli_query($con, "INSERT INTO medicalrecord(patientID, prev_illness, prev_treatment, allergy, bloodtype)
    VALUES ('$PatId','$prIll','$prTreat','$algy','$btyp')");
    }
    catch(Exception $e){
        echo "<script>alert('Cannot add from records.'); window.location.href = './pages/records.php';</script>";
    }
        
}

if (isset($_GET['delete'])) {
    try{
    $recid = $_GET['delete'];
  
    require_once("../host/dbconnection.php");

    $sql = "DELETE FROM medicalrecord WHERE recordID='$recid'";
    $query = mysqli_query($con, $sql);
    }
    catch(Exception $e){
        echo "<script>alert('Record is used in another table.'); window.location.href = './pages/records.php';</script>";
    }
}

if (isset($_GET['editbtn'])) {
    $recoid = $_GET['record'];
    $previlln = $_GET['previll'];
    $prevrea = $_GET['prevtreat'];
    $aller = $_GET['allerg'];
    $bloodt = $_GET['bloodtyp'];
    
    editData($recoid, $previlln, $prevrea, $aller, $bloodt, $con);
}

function editData($recoid, $previlln, $prevrea, $aller, $bloodt, $con)
{
    
    require_once("../host/dbconnection.php");
    
    $sql = "UPDATE medicalrecord SET prev_illness='$previlln', prev_treatment='$prevrea', allergy='$aller', bloodtype ='$bloodt'
    WHERE recordID='$recoid'";
    $query1 = mysqli_query($con, $sql);
  
}

header("location: ../pages/records.php");

?>