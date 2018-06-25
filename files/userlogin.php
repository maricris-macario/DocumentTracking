<?php
//include 'dbconnect.php';
require_once 'config.php';
session_start();
//include('login.php');
if(isset($_SESSION['login_user'])){
    header("location:index.php");
}

$hostname = "localhost";
$user = "root";
$password = "";
$database = "doctrack";

$connect = mysql_connect($hostname, $user, $password);
mysql_select_db($database);

if(isset($_POST['username'])){
    $uname = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select username, pwd from user where username='".$uname."'";
    $result = mysql_query($sql);

    if(mysql_num_rows($result) == 1){
        echo "Login Successful!";
    }else{
        echo "You must have entered a wrong username or password";
        exit();
    }

}
?>

<!DOCTYPE html>

<html>
<head>
	<title>User Login (PMA Document Tracking System)</title>
    <link rel="stylesheet" href="css/material-kit.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
</head>
    <body>
	       <style>
           @font-face{
                font-family: StencilCargoArmy;
                src: url('fonts/StencilCargoArmy.ttf');
                }

            @font-face{
                font-family: timeburnerbold;
                src: url('fonts/timeburnerbold.ttf');
            }
                
                .formcontainer{
                	display: grid;
                	grid-template-columns: auto auto auto auto;
                	grid-gap: 3px;
                	padding: 15px;
                }
                
                .formcontainer > div{
                    border-radius: 25px;
                	background-color: black;
                	padding: 65px 65px;
                	margin-left: 60%;
                }

                hr.gold{
                    width: 600px;
                    color: '#CDAB72';
                }

                img.logo{
                    height: 270px;
                }

                h5.PMA{
                    font-family: StencilCargoArmy;
                    font-size: 70px;
                    color: black;
                }

                label.up, h1.up{
                    color: white;
                    font-family: timeburnerbold;
                }
            </style>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"><!--<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> anotherlogin.php-->
                
                <div><center><img src="img/pma2.png" class="logo"></center></div>
                <!--<div><center><h5 class="PMA">PMA</h5></center></div>-->
                
            	<!--<div class="formcontainer" >
            		<div>
                        <div class="form-group <?php echo(!empty($username_err)) ? 'has error' : ''; ?>">
            			<h1 class="up">USER</h1>
            			<!--<label class="up"> Username </label>--> <!--<br><input type="text" name="username" class="form-control" placeholder="Username"><br><br>
                        </div>

                        <div class="form-group">
            			<!--<label class="up"> Password </label>--> <!--<br><input type="password" name="pwd" class="form-control" placeholder="Password"><br><br>
            			<div class="form-group"><center><input class="btn btn-success" name="submit" type="submit" value="LOGIN"></center></div>
                        </div>

            		</div>

            	</div>-->


                <div class="container">
                <div class="row">
                    <div class="col-md-4 ml-auto mr-auto">
                        <div class="card card-signup">
                            <form class="form" method="" action="">
                                <div class="card-header card-header-success text-center">
                                    <h4 class="h1ll22">USER</h4>
                                    <div class="social-line">
                                            <i class="fa fa-facebook-square"></i>
                                            <i class="fa fa-twitter"></i>
                                            <i class="fa fa-google-plus"></i>
                                    </div>
                                </div>
                                <div>
                        <div class="form-group <?php echo(!empty($password_err)) ? 'has error' : ''; ?>">
                        <h1 class="up">USER</h1>
                        <input type="text" name="username" class="form-control" placeholder="Username"><br><br>
                        <input type="password" name="password" class="form-control" placeholder="Password"><br><br>
                        <span><?php echo $password_err; ?></span>
                        <div class="form-group"><center><input class="btn btn-success" type="submit" value="LOGIN" action="admin-home.php"></center></div>
                        </div>
                    </div>
                </form></div>

                <center><h6>Forgot password? Please call the <br>COMPUTER OFFICE. Thank you!</h6></center>
            </form>
             <hr class="gold"><center><p class="ppppp">Copyright 2018 . Philippine Military Academy . All rights reserved.</p></center>





            <br><br><br><br><br>
            
        </body>
</html>