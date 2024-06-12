<?php
include '../host/dbconnection.php';

if (isset($_POST['save'])) {
    
    $AttendingPhys = $_POST['_physicianId'];
    $DateOfConsult = $_POST['_dateofconsultation'];
    $ConsultationType = $_POST['_consultationtype'];
    $Purpose = $_POST['_purpose'];
    $Illness = $_POST['_illness'];

    $PatientId = $_POST['_patientid'];

    $MedCode = $_POST['_medcode'];

    $EquipmentId = $_POST['_equipmentid'];      
    
    $PrevIllness = $_POST['_previousillness'];
    $PrevTreatment = $_POST['_previoustreatment'];
    $Allergy = $_POST['_allergy'];
    $BloodType = $_POST['_bloodtype'];

    if(empty($PatientId)){
        $FName = $_POST['_firstname'];
        $LName = $_POST['_lastname'];
        $MInitial = $_POST['_middleinitial'];
        $EmailAd = $_POST['_emailAddress'];
        $City = $_POST['_city'];
        $Street = $_POST['_street'];
        $Subdivision = $_POST['_subdivision'];
        $Barangay = $_POST['_barangay'];
        $Zip = $_POST['_zip'];
        $Sex = $_POST['_sex'];
        $ContactNum = $_POST['_contactnum'];
        $Birthday = $_POST['_bday'];
        $Height = $_POST['_height'];
        $Weight = $_POST['_weight'];
        $Age = $_POST['_age'];


        $queryadd=mysqli_query($con, "INSERT INTO address(city, street, subdivision, barangay, zip) VALUES ('$City','$Street','$Subdivision','$Barangay','$Zip')");
        $querypat=mysqli_query($con, "INSERT INTO patient (fname, lname, middle_initial, email_address, addressID, sex, contact_num, dateOfBirth, height, weight, age)
        SELECT '$FName', '$LName','$MInitial', COALESCE('$EmailAd', NULL), a.addressID,COALESCE('$Sex', NULL),COALESCE('$ContactNum', NULL), COALESCE('$Birthday', NULL), COALESCE('$Height', NULL), COALESCE('$Weight', NULL),COALESCE('$Age', NULL) 
        FROM address a WHERE a.city='$City' AND a.street='$Street' AND a.subdivision='$Subdivision' AND a.barangay='$Barangay'");

        $result = mysqli_query($con, "SELECT patientID FROM patient p WHERE p.fname ='$FName' AND p.lname='$LName' AND p.middle_initial='$MInitial'");
        $patientrow = mysqli_fetch_assoc($result);
        $PatientId = $patientrow['patientID'];
    } 

    $q = mysqli_query($con, "INSERT INTO consultation(patientID, physicianID, date_of_consultation, consultation_type, purpose, illness) 
        VALUES ('$PatientId', '$AttendingPhys' , '$DateOfConsult', '$ConsultationType', '$Purpose', '$Illness')");
    
    $queryConId = mysqli_query($con, "SELECT consultationID FROM consultation WHERE patientId='$PatientId' AND date_of_consultation='$DateOfConsult'");
    $ConsIdrow = mysqli_fetch_assoc($queryConId);
    $ConsultationID = $ConsIdrow['consultationID'];
  
    if(!(empty($EquipmentId))){
        $EquipmentQt = $_POST['_equipmentquantity'];
        $EquipmentDuration = $_POST['_duration'];
        $EquipmentDate = date("Y-m-d");
        $EquipmentReturn = $_POST['_returndate'];
        $q1 = mysqli_query($con, "INSERT INTO equipmentrequest(equipmentID, consultationID, dateRequested, duration, returnDate, quantity)
        SELECT '$EquipmentId', c.consultationID, '$EquipmentDate', '$EquipmentDuration', '$EquipmentReturn','$EquipmentQt' FROM consultation c
        WHERE c.patientID='$PatientId' AND c.date_of_consultation='$DateOfConsult'");
    }

    if(!(empty($BloodType))||!(empty($PrevIllness))||!(empty($PrevTreatment))||!(empty($Allergy))){
        
        $q2 = mysqli_query($con, "INSERT INTO medicalrecord(patientID, prev_illness, prev_treatment, allergy, bloodtype)
        VALUES ('$PatientId', '$PrevIllness', '$PrevTreatment', '$Allergy', '$BloodType')");
    }

    if(!(empty($MedCode))){
        $Quantity = $_POST['_quantity'];
        $Dosage = $_POST['_dosage'];

        $q3 = mysqli_query($con, "INSERT INTO prescription(medcode, consultationID, quantity, dosage)
        VALUES ('$MedCode', '$ConsultationID', '$Quantity', '$Dosage')");
    }

}

if (isset($_GET['delete'])) {
    $ConsultationId = $_GET['delete'];
  
    require_once("../host/dbconnection.php");

    $sql = "DELETE FROM consultation WHERE consultationID='$ConsultationId'";
    $query = mysqli_query($con, $sql);

}

if (isset($_GET['editbtn'])) {
    $Consid = $_GET['consid'];
    $Consdate = $_GET['dateconsult'];
    $Constype = $_GET['constype'];
    $Conspurpose = $_GET['conspurpose'];
    $Consillness = $_GET['consillness'];
    
    editData($Consid, $Consdate, $Constype, $Conspurpose, $Consillness, $con);
}

function editData($Consid, $Consdate, $Constype, $Conspurpose, $Consillness, $con)
{
    
    require_once("../host/dbconnection.php");
    
    $sql = "UPDATE consultation SET date_of_consultation='$Consdate', consultation_type='$Constype', purpose='$Conspurpose', illness ='$Consillness'
    WHERE consultationID='$Consid'";
    $query1 = mysqli_query($con, $sql);
  
}

header("location: ../pages/consultation.php");

?>