<?php
include '../host/dbconnection.php';

 

if (isset($_POST['save'])) {
    $medic = $_POST['_medcode'];
    $consuli = $_POST['_consultationID'];
    $quant = $_POST['_quantity'];
    $dosagee = $_POST['_dosage']; 
    $queryadd=mysqli_query($con, "INSERT INTO prescription(medcode, consultationID, quantity, dosage)
    VALUES ('$medic','$consuli','$quant','$dosagee')");

}

if (isset($_GET['delete']) && isset($_GET['consultationID']) && isset($_GET['dosage']) && isset($_GET['quantity'])) {
    $medco = $_GET['delete'];
    $conidd=$_GET['consultationID'];
    $meddos = $_GET['dosage'];
    $medquan=$_GET['quantity'];

    require_once("../host/dbconnection.php");

    $sql = "DELETE FROM prescription WHERE medcode='$medco' AND consultationID='$conidd' AND dosage='$meddos' AND quantity='$medquan'";
    $query = mysqli_query($con, $sql);

}

if (isset($_GET['editbtn'])) {
    $consulid = $_GET['consid'];
    $mecode = $_GET['medicode'];
    $qua = $_GET['mediquan'];
    $dosa = $_GET['medidosage'];
 
    editData($consulid, $mecode, $qua, $dosa, $con);
}

function editData($consulid, $mecode, $qua, $dosa, $con)
{
    
    require_once("../host/dbconnection.php");
    
    $sql = "UPDATE prescription SET medcode='$mecode', quantity='$qua', dosage ='$dosa'
    WHERE consultationID='$consulid' AND medcode!='$mecode'";
    $query1 = mysqli_query($con, $sql);
  
}

header("location: ../pages/prescriptions.php");

?>