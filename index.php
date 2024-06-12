<?php
session_start();
include './php/timeout.php';
if(!(isset($_SESSION["AdminID"]))){
    header('Location: ./pages/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="./imgs/logo.png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/styles.css">
    <script src="./js/index.js"></script>
    <title>UM Clinic</title> 
</head>

<body onload="changeIframe('./pages/consultation.php')">
    <nav class="sidebar">
        <div class="top">
            <div class="logo">
                <img src="imgs/logo.png" alt="umlogo" width="40px" height="40px">
                <span style="font-size:15px; color: maroon;">UM Matina Clinic<span>
            </div>
            <i class="bx bx-menu" id="btn"></i>
        </div>
        
        <ul>
            
            <li>
                <a href="#consultation" onclick="changeIframe('./pages/consultation.php')">
                <i class='bx bx-clipboard'></i>
                    <span class="nav-item">Consultation</span>
                </a>
                <span class="tooltip">Consultation</span>
            </li>
            <li>
                <a href="#records" onclick="changeIframe('./pages/patient.php')">
                <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="nav-item">Patient</span>
                </a>
                <span class="tooltip">Patient</span>
            </li>
            <li>
                <a href="#records" onclick="changeIframe('./pages/records.php')">
                    <i class='bx bxs-objects-horizontal-left'></i>
                    <span class="nav-item">Records</span>
                </a>
                <span class="tooltip">Records</span>
            </li>
            <li>
                <a href="#prescription" onclick="changeIframe('./pages/prescriptions.php')">
                    <i class='bx bxs-receipt'></i>
                    <span class="nav-item">Prescriptions</span>
                </a>
                <span class="tooltip">Prescriptions</span>
            </li>
            <li>
                <a href="#physician" onclick="changeIframe('./pages/physicians.php')">
                    <i class='bx bxs-face'></i>
                    <span class="nav-item">Physicians</span>
                </a>
                <span class="tooltip">Physicians</span>
            </li>
            <li>
                <a href="#report" onclick="changeIframe('./pages/report.php')">
                    <i class="bx bxs-grid-alt"></i>
                    <span class="nav-item">Report</span>
                </a>
                <span class="tooltip">Report</span>
            </li>
            <li>
                <a href="./pages/login.php" onclick="return confirm('Are you sure you want to logout?'); logout();">
                    <i class="bx bx-log-out"></i>
                    <span class="nav-item">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>
    </nav>

    <div class="main" style="padding:0; margin:0;">
    <div class="loader hidden" style="display: none;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 66 66" height="500px" width="500px" class="spinner">
            <circle stroke="url(#gradient)" r="20" cy="33" cx="33" stroke-width="1" fill="transparent" class="path"></circle>
            <linearGradient id="gradient">
                <stop stop-opacity="1" stop-color="#fe0000" offset="0%"></stop>
                <stop stop-opacity="0" stop-color="#af3dff" offset="100%"></stop>
            </linearGradient>  
        </svg> 
    </div>
        <iframe src="" frameborder="0" id="content" class="hidden">
        </iframe> 
    </div>
</body>
<script>
    let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.sidebar');

    sidebar.classList.toggle('active');
    btn.onclick = function () {
        sidebar.classList.toggle('active');
    };
    
</script>
</html>