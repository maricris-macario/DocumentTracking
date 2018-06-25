

<!DOCTYPE html>

<html>
<head>
	<title>Admin Login (PMA Document Tracking System)</title>
    <link rel="stylesheet" href="../css/material-kit.css" />
	<link rel="stylesheet" href="../css/material-kit.min.css" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style2.css">
</head>
    <body>

	       <style>
           @font-face{
                font-family: StencilCargoArmy;
                src: url('../fonts/StencilCargoArmy.ttf');
                }

            @font-face{
                font-family: timeburnerbold;
                src: url('../fonts/timeburnerbold.ttf');
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

                label.up, h1.up, h6.up{
                    color: white;
                    font-family: timeburnerbold;
                }

                h6.upp{
                    color:black;
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
                            <form class="form" action="login.php" method="POST">
                                <div class="card-header card-header-primary text-center">
                                    <h4 class="h1ll22">ADMIN</h4>
                                    <h6 class="up">DOCUMENT TRACKING SYSTEM</h6>
                                    <div class="social-line">
                                            <i class="fa fa-facebook-square"></i>
                                            <i class="fa fa-twitter"></i>
                                            <i class="fa fa-google-plus"></i>
                                    </div>
                                </div>
                                <div>
                        <div class="form-group <?php echo(!empty($password_err)) ? 'has error' : ''; ?>">
                        <h1 class="up">ADMIN</h1>
                       <!-- <input type="text" name="username" class="form-control" placeholder="Username"><br><br>-->
                        <input type="password" name="password" class="form-control" placeholder="Password"><br><br>
                        
                        <div class="form-group"><center><input class="btn btn-primary" type="submit" name="submit" value="LOGIN" action=""></center></div>
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
                                <center><h6 class="upp">Forgot password? <br>Please call the COMPUTER OFFICE. Thank you!</h6></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="gold"><center><p class="ppppp">Copyright 2018 . Philippine Military Academy . All rights reserved.</p></center>


        </body>
</html>