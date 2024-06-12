<?php
include '../host/dbconnection.php';

if (isset($_POST['save'])) {
    $cconid = $_POST['_consultationid'];

    $res = mysqli_query($con, "SELECT consultationID FROM consultation WHERE consultationID='$cconid'");
    $numRows = mysqli_num_rows($res);
    
        if ($numRows > 0) {
            $queryadd = mysqli_query($con, "INSERT INTO medicalreport (consultationID, patientID, patientLN, patientFN, physicianID, physicianLN, physicianFN, medcode, quantity, requestCode, recordID, dateOfReport)
            SELECT c.consultationID, p.patientID, p.lname, p.fname, ps.physicianID, ps.lastName, ps.firstName, COALESCE(pr.medcode, NULL), COALESCE(pr.quantity, NULL), COALESCE(er.requestCode, NULL), COALESCE(mr.recordID, NULL), c.date_of_consultation
            FROM consultation c
            INNER JOIN patient p ON c.patientID = p.patientID
            INNER JOIN physician ps ON c.physicianID = ps.physicianID
            LEFT JOIN prescription pr ON pr.consultationID = c.consultationID
            LEFT JOIN medicalrecord mr ON mr.patientID = c.patientID
            LEFT JOIN equipmentrequest er ON er.consultationID = c.consultationID
            WHERE c.consultationID='$cconid';");
            
            header("location: ../pages/report.php");
        } else {
            echo "<script>alert('Record does not exist.'); window.location.href = '../pages/report.php';</script>";
        }
   
}

if (isset($_GET['delete'])) {
    $conidd = $_GET['delete'];

        require_once("../host/dbconnection.php");

        $sql = "DELETE FROM medicalreport WHERE consultationID = '$conidd'";
        $query = mysqli_query($con, $sql);

        header("location: ../pages/report.php");

}
?>
