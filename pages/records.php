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
    <h1 class=".navbar-brand text-warning" style="position: absolute; text-align:center; left: 0; right:0;">Records</h1>	
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
					<a href="?add" class="btn btn-danger btn-block" id="add" data-bs-toggle="modal" data-bs-target="#addPhysician"><i class='bx bx-plus-medical'></i>Add Record</a>
				</div>
				<div class="col-md"></div>
			</div>
		</div>

	</section>

	<!--Table-->
	<section id="post">
		<div class="container" style="padding:0px 50px 0px 50px; min-width:100%">
			<div class="row">
			<table id="tblrecords" class="table table-hover table-striped">
							<thead>
								<th>Record ID</th>
								<th>Patient ID</th>
								<th>Previous Illness</th>
                <th>Previous Treatment</th>
                <th>Allergy</th>
								<th>Bloodtype</th>
								<th>Action</th>
							</thead>
							 <tbody>

                 <?php

                 $query = mysqli_query($con, "SELECT * FROM medicalrecord");

                 while( $row = mysqli_fetch_assoc($query) ){

                 $RecordID = $row['recordID'];
                 $PatientID = $row['patientID'];
                 $Prev_Illness = $row['prev_illness'];
                 $Prev_Treatment = $row['prev_treatment'];
                 $Allergy = $row['allergy'];
                 $BloodType = $row['bloodtype'];

                 ?>

                 <tr>
                   <td> <?php echo $RecordID  ?> </td>
                   <td> <?php echo $PatientID  ?> </td>
                   <td> <?php echo $Prev_Illness  ?> </td>
                   <td> <?php echo $Prev_Treatment  ?> </td>
                   <td> <?php echo $Allergy  ?> </td>
                   <td> <?php echo $BloodType  ?> </td>
                   <td>
                   <a class="btn btn-success btn-sm" data-bs-toggle="modal" id="editbtn" data-bs-target="#edit"
                                        data-recid="<?php echo $RecordID; ?>"
                                        data-patid="<?php echo $PatientID; ?>"
                                        data-pi="<?php echo $Prev_Illness; ?>"
               										    	data-prtreat="<?php echo $Prev_Treatment; ?>"
                                        data-alle="<?php echo $Allergy; ?>"
                                        data-btype="<?php echo $BloodType; ?>">
                                        <i class="fas fa-edit"></i>
                      </a>
                      <a class="btn btn-danger btn-sm" href="../php/rec-module.php?delete=<?php echo $RecordID; ?>" onclick="return confirm('Are you sure you want to delete the account?')";><i class='bx bx-trash'></i></a>
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
  <div class="modal fade" id="addPhysician">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<div class="modal-title">
						<h5>Adď Record</h5>
					</div>
					<button type="button btn" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="../php/rec-module.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="form-control-label">Patient ID:</label>
							<input type="text" name="_patientid" class="form-control" required autocomplete="off" required> <br>
              
              <label class="form-control-label">Previous Illness:</label>
              <input type="text" name="_illness" class="form-control" required autocomplete="off" required> <br>

              <label class="form-control-label">Previous Treatment:</label>
              <input type="text" name="_treatment" class="form-control" required autocomplete="off" required> <br>

              <label class="form-control-label">Allergy:</label>
              <input type="text" name="_allergy" class="form-control" required autocomplete="off" required> <br>

              <label class="form-control-label">Bloodtype:</label>
              <input type="text" name="_bloodtype" class="form-control" required autocomplete="off" required> <br>
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
        <form action="../php/rec-module.php" method="GET" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title fw-bold">Record Details</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
          <div class="row mx-3">
            <div class="col-sm">
             <p>Record ID:</p>
             </div>
            <div class="col-sm">
              <input type="text" id="record" name="record" value="" readonly style="border:none;">
            </div>
          <hr>
          </div>
            <div class="row mx-3">
            <div class="col-sm">
             <p>Previous Illness:</p>
             </div>
            <div class="col-sm">
              <input type="text" id="previll" name="previll" value="">
            </div>
          <hr>
          </div>
          <div class="row mx-3">
            <div class="col-sm">
             <p>Previous Treatment:</p>
             </div>
            <div class="col-sm">
              <input type="text" id="prevtreat" name="prevtreat" value="">
            </div>
          <hr>
          </div>
          <div class="row mx-3">
            <div class="col-sm">
            <p>Allergy:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="allerg" name="allerg" value="">
          </div>
          <hr>
          </div>
            <div class="row mx-3">
            <div class="col-sm">
             <p>Bloodtype:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="bloodtyp" name="bloodtyp" value="">
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

  $("#tblrecords").DataTable({
    "responsive":true,
    "autoWidth":false
  });
});


$(document).on('click', '#editbtn', function (){
  var mappings = {
    'recid': 'record',
    'pi': 'previll',
    'prtreat': 'prevtreat',
    'alle': 'allerg',
    'btype': 'bloodtyp',
    
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
