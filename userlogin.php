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

label.up, h1.up, h6.up{
    color: white;
    font-family: timeburnerbold;
}
</style>
<br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 ml-auto mr-auto">
                <div class="card card-signup">
                    <form class="form" method="post" action="login_user.php">
                        <div class="card-header card-header-success text-center">
                            <h4 class="h1ll22">USER</h4>
                            <h6 class="up">DOCUMENT TRACKING SYSTEM</h6>
                            <div class="social-line">
                                <i class="fa fa-facebook-square"></i>
                                <i class="fa fa-twitter"></i>
                                <i class="fa fa-google-plus"></i>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <h1 class="up">USER</h1>
                                <input type="text" name="username" class="form-control" placeholder="Username"><br><br>
                                <input type="password" name="password" class="form-control" placeholder="Password"><br><br>

                                <div class="form-group"><center><input class="btn btn-success" type="submit" value="LOGIN" name="login_btn"></center></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <center><h6>Forgot password?<br> Please call the COMPUTER OFFICE @ local 6618. Thank you!</h6></center>
<hr class="gold"><center><p class="ppppp">Copyright 2018 . Philippine Military Academy . All rights reserved.</p></center>
</body>
</html>