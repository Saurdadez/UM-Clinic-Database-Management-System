<?php
include '../host/dbconnection.php';

if (isset($_POST['save'])) {
    
    $ppfn = $_POST['_firstname'];
    $ppln = $_POST['_lastname'];
    $ppinit = $_POST['_middleinitial'];
    $ppadd = $_POST['_emailAddress'];
    $ppcity = $_POST['_city'];
    $ppstreet = $_POST['_street'];
    $ppsub = $_POST['_subdivision'];
    $ppbarangay = $_POST['_barangay'];
    $ppzip = $_POST['_zip'];
    $ppsex = $_POST['_sex'];
    $ppcont = $_POST['_contactnum'];
    $ppbday = $_POST['_bday'];
    $pphei = $_POST['_height'];
    $ppwei = $_POST['_weight'];
    $ppage = $_POST['_age'];
  
    
    $queryadd=mysqli_query($con, "INSERT INTO address(city, street, subdivision, barangay, zip) 
    VALUES ('$ppcity','$ppstreet','$ppsub','$ppbarangay','$ppzip')");
    $querypat=mysqli_query($con, "INSERT INTO patient (fname, lname, middle_initial, email_address, addressID, sex, contact_num, dateOfBirth, height, weight, age)
    SELECT '$ppfn', '$ppln','$ppinit', '$ppadd', a.addressID, '$ppsex','$ppcont','$ppbday', $pphei, '$ppwei', '$ppage'
    FROM address a WHERE a.city='$City' AND a.street='$Street' AND a.subdivision='$Subdivision' AND a.barangay='$Barangay'");
        
}

if (isset($_GET['delete'])) {
    $ppid = $_GET['delete'];
  
    require_once("../host/dbconnection.php");

    $sql = "DELETE FROM patient WHERE patientID='$ppid'";
    $query = mysqli_query($con, $sql);

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

header("location: ../pages/patient.php");

?>