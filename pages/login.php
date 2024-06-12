<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>University of Mindanao's Clinic Portal</title>
    <link rel="shortcut icon" type="image/x-icon" href="../imgs/logo.png"/>
    <link rel="stylesheet" href="../css/logstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/index.js"></script>

</head>
<body>
<div class="container">
<div class="main">
    <div class="logo">
      <span><img src="../imgs/logo.png" alt="" width="100px" height="100px"></span>
      <span><h1>UM CLINIC</h1><p>MATINA BRANCH.</p></span>
    </div>
      <div class="content">
      <form action="../host/validate.php" method="POST">
        <h1>Login</h1><br>
        <div id="field">
          <i class='bx bx-user icon'></i><input type="text" name="username" placeholder="Username" required autocomplete="off"><br>
        </div>  
        <div id="field">
          <i class='bx bx-lock icon' ></i><input type="password" name="password" class="input" placeholder="Password" id="pw" required autocomplete="off"><i class='fa fa-eye' id="view"></i><br>
        </div>
        <button type="submit" name="login">Sign in</button>
        </form>
      </div>
  </div>
</div>

  

</body>
 <script>
  const passwordInput = document.querySelector("#pw")
  const eye = document.querySelector("#view")

  eye.addEventListener("click", function(){
  this.classList.toggle("fa-eye-slash");
  const type = passwordInput.getAttribute("type") === "password" ? "text" : "password"
  passwordInput.setAttribute("type", type)
  })
 </script>
    
</html>
