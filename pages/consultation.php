<?php
require '../host/dbconnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> ADMIN DASHBOARD </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" type="image/x-icon" href="imgs/logo.png"/>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="../css/styles.css" type="text/css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
      <script defer src="https://use.fontawesome.com/releases/v6.1.1/js/all.js" integrity="sha384-xBXmu0dk1bEoiwd71wOonQLyH+VpgR1XcDH3rtxrLww5ajNTuMvBdL5SOiFZnNdp" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../js/index.js"></script>

</head>
<body>
  <?php
  $sql = "SELECT * FROM tbladmin";
  $query = mysqli_query($con, $sql);
  $adminData = mysqli_fetch_assoc($query);

  ?>
  <nav class="navbar navbar-light" style="background-color: maroon;">
    <div class="container" style="margin: 0px 80px 0px 50px;">
      <a class="navbar-brand" href="consultation.php"><img src="../imgs/logotext.png" alt="" width="100%" height="100px"></a>
      <h1 class=".navbar-brand text-warning" style="position: absolute; text-align:center; left: 0; right:0;">Consultation</h1>	
      <div class="user" >
      <a href="../pages/login.php" target="_top" onclick="return confirm('Are you sure you want to logout?');logout()" style="right:50px; position: absolute;"><i class="fa fa-sign-out" aria-hidden="true" style="color:rgba(242, 206, 26, 0.886); font-size: 30px; curser: pointer;" title="Logout"></i></a>
      </div>
    </div>
  </nav>

  <div class="container" style="margin-left: 50px; ">
    <br><br>
  <h2><?php echo $adminData['username']; ?></h2>
  <h6><?php echo $adminData['email']; ?></h6>
  </div>

	<!--Add phys-->
	<section id="sections" class="py-4 mb-2">
		<div class="container">
			<div class="row text-center">
				<div class="col-md"></div>
        <div class="col-md-3">
					<a href="?add" class="btn btn-danger btn-block" id="add" data-bs-toggle="modal" data-bs-target="#addConsultation"><i class='bx bx-plus-medical'></i>Add Consultation</a>
				</div>
				<div class="col-md"></div>
			</div>
		</div>

	</section>

	<!--Table-->
	<section id="post">
		<div class="container" style="padding:0px 50px 0px 50px; min-width:100%">
			<div class="row">
			<table id="tblconsult" class="table table-hover table-striped">
							<thead>
								<th>Consultation ID</th>
								<th>Patient ID</th>
								<th>Physician ID</th>
                <th>Date Of Consultation</th>
								<th>Consultation Type</th>
								<th>Purpose</th>
								<th>Illness</th>
                <th>Action</th>
							</thead>
							 <tbody>
                 <?php
                 $query = mysqli_query($con, "SELECT * FROM consultation");

                 while( $row = mysqli_fetch_assoc($query) ){

                 $ConsultationID = $row['consultationID'];
                 $PatientID = $row['patientID'];
                 $PhysicianID = $row['physicianID'];
                 $DateOfCons = $row['date_of_consultation'];
                 $ConsultationType = $row['consultation_type'];
                 $Purpose = $row['purpose'];
                 $Illness = $row['illness'];
                 ?>

                 <tr>
                   <td> <?php echo $ConsultationID;  ?> </td>
                   <td> <?php echo $PatientID;  ?> </td>
                   <td> <?php echo $PhysicianID;  ?> </td>
                   <td> <?php echo $DateOfCons;  ?> </td>
                   <td> <?php echo $ConsultationType;  ?> </td>
                   <td> <?php echo $Purpose;  ?> </td>
                   <td> <?php echo $Illness;  ?> </td>
                   <td>
                   <a class="btn btn-success btn-sm" data-bs-toggle="modal" id="editbtn" data-bs-target="#edit"
                                        data-consultid="<?php echo $ConsultationID; ?>"
                                        data-dateofconsult="<?php echo $DateOfCons; ?>"
                                        data-type="<?php echo $ConsultationType; ?>"
               										    	data-purpose="<?php echo $Purpose; ?>"
                                         data-illness="<?php echo $Illness; ?>">
                                        <i class="fas fa-edit"></i>
                      </a>
                      <a class="btn btn-danger btn-sm" href="../php/con-module.php?delete=<?php echo $ConsultationID; ?>" onclick="return confirm('Are you sure you want to delete the account?')";><i class='bx bx-trash'></i></a>
                   </td>
                 </tr>
                 <?php

                 }

                 ?>
							 </tbody>
						</table>
			</div>
		</div>
	</section>


  <!-- The Modal (ADD) -->
  <div class="modal fade" id="addConsultation">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<div class="modal-title">
						<h5>Adď Consultation</h5>
					</div>
					<button type="button btn" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="../php/con-module.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
            <label class="form-control-label">Attending Physician ID:</label>
							<input type="number" name="_physicianId" class="form-control" required> <br>

              <label class="form-control-label">Date Of Consultation:</label>
							<input type="date" name="_dateofconsultation" class="form-control" required> <br>

              <label class="form-control-label">Consultation Type:</label>
							<select name="_consultationtype" class="form-control" required>
								<option value=""></option>
								<option value="stay">stay</option>
								<option value="visit">visit</option>
							</select>

              <label class="form-control-label">Purpose:</label>
							<input type="text" name="_purpose" class="form-control" required autocomplete="off"> <br>

              <label class="form-control-label">Illness:</label>
							<input type="text" name="_illness" class="form-control" autocomplete="off"> <br>

              
              <label class="form-control-label">Has not yet visited:</label>
              <div class="form-control">
              <input type="radio" id="yes-1" name="visit" value="">
              <label for="Yes">Yes</label>
              <input type="radio" id="no-1" name="visit" value="">
              <label for="No">No</label>
              </div>
                 
              <div id="show-0" style="display:none;">
                 <label class="form-control-label">Patient ID:</label>
                 <input type="number" name="_patientid" class="form-control" autocomplete="off"> <br>
                 </div>
                <div id="show-1" style="display: none;">
                <label class="form-control-label">First Name:</label>
                <input type="text" name="_firstname" class="form-control" autocomplete="off"> <br>
                
                <label class="form-control-label">Last Name:</label>
                <input type="text" name="_lastname" class="form-control" autocomplete="off"> <br>
                
                <label class="form-control-label">Middle Initial:</label>
                <input type="text" name="_middleinitial" class="form-control" autocomplete="off"> <br>

                <label class="form-control-label">Email Address</label>
                <input type="email" name="_emailAddress" class="form-control" autocomplete="off"> <br>

                <label class="form-control-label">City</label>
                <input type="text" name="_city" class="form-control" autocomplete="off"> <br>

                <label class="form-control-label">Street</label>
                <input type="text" name="_street" class="form-control" autocomplete="off"> <br>

                <label class="form-control-label">Subdivision</label>
                <input type="text" name="_subdivision" class="form-control" autocomplete="off"> <br>

                <label class="form-control-label">Barangay</label>
                <input type="text" name="_barangay" class="form-control" autocomplete="off"> <br>

                <label class="form-control-label">Zip</label>
                <input type="text" name="_zip" class="form-control" autocomplete="off"> <br>

                <label class="form-control-label">Sex</label>
                <select name="_sex" class="form-control">
                  <option value=""></option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>

                <label class="form-control-label">Contact Number</label>
                <input type="number" name="_contactnum" class="form-control" autocomplete="off"> <br>
                
                <label class="form-control-label">Date Of Birth</label>
                <input type="date" name="_bday" class="form-control"> <br>

                <label class="form-control-label">Height (cm)</label>
                <input type="number" name="_height" class="form-control" autocomplete="off"> <br>
                
                <label class="form-control-label">Weight (kg)</label>
                <input type="number" name="_weight" class="form-control" autocomplete="off"> <br>

                <label class="form-control-label">Age</label>
                <input type="number" name="_age" class="form-control" autocomplete="off"> <br>
                </div>
              

              <label class="form-control-label">Has medical record:</label>
              <div class="form-control">
              <input type="radio" id="yes-2" name="option" value="Yes">
              <label for="Yes">Yes</label>
              <input type="radio" id="no-2" name="option" value="No">
              <label for="No">No</label>
              </div>

              <div id="show-2" style="display:none;">
              <label class="form-control-label">Previous Illness:</label>
							<input type="text" name="_previousillness" class="form-control" autocomplete="off"> <br>

              <label class="form-control-label">Previous Treamtment:</label>
							<input type="text" name="_previoustreatment" class="form-control" autocomplete="off"> <br>
              
              <label class="form-control-label">Allergy:</label>
							<input type="text" name="_allergy" class="form-control" autocomplete="off"> <br>
              
              <label class="form-control-label">Blood Type:</label>
							<input type="text" name="_bloodtype" class="form-control" autocomplete="off"> <br>

              </div>

            <label class="form-control-label">Needs treatment:</label>
              <div class="form-control">
                <input type="radio" id="yes-3" name="option-2" value="Yes">
                <label for="Yes">Yes</label>
                <input type="radio" id="no-3" name="option-2" value="No">
                <label for="No">No</label>
              </div>
              
              <div id="show-3" style="display:none;">
              <label class="form-control-label">Medicine Code:</label>
							<input type="number" name="_medcode" class="form-control" autocomplete="off"> <br>

              <label class="form-control-label">Quantity:</label>
							<input type="number" name="_quantity" class="form-control" autocomplete="off"> <br>
              
              <label class="form-control-label">Dosage:</label>
							<input type="text" name="_dosage" class="form-control" autocomplete="off"> <br>
              </div>
              
            <label class="form-control-label">Requests Equipment:</label>
              <div class="form-control">
                <input type="radio" id="yes-4" name="option-3" value="Yes">
                <label for="Yes">Yes</label>
                <input type="radio" id="no-4" name="option-3" value="No">
                <label for="No">No</label>
              </div>

              <div id="show-4" style="display:none;">
              <label class="form-control-label">Equipment ID:</label>
							<input type="number" name="_equipmentid" class="form-control" autocomplete="off"> <br>

              <label class="form-control-label">Quantity:</label>
							<input type="number" name="_equipmentquantity" class="form-control" autocomplete="off"> <br>
              
              <label class="form-control-label">Duration:</label>
							<input type="text" name="_duration" class="form-control" autocomplete="off"> <br>

              <label class="form-control-label">Return Date:</label>
							<input type="date" name="_returndate" class="form-control" autocomplete="off"> <br>
              </div>

						</div>
						<br>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="status" value="0">
					<input type="submit" class="btn btn-success" name="save" value="Save">
				</div>
			</form>
			</div>
		</div>
	</div>

  <!-- Modal (EDIT) -->
  <div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="../php/con-module.php" method="GET" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title fw-bold">Physician Account Details</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
          <div class="row mx-3">
            <div class="col-sm">
             <p>Consultation ID:</p>
             </div>
            <div class="col-sm">
              <input type="text" id="consid" name="consid" value="" readonly style="border:none;">
            </div>
          <hr>
          </div>
            <div class="row mx-3">
            <div class="col-sm">
             <p>Date of Consult:</p>
             </div>
            <div class="col-sm">
              <input type="text" id="dateconsult" name="dateconsult" value="">
            </div>
          <hr>
          </div>
          <div class="row mx-3">
            <div class="col-sm">
            <p>Consultation Type:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="constype" name="constyoe" value="">
          </div>
          <hr>
          </div>
            <div class="row mx-3">
            <div class="col-sm">
             <p>Purpose:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="conspurpose" name="conspurpose" value="">
          </div>
          <hr>
          </div>  
            <div class="row mx-3">
            <div class="col-sm">
            <p>Illness:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="consillness" name="consillness" value="">
          </div>
          <hr>
          </div>  
          </div>
          <div class="modal-footer">
          <input type="button" class="btn btn-danger" value="Close" data-bs-dismiss="modal">
          <input type="hidden" name="status" value="0">
					<input type="submit" class="btn btn-success" name="editbtn" value="Save" data-bs-dismiss="modal">
				  </div>
        </form>
      </div>
    </div>
  </div>
</body>
<script>
$(function(){

  $("#tblconsult").DataTable({
    "responsive":true,
    "autoWidth":false
  });
});

$(document).ready(function() {
   $('input[type="radio"]').click(function() {

    if($(this).attr('id') == 'yes-1'){
      $('#show-1').show();
      $('#show-0').hide();
      $('[name="_patientid"]').val('');
    } else{
      $('#show-0').show();
      $('#show-1').hide();
    }
       ($(this).attr('id') == 'yes-2') ? $('#show-2').show() : $('#show-2').hide();   
       ($(this).attr('id') == 'yes-3') ? $('#show-3').show() : $('#show-3').hide();
       ($(this).attr('id') == 'yes-4') ? $('#show-4').show() : $('#show-4').hide();
   });
});

$(document).on('click', '#viewbtn, #editbtn', function (){
  var mappings = {
    'consultid': 'consid',
    'dateofconsult': 'dateconsult',
    'type': 'constype',
    'purpose': 'conspurpose',
    'illness': 'consillness',
    
  };


  for (var key in mappings) {
    if (mappings.hasOwnProperty(key)) {
      var inputValue = $(this).data(key);
      var inputId = mappings[key];
      var inputElement = document.getElementById(inputId);

      if (inputElement && inputValue !== undefined) {
        inputElement.value = inputValue;
        
      }
    }
  }     
});




</script>
</html>
