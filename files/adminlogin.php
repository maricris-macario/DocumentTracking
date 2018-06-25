<?php
//include 'dbconnect.php';
require_once 'config.php';
//session_start();
//include('login.php');
//if(isset($_SESSION['login_user'])){
  //  header("location:index.php");
//}
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
  //  if(empty($_POST["username"])){
    //    $username_err = 'Please enter username.';
    //} else{
      //  $username = ($_POST["username"]);
    //}

    // Check if password is empty
    if(empty($_POST['password'])){
        $password_err = 'Please enter your password.';
    } else{
        $password = ($_POST['password']);
    }

    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT username, pwd FROM user WHERE username = ?";
    }

    if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $password); //$hashed_passwword
                    if(mysqli_stmt_fetch($stmt)){
                        if($password == $password){ //$hashed_password
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;
                            header("location: samplelandingpage.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    //mysqli_close($link);

//$hostname = "localhost";
//$user = "root";
//$password = "";
//$database = "doctrack";

//$connect = mysqli_connect($hostname, $user, $password);
//mysqli_select_db($connect, $database);

//if(isset($_POST['username'])){
    //$uname = $_POST['username'];
    //$pwd = $_POST['pwd'];

    //$sql = "select pwd from user where username=?";
    //$result = mysql_query($sql);

    //if(mysql_num_rows($result) -- 1){//--1
      //  echo "Login Successful!";
    //}else{
      //  echo "You must have entered a wrong username or password";
    //    exit();
  //  }

//}
?>

<!DOCTYPE html>

<html>
<head>
	<title>Admin Login (PMA Document Tracking System)</title>
    <link rel="stylesheet" href="css/material-kit.css" />
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
                	padding: 40px 45px;
                	margin-left: 62%;
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
                    font-size: 90px;
                    color: black;
                }

                label.up, h1.up{
                    color: white;
                    font-family: timeburnerbold;
                }
            </style>
           <!-- <form action="admindbconnect.php" method="POST"><?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
                
                <div><center><img src="img/pma2.png" class="logo"></center></div>
                
            	<div class="formcontainer">
            		<div>
                        <div class="form-group <?php echo(!empty($password_err)) ? 'has error' : ''; ?>">
            			<center><h1 class="up">ADMIN</h1></center><center><p>(Document Tracking System)</p></center>
            			<!--<label class="up"> Password </label> <br>--><!--<input type="password" name="password" class="form-control" placeholder="Password"><br><br>
                        <!--<span><?php echo $password_err; ?></span><!-- class="help-block"-->
            			<!--div class="form-group"><center><input class="btn btn-success" type="submit" value="LOGIN" action="admin-home.php"></center></div>
                        </div>
            		</div>
            	</div>
            </form>-->
<!--end--><br><br><br><br><br>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 ml-auto mr-auto">
                        <div class="card card-signup">
                            <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <div class="card-header card-header-primary text-center">
                                    <h4 class="h1ll22">ADMIN</h4>
                                    <div class="social-line">
                                            <i class="fa fa-facebook-square"></i>
                                            <i class="fa fa-twitter"></i>
                                            <i class="fa fa-google-plus"></i>
                                    </div>
                                </div>
                                <div>
                        <div class="form-group <?php echo(!empty($password_err)) ? 'has error' : ''; ?>">
                        <h1 class="up">ADMIN</h1>
                        <input type="password" name="password" class="form-control" placeholder="Password"><br><br>
                        
                        <div class="form-group"><center><input class="btn btn-primary" type="submit" name="submit" value="LOGIN" action="admin-home.php"></center></div>
                        </div>
                    </div>
                                    <!-- If you want to add a checkbox to this form, uncomment this code

              <div class="form-check">
                  <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" value="">
                      Subscribe to newsletter
                      <span class="form-check-sign">
                          <span class="check"></span>
                      </span>
                  </label>
              </div> -->
                                </div>
                                <center><h6>Forgot password? Please call the <br>COMPUTER OFFICE. Thank you!</h6></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="gold"><center><p class="ppppp">Copyright 2018 . Philippine Military Academy . All rights reserved.</p></center>
        </body>
</html>