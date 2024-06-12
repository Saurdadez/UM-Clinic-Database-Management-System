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
    <h1 class=".navbar-brand text-warning" style="position: absolute; text-align:center; left: 0; right:0;">Patients</h1>	
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
					<a href="?add" class="btn btn-danger btn-block" id="add" data-bs-toggle="modal" data-bs-target="#addPatient"><i class='bx bx-plus-medical'></i>Add Patient</a>
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
								<th>Patient ID</th>
								<th>First Name</th>
								<th>Last Name</th>
                                <th>Middle Initial</th>
                                <th>Email Address</th>
                                <th>AddressID</th>
								<th>Address</th>
								<th>Sex</th>
                                <th>Contact Number</th>
                                <th>Date Of Birth</th>
                                <th>Height</th>
                                <th>Weight</th>
                                <th>Age</th>
                                <th>Action</th>
							</thead>
							 <tbody>

                 <?php

                 $query = mysqli_query($con, "SELECT * FROM patient");
                 
                 while( $row = mysqli_fetch_assoc($query) ){
                    
                 $Pid = $row['patientID'];
                 $Pfname = $row['fname'];
                 $Plname = $row['lname'];
                 $Pminitial = $row['middle_initial'];
                 $Pemail = $row['email_address'];
                 $Paddress = $row['addressID'];
                 $Psex = $row['sex'];
                 $Pcontact = $row['contact_num'];
                 $Pdateofb = $row['dateOfBirth'];
                 $Pheight = $row['height'];
                 $Pweight = $row['weight'];
                 $Page = $row['age'];
                 $queryaddress = mysqli_query($con, "SELECT * FROM address WHERE addressID='$Paddress'");
                 $addressrow = mysqli_fetch_assoc($queryaddress);
                 $Acity = $addressrow['city'];
                 $Astreet = $addressrow['street'];
                 $Asubdivision = $addressrow['subdivision'];
                 $Abarangay= $addressrow['barangay'];
                 $Azip= $addressrow['zip'];
                 ?>

                 <tr>
                   <td> <?php echo $Pid  ?> </td>
                   <td> <?php echo $Pfname  ?> </td>
                   <td> <?php echo $Plname  ?> </td>
                   <td> <?php echo $Pminitial  ?> </td>
                   <td> <?php echo $Pemail  ?> </td>
                   <td> <?php echo $Paddress  ?> </td>
                   <td> <?php echo "{$Astreet}, {$Asubdivision}, {$Abarangay}, {$Acity}, {$Azip}"?> </td>
                   <td> <?php echo $Psex  ?> </td>
                   <td> <?php echo $Pcontact  ?> </td>
                   <td> <?php echo $Pdateofb  ?> </td>
                   <td> <?php echo $Pheight  ?> </td>
                   <td> <?php echo $Pweight  ?> </td>
                   <td> <?php echo $Page ?> </td>
                   <td>
                   <a class="btn btn-success btn-sm" data-bs-toggle="modal" id="editbtn" data-bs-target="#edit"
                                        data-pid="<?php echo $Pid; ?>"
                                        data-pfn="<?php echo $Pfname; ?>"
                                        data-pln="<?php echo $Plname; ?>"
               							data-pinit="<?php echo $Pminitial; ?>"
                                        data-pem="<?php echo $Pemail; ?>"
                                        data-pad="<?php echo $Paddress; ?>"
                                        data-psex="<?php echo $Psex; ?>>"
                                        data-pcon="<?php echo $Pcontact; ?>"
                                        data-pdate="<?php echo $Pdateofb; ?>"
                                        data-phei="<?php echo $Pheight; ?>"
                                        data-pwei="<?php echo $Pweight; ?>"
                                        data-page="<?php echo $Page; ?>">
                                        <i class="fas fa-edit"></i>
                      </a>
                      <a class="btn btn-danger btn-sm" href="../php/pat-module.php?delete=<?php echo $Pid; ?>" onclick="return confirm('Are you sure you want to delete the account?')";><i class='bx bx-trash'></i></a>
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
  <div class="modal fade" id="addPatient">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<div class="modal-title">
						<h5>Adď Patient</h5>
					</div>
					<button type="button btn" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				<form action="../php/pat-module.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
                <label class="form-control-label">First Name:</label>
                <input type="text" name="_firstname" class="form-control" autocomplete="off" required> <br>
                
                <label class="form-control-label">Last Name:</label>
                <input type="text" name="_lastname" class="form-control" autocomplete="off" required> <br>
                
                <label class="form-control-label">Middle Initial:</label>
                <input type="text" name="_middleinitial" class="form-control" autocomplete="off" required> <br>

                <label class="form-control-label">Email Address</label>
                <input type="email" name="_emailAddress" class="form-control" autocomplete="off" required> <br>

                <label class="form-control-label">City</label>
                <input type="text" name="_city" class="form-control" autocomplete="off" required> <br>

                <label class="form-control-label">Street</label>
                <input type="text" name="_street" class="form-control" autocomplete="off" required> <br>

                <label class="form-control-label">Subdivision</label>
                <input type="text" name="_subdivision" class="form-control" autocomplete="off" required> <br>

                <label class="form-control-label">Barangay</label>
                <input type="text" name="_barangay" class="form-control" autocomplete="off" required> <br>

                <label class="form-control-label">Zip</label>
                <input type="text" name="_zip" class="form-control" autocomplete="off" required> <br>

                <label class="form-control-label">Sex</label>
                <select name="_sex" class="form-control">
                  <option value=""></option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>

                <label class="form-control-label">Contact Number</label>
                <input type="number" name="_contactnum" class="form-control" autocomplete="off" required> <br>
                
                <label class="form-control-label">Date Of Birth</label>
                <input type="date" name="_bday" class="form-control" required> <br>

                <label class="form-control-label">Height (cm)</label>
                <input type="number" name="_height" class="form-control" autocomplete="off" required> <br>
                
                <label class="form-control-label">Weight (kg)</label>
                <input type="number" name="_weight" class="form-control" autocomplete="off" required> <br>

                <label class="form-control-label">Age</label>
                <input type="number" name="_age" class="form-control" autocomplete="off" required> <br>
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
            <h4 class="modal-title fw-bold">Patient Details</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
          <div class="row mx-3">
            <div class="col-sm">
             <p>Patient ID:</p>
             </div>
            <div class="col-sm">
              <input type="text" id="paid" name="paid" value="" readonly style="border:none;">
            </div>
          <hr>
          </div>
            <div class="row mx-3">
            <div class="col-sm">
             <p>First Name:</p>
             </div>
            <div class="col-sm">
              <input type="text" id="pafn" name="pafn" value="">
            </div>
          <hr>
          </div>
          <div class="row mx-3">
            <div class="col-sm">
             <p>Last Name:</p>
             </div>
            <div class="col-sm">
              <input type="text" id="paln" name="paln" value="">
            </div>
          <hr>
          </div>
          <div class="row mx-3">
            <div class="col-sm">
            <p>Middle Initial:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="painit" name="painit" value="">
          </div>
          <hr>
          </div>
            <div class="row mx-3">
            <div class="col-sm">
             <p>Email Address:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="paem" name="paem" value="">
          </div>
          <hr>
          </div> 
          <div class="row mx-3">
            <div class="col-sm">
             <p>Address ID:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="paadd" name="paadd" value="">
          </div>
          <hr>
          </div>
          <div class="row mx-3">
            <div class="col-sm">
             <p>Sex:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="pasex" name="pasex" value="">
          </div>
          <hr>
          </div>
          <div class="row mx-3">
            <div class="col-sm">
             <p>Contact Number:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="pacont" name="pacont" value="">
          </div>
          <hr>
          </div>
          <div class="row mx-3">
            <div class="col-sm">
             <p>Date Of Birth:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="padate" name="padate" value="">
          </div>
          <hr>
          </div>
          <div class="row mx-3">
            <div class="col-sm">
             <p>Height:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="pahei" name="pahei" value="">
          </div>
          <hr>
          </div>
          <div class="row mx-3">
            <div class="col-sm">
             <p>Weight:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="pawei" name="pawei" value="">
          </div>
          <hr>
          </div>
          <div class="row mx-3">
            <div class="col-sm">
             <p>Age:</p>
          </div>
          <div class="col-sm">
          <input type="text" id="paage" name="paage" value="">
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
    'pid': 'paid',
    'pfn': 'pafn',
    'pln': 'paln',
    'pinit': 'painit',
    'pem': 'paem',
    'pad': 'paadd',
    'psex': 'pasex',
    'pcon': 'pacont',
    'pdate': 'padate',
    'phei': 'pahei',
    'pwei': 'pawei',
    'page': 'paage',

    
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
