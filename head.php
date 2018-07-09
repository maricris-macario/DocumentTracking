<?php 
include ('db.php');
session_start(); 
if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user']; // username
    $queryInfo = "SELECT * FROM user WHERE username = '{$username}';";
    $getInfo = mysqli_query($con, $queryInfo);
    $info = mysqli_fetch_assoc($getInfo);
    $_SESSION['userID'] = $info['userID']; // user ID
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="keywords" content="au theme template">
    <link rel="icon" type="image/png" href="img/logo1.png">

    <!-- Title Page-->
    <title><?php echo $pagename ?></title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- jquery -->
    <script src="jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="jquery/dist/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery/dist/jquery-ui.min.css">
    <script type="text/javascript" src="jquery/dist/jquery-ui.min.js"></script>

    <!-- Bootstrap CSS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <script type="text/javascript" src="vendor/bootstrap-4.1/bootstrap.min.js"></script>

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="datatables/DataTables-1.10.16/css/jquery.dataTables.css">
    <script type="text/javascript" src="datatables/DataTables-1.10.16/js/jquery.dataTables.js"></script>
    
    <!-- Buttons (DataTables plugin) -->
    <link rel="stylesheet" type="text/css" href="Buttons-1.5.2/css/buttons.dataTables.css">
    <script type="text/javascript" src="Buttons-1.5.2/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="Buttons-1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="Buttons-1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="jszip/dist/jszip.min.js"></script>
    <script type="text/javascript" src="Buttons-1.5.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="Buttons-1.5.2/js/buttons.html5.js"></script>
    <script type="text/javascript" src="pdfmake-master/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="pdfmake-master/build/vfs_fonts.js"></script>
</head>