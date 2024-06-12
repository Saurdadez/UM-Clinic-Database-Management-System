<?php
session_start();
include('../host/dbconnection.php');

if (isset($_POST['login'])) {

  $username = mysqli_real_escape_string($con, $_POST['username']);
  $password = mysqli_real_escape_string($con, $_POST['password']);

  $query = mysqli_query($con, "SELECT AdminID from tbladmin where username='$username' AND password='$password'");


  $row = $query -> fetch_assoc();

  if (mysqli_num_rows($query) > 0) {
    $_SESSION['AdminID']=$row['AdminID'];
    $_SESSION["login_time_stamp"] = time();
    header('location:../index.php');
  }
  else {
    echo "<script>alert('Invalid username or password.'); window.location.href = '../pages/login.php';</script>";
    exit();
  }


}
?>