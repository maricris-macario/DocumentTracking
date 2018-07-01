<!-- HEADER DESKTOP-->
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="col-lg-2 ml-auto">
                    <div class="header-button">
                        <div class="noti-wrap">
                            <div class="noti__item js-item-menu">
                                <i class="zmdi zmdi-notifications"></i>
                                <!--PHP CODE HERE maski yung span sa baba -->
                                <span class="quantity"></span>
                                <div class="notifi-dropdown js-dropdown">
                                    <div class="notifi__footer">
                                        <a href="#">All notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account-wrap">
                            <div class="account-item clearfix js-item-menu">
                                <div class="image">
                                    <img src="images/avatar.png" alt="user" />
                                </div>
                                <div class="content">
                                    <i class="zmdi zmdi-chevron-down"></i>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="images/avatar.png" alt="user" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h3 class="name">
                                                <!-- <a href="#">User</a> -->
                                                <?php include('showUserName.php')?>
                                            </h3>
                                            <span class="office"><?php include('showOfficeName.php') ?></span>
                                            <span class="chpwd"><a href="#">Change Password</a></span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="user/logout.php">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
            <!-- HEADER DESKTOP-->